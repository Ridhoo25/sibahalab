<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

/* =====================
   .ENV LOADER
   Membaca file .env di direktori aplikasi dan memuatnya
   sebagai variabel lingkungan (putenv). Nilai yang sudah
   ada di server (env asli) tetap diutamakan.
===================== */
function load_env_file($path)
{
    if (!is_file($path) || !is_readable($path)) {
        return;
    }
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || strpos($line, '#') === 0 || strpos($line, '=') === false) {
            continue;
        }
        list($key, $value) = array_map('trim', explode('=', $line, 2));
        if ($key === '' || getenv($key) !== false) {
            continue;
        }
        $value = trim($value, " \t\n\r\0\x0B\"'");
        putenv("$key=$value");
        $_ENV[$key] = $value;
    }
}
load_env_file(__DIR__ . '/.env');

/* =====================
   DATABASE CONNECTION
   Override via .env / env: DB_HOST, DB_USER, DB_PASS, DB_NAME
   (fallback = konfigurasi localhost Laragon)
===================== */
$DB_HOST = getenv('DB_HOST') ?: '127.0.0.1';
$DB_USER = getenv('DB_USER') ?: 'root';
$DB_PASS = getenv('DB_PASS') ?: '';
$DB_NAME = getenv('DB_NAME') ?: 'bahalab';

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (!$conn) { 
  die("Koneksi database gagal: " . mysqli_connect_error()); 
}

/* =====================
   CSRF PROTECTION
===================== */
function generate_csrf_token() {
    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['_csrf_token'];
}

function csrf_field() {
    return '<input type="hidden" name="_csrf_token" value="' . generate_csrf_token() . '">';
}

function verify_csrf_token($token) {
    if (empty($_SESSION['_csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['_csrf_token'], $token);
}

/* =====================
   HELPER
===================== */

/* =====================
   INVOICE HPV DNA - HELPER
===================== */
function parse_kabupaten($namahpv)
{
    $namahpv = trim($namahpv);
    if (stripos($namahpv, ' - ') !== false) {
        $parts = explode(' - ', $namahpv, 2);
        return trim($parts[1]);
    }
    if (stripos($namahpv, 'kabupaten') !== false) {
        return trim(preg_replace('/^puskesmas\s+/i', '', $namahpv));
    }
    return 'Lainnya';
}

function parse_puskesmas($namahpv)
{
    $namahpv = trim($namahpv);
    if (stripos($namahpv, ' - ') !== false) {
        $parts = explode(' - ', $namahpv, 2);
        return trim($parts[0]);
    }
    return $namahpv;
}

function daftar_kabupaten_kalteng()
{
    return [
        'Barito Selatan',
        'Barito Timur',
        'Barito Utara',
        'Gunung Mas',
        'Kapuas',
        'Katingan',
        'Kotawaringin Barat',
        'Kotawaringin Timur',
        'Lamandau',
        'Murung Raya',
        'Palangka Raya',
        'Pulang Pisau',
        'Seruyan',
        'Sukamara',
    ];
}

function get_daftar_kabupaten()
{
    global $conn;
    $list = daftar_kabupaten_kalteng();
    $q = mysqli_query($conn, "SELECT DISTINCT kabupaten FROM sib_hpv_dna WHERE kabupaten IS NOT NULL AND kabupaten != '' ORDER BY kabupaten");
    while ($r = mysqli_fetch_assoc($q)) {
        if (!in_array($r['kabupaten'], $list, true)) {
            $list[] = $r['kabupaten'];
        }
    }
    return $list;
}

function get_rows_tagihan_hpv($kabupaten = null, $bulan = null, $tahun = null, $tanggal = null)
{
    global $conn;
    $rows = [];
    $where = [];
    if (!empty($kabupaten)) {
        $kab = mysqli_real_escape_string($conn, $kabupaten);
        $where[] = "kabupaten = '$kab'";
    }
    if (!empty($tanggal)) {
        $tgl = mysqli_real_escape_string($conn, date('Y-m-d', strtotime($tanggal)));
        $where[] = "DATE(tanggal_penerimaan) = '$tgl'";
    } elseif (!empty($bulan) && !empty($tahun)) {
        $b = (int) $bulan;
        $t = (int) $tahun;
        $where[] = "MONTH(tanggal_penerimaan) = $b AND YEAR(tanggal_penerimaan) = $t";
    }
    $sql = "SELECT * FROM sib_hpv_dna" . (count($where) ? " WHERE " . implode(' AND ', $where) : "") . " ORDER BY kabupaten, tanggal_penerimaan, nama ASC";
    $q = mysqli_query($conn, $sql);
    while ($r = mysqli_fetch_assoc($q)) {
        $kab = !empty($r['kabupaten']) ? $r['kabupaten'] : parse_kabupaten($r['nama']);
        $key = strtolower($kab) . '|' . date('Y-m-d', strtotime($r['tanggal_penerimaan']));
        if (!isset($rows[$key])) {
            $rows[$key] = [
                'namakabupaten' => $kab,
                'namapuskesmas' => $kab,
                'tanggalhpv' => date('Y-m-d', strtotime($r['tanggal_penerimaan'])),
                'tanggal' => date('d-m-Y', strtotime($r['tanggal_penerimaan'])),
                'jumlah' => 0,
                'hargasatuan' => (int) $r['harga_satuan'],
                'hargatotal' => 0,
                'puskesmas_list' => [],
                'puskesmas_rows' => [],
            ];
        }
        $rows[$key]['jumlah'] += (int) $r['jumlah'];
        $rows[$key]['hargatotal'] += (int) $r['harga_total'];
        $rows[$key]['puskesmas_list'][] = parse_puskesmas($r['nama']) . ' (' . (int) $r['jumlah'] . ')';
        $rows[$key]['puskesmas_rows'][] = [
            'namapuskesmas' => parse_puskesmas($r['nama']),
            'jumlah' => (int) $r['jumlah'],
            'hargasatuan' => (int) $r['harga_satuan'],
            'hargatotal' => (int) $r['harga_total'],
        ];
    }
    return array_values($rows);
}

function generate_nomor_invoice_hpv($tanggal)
{
    global $conn;
    $bulanRomawiMap = [1=>'I',2=>'II',3=>'III',4=>'IV',5=>'V',6=>'VI',7=>'VII',8=>'VIII',9=>'IX',10=>'X',11=>'XI',12=>'XII'];
    $ts = strtotime($tanggal);
    $bulan = (int) date('n', $ts);
    $tahun = date('Y', $ts);
    $bulanRomawi = $bulanRomawiMap[$bulan] ?? '';

    $q = mysqli_query($conn, "
        SELECT COALESCE(MAX(CAST(SUBSTRING_INDEX(nomor_invoice, '/', 1) AS UNSIGNED)), 0) AS nomor_terakhir
        FROM sib_payment_hpv
        WHERE nomor_invoice IS NOT NULL
          AND nomor_invoice != ''
          AND nomor_invoice LIKE '%/$tahun'
    ");
    $row = mysqli_fetch_assoc($q);
    $urutan = ((int) ($row['nomor_terakhir'] ?? 0)) + 1;

    return str_pad((string) $urutan, 3, '0', STR_PAD_LEFT) . '/UPTLabkeskal/HPV-DNA/443.46/' . $bulanRomawi . '/' . $tahun;
}

function get_daftar_kabupaten_tb()
{
    global $conn;
    $list = daftar_kabupaten_kalteng();
    $q = mysqli_query($conn, "SELECT DISTINCT kabupaten FROM sib_pemeriksaan_tb WHERE kabupaten IS NOT NULL AND kabupaten != '' ORDER BY kabupaten");
    while ($r = mysqli_fetch_assoc($q)) {
        if (!in_array($r['kabupaten'], $list, true)) {
            $list[] = $r['kabupaten'];
        }
    }
    return $list;
}

function get_rows_tagihan_tb($kabupaten = null, $bulan = null, $tahun = null, $tanggal = null)
{
    global $conn;
    $rows = [];
    $where = [];
    if (!empty($kabupaten)) {
        $kab = mysqli_real_escape_string($conn, $kabupaten);
        $where[] = "kabupaten = '$kab'";
    }
    if (!empty($tanggal)) {
        $tgl = mysqli_real_escape_string($conn, date('Y-m-d', strtotime($tanggal)));
        $where[] = "DATE(tanggal_penerimaan) = '$tgl'";
    } elseif (!empty($bulan) && !empty($tahun)) {
        $b = (int) $bulan;
        $t = (int) $tahun;
        $where[] = "MONTH(tanggal_penerimaan) = $b AND YEAR(tanggal_penerimaan) = $t";
    }
    $sql = "SELECT * FROM sib_pemeriksaan_tb" . (count($where) ? " WHERE " . implode(' AND ', $where) : "") . " ORDER BY kabupaten, tanggal_penerimaan, nama ASC";
    $q = mysqli_query($conn, $sql);
    while ($r = mysqli_fetch_assoc($q)) {
        $kab = !empty($r['kabupaten']) ? $r['kabupaten'] : parse_kabupaten($r['nama']);
        $key = strtolower($kab) . '|' . date('Y-m-d', strtotime($r['tanggal_penerimaan']));
        if (!isset($rows[$key])) {
            $rows[$key] = [
                'namakabupaten' => $kab,
                'namapuskesmas' => $kab,
                'tanggaltb' => date('Y-m-d', strtotime($r['tanggal_penerimaan'])),
                'tanggal' => date('d-m-Y', strtotime($r['tanggal_penerimaan'])),
                'jumlah' => 0,
                'hargasatuan' => (int) $r['harga_satuan'],
                'hargatotal' => 0,
                'puskesmas_list' => [],
                'puskesmas_rows' => [],
            ];
        }
        $rows[$key]['jumlah'] += (int) $r['jumlah'];
        $rows[$key]['hargatotal'] += (int) $r['harga_total'];
        $rows[$key]['puskesmas_list'][] = parse_puskesmas($r['nama']) . ' (' . (int) $r['jumlah'] . ')';
        $rows[$key]['puskesmas_rows'][] = [
            'namapuskesmas' => parse_puskesmas($r['nama']),
            'jumlah' => (int) $r['jumlah'],
            'hargasatuan' => (int) $r['harga_satuan'],
            'hargatotal' => (int) $r['harga_total'],
        ];
    }
    return array_values($rows);
}

function terbilang($angka)
{
    $angka = abs((int) $angka);
    $satuan = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
    if ($angka < 12) {
        return trim($satuan[$angka]);
    } elseif ($angka < 20) {
        return trim(terbilang($angka - 10) . ' Belas');
    } elseif ($angka < 100) {
        return trim(terbilang(intdiv($angka, 10)) . ' Puluh ' . terbilang($angka % 10));
    } elseif ($angka < 200) {
        return trim('Seratus ' . terbilang($angka - 100));
    } elseif ($angka < 1000) {
        return trim(terbilang(intdiv($angka, 100)) . ' Ratus ' . terbilang($angka % 100));
    } elseif ($angka < 2000) {
        return trim('Seribu ' . terbilang($angka - 1000));
    } elseif ($angka < 1000000) {
        return trim(terbilang(intdiv($angka, 1000)) . ' Ribu ' . terbilang($angka % 1000));
    } elseif ($angka < 1000000000) {
        return trim(terbilang(intdiv($angka, 1000000)) . ' Juta ' . terbilang($angka % 1000000));
    } else {
        return trim(terbilang(intdiv($angka, 1000000000)) . ' Miliar ' . terbilang($angka % 1000000000));
    }
}

/* =====================
   STOCK - TAMBAH BARANG
===================== */
if (isset($_POST['addnewbarang'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $stok = (int) $_POST['stok'];
    $satuan = mysqli_real_escape_string($conn, $_POST['satuan']);
    $lab = mysqli_real_escape_string($conn, $_POST['lab']);

    $query = mysqli_query(
        $conn,
        "INSERT INTO sib_bhp (nama_barang, deskripsi, stok, satuan, lab)
         VALUES ('$nama_barang','$deskripsi','$stok','$satuan','$lab')"
    );

    header("Location: stock.php");
    exit;
}

/* =====================
   BARANG MASUK
===================== */
if (isset($_POST['barangmasuk'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $barangnya = (int) $_POST['barangnya'];
    $penerima = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $qty = (int) $_POST['qty'];

    $data = mysqli_fetch_array(
        mysqli_query($conn, "SELECT stok FROM sib_bhp WHERE id='$barangnya'")
    );

    $stockbaru = $data['stok'] + $qty;

    mysqli_query(
        $conn,
        "INSERT INTO sib_bhp_masuk (id_bhp, keterangan, qty, tanggal)
         VALUES ('$barangnya','$penerima','$qty', NOW())"
    );

    mysqli_query(
        $conn,
        "UPDATE sib_bhp SET stok='$stockbaru' WHERE id='$barangnya'"
    );

    header("Location: bhp-masuk.php");
    exit;
}

/* =====================
   BARANG KELUAR
===================== */
if (isset($_POST['addbarangkeluar'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $barangnya = (int) $_POST['barangnya'];
    $penerima = mysqli_real_escape_string($conn, $_POST['penerima']);
    $qty = (int) $_POST['qty'];

    $data = mysqli_fetch_array(
        mysqli_query($conn, "SELECT stok FROM sib_bhp WHERE id='$barangnya'")
    );

    if ($data['stok'] < $qty) {
        echo "<script>alert('Stok tidak mencukupi');window.location='bhp-keluar.php';</script>";
        exit;
    }

    $stockbaru = $data['stok'] - $qty;

    mysqli_query(
        $conn,
        "INSERT INTO sib_bhp_keluar (id_bhp, penerima, qty, tanggal)
         VALUES ('$barangnya','$penerima','$qty', NOW())"
    );

    mysqli_query(
        $conn,
        "UPDATE sib_bhp SET stok='$stockbaru' WHERE id='$barangnya'"
    );

    header("Location: bhp-keluar.php");
    exit;
}

/* =====================
   UPDATE BARANG
===================== */
if (isset($_POST['updatebarang'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $id_bhp = (int) $_POST['id_bhp'];
    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $stok = (int) $_POST['stok'];
    $satuan = mysqli_real_escape_string($conn, $_POST['satuan']);
    $lab = mysqli_real_escape_string($conn, $_POST['lab']);

    mysqli_query(
        $conn,
        "UPDATE sib_bhp SET
            nama_barang='$nama_barang',
            deskripsi='$deskripsi',
            stok='$stok',
            satuan='$satuan',
            lab='$lab'
         WHERE id='$id_bhp'"
    );

    header("Location: stock.php");
    exit;
}

/* =====================
   DELETE BARANG
===================== */
if (isset($_POST['deletebarang'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $id_bhp = (int) $_POST['id_bhp'];
    mysqli_query($conn, "DELETE FROM sib_bhp WHERE id='$id_bhp'");
    header("Location: stock.php");
    exit;
}

/* =====================
   DELETE sib_sbbk
===================== */
if (isset($_POST['deletesbbk'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $id_sbbk = (int) $_POST['id_sbbk'];

    mysqli_begin_transaction($conn);
    try {
        // Kembalikan status barang
        $q1 = mysqli_query($conn, "
            UPDATE sib_penerimaan 
            SET status='Tersedia' 
            WHERE id IN (
                SELECT id_bhp FROM sib_sbbk_detail WHERE id_sbbk='$id_sbbk'
            )
        ");
        if (!$q1) {
            throw new Exception(mysqli_error($conn));
        }

        // Hapus detail
        $q2 = mysqli_query($conn, "DELETE FROM sib_sbbk_detail WHERE id_sbbk='$id_sbbk'");
        if (!$q2) {
            throw new Exception(mysqli_error($conn));
        }

        // Hapus header
        $q3 = mysqli_query($conn, "DELETE FROM sib_sbbk WHERE id='$id_sbbk'");
        if (!$q3) {
            throw new Exception(mysqli_error($conn));
        }

        mysqli_commit($conn);
        header("Location: sbbk.php");
        exit;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "<script>alert('Gagal hapus SBBK: " . addslashes($e->getMessage()) . "');window.location='sbbk.php';</script>";
        exit;
    }
}

/* =====================
   PENGAJUAN SISTEM
===================== */
if (isset($_POST['ajukan'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $tanggal = date('Y-m-d H:i:s');
    $nama_bhp = mysqli_real_escape_string($conn, $_POST['nama_bhp']);
    $spesifikasi = mysqli_real_escape_string($conn, $_POST['spesifikasi']);
    $satuan = mysqli_real_escape_string($conn, $_POST['satuan']);
    $jumlah = (int) $_POST['jumlah'];
    $pemohon = mysqli_real_escape_string($conn, $_POST['pemohon']);
    $laboratorium = mysqli_real_escape_string($conn, $_POST['laboratorium']);

    mysqli_query(
        $conn,
        "INSERT INTO sib_pengajuan
         (tanggal, nama_bhp, spesifikasi, satuan, jumlah, pemohon, laboratorium, status)
         VALUES
         ('$tanggal','$nama_bhp','$spesifikasi','$satuan','$jumlah','$pemohon','$laboratorium','Diajukan')"
    );

    echo "<script>alert('Pengajuan berhasil');window.location='pengajuan.php';</script>";
    exit;
}

/* =====================
   HPV DNA - TERIMA
===================== */
if (isset($_POST['terimahpv'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }

    $kabupaten = mysqli_real_escape_string($conn, $_POST['kabupaten']);
    $namaArr   = $_POST['nama'] ?? [];
    $jenisArr  = $_POST['jenis'] ?? [];
    $suhuArr   = $_POST['suhu'] ?? [];
    $jumlahArr = $_POST['jumlah'] ?? [];
    $hargasatuan = 40000;
    $tglInput = trim((string) ($_POST['tanggal_penerimaan'] ?? ''));
    $tanggal_penerimaan = ($tglInput !== '') ? date('Y-m-d H:i:s', strtotime($tglInput)) : date('Y-m-d H:i:s');
    $tanggal_penerimaan = mysqli_real_escape_string($conn, $tanggal_penerimaan);

    $rowsInserted = 0;
    mysqli_begin_transaction($conn);
    try {
        foreach ($namaArr as $idx => $nama) {
            $nama = trim((string) $nama);
            if ($nama === '') {
                continue;
            }
            $nama = mysqli_real_escape_string($conn, $nama);
            $jenis = mysqli_real_escape_string($conn, strtoupper(trim($jenisArr[$idx] ?? '')));
            $suhu = str_replace(',', '.', trim($suhuArr[$idx] ?? '0'));
            $jumlah = (int) ($jumlahArr[$idx] ?? 0);
            if ($jumlah <= 0) {
                continue;
            }
            $hargatotal = $jumlah * $hargasatuan;

            mysqli_query(
                $conn,
                "INSERT INTO sib_hpv_dna
                 (tanggal_penerimaan, nama, kabupaten, jenis, suhu, jumlah, harga_satuan, harga_total, status)
                 VALUES
                 ('$tanggal_penerimaan','$nama','$kabupaten','$jenis','$suhu','$jumlah','$hargasatuan','$hargatotal','Belum Dikerjakan')"
            );
            $rowsInserted++;
        }

        mysqli_commit($conn);

        if ($rowsInserted === 0) {
            throw new Exception('Tidak ada baris puskesmas yang valid');
        }

        echo "<script>alert('Penerimaan sampel berhasil ($rowsInserted puskesmas)');window.location='hpv-dna.php';</script>";
        exit;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "<script>alert('Penerimaan gagal: " . addslashes($e->getMessage()) . "');window.location='hpv-dna.php';</script>";
        exit;
    }
}

/* =====================
   TB UJI ULANG - TERIMA
===================== */
if (isset($_POST['terimatb'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }

    $kabupaten = mysqli_real_escape_string($conn, $_POST['kabupaten'] ?? '');
    $namaArr   = $_POST['nama'] ?? [];
    $jumlahArr = $_POST['jumlah'] ?? [];
    $hargasatuan = 5000;
    $tglInput = trim((string) ($_POST['tanggal_penerimaan'] ?? ''));
    $tanggal_penerimaan = ($tglInput !== '') ? date('Y-m-d H:i:s', strtotime($tglInput)) : date('Y-m-d H:i:s');
    $tanggal_penerimaan = mysqli_real_escape_string($conn, $tanggal_penerimaan);

    $rowsInserted = 0;
    mysqli_begin_transaction($conn);
    try {
        foreach ($namaArr as $idx => $nama) {
            $nama = trim((string) $nama);
            if ($nama === '') {
                continue;
            }
            $nama = mysqli_real_escape_string($conn, $nama);
            $jumlah = (int) ($jumlahArr[$idx] ?? 0);
            if ($jumlah <= 0) {
                continue;
            }
            $hargatotal = $jumlah * $hargasatuan;

            mysqli_query(
                $conn,
                "INSERT INTO sib_pemeriksaan_tb
                 (tanggal_penerimaan, nama, kabupaten, jumlah, harga_satuan, harga_total, status)
                 VALUES
                 ('$tanggal_penerimaan','$nama','$kabupaten','$jumlah','$hargasatuan','$hargatotal','Belum Dikerjakan')"
            );
            $rowsInserted++;
        }

        mysqli_commit($conn);

        if ($rowsInserted === 0) {
            throw new Exception('Tidak ada baris puskesmas yang valid');
        }

        echo "<script>alert('Penerimaan sampel TB berhasil ($rowsInserted puskesmas)');window.location='tb.php';</script>";
        exit;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "<script>alert('Penerimaan gagal: " . addslashes($e->getMessage()) . "');window.location='tb.php';</script>";
        exit;
    }
}

/* =====================
   BHP - TERIMA
===================== */

if (isset($_POST['terimabhp'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $nama_bhp = mysqli_real_escape_string($conn, $_POST['nama_bhp']);
    $merek = mysqli_real_escape_string($conn, $_POST['merek']);
    $jumlah = (int) $_POST['jumlah'];
    $satuan = mysqli_real_escape_string($conn, $_POST['satuan']);
    $exp_date = mysqli_real_escape_string($conn, $_POST['exp_date']);
    $laboratorium = mysqli_real_escape_string($conn, $_POST['laboratorium']);
    $penerima = mysqli_real_escape_string($conn, $_POST['penerima']);

    mysqli_query(
        $conn,
        "INSERT INTO sib_penerimaan
         (tanggal, nama_bhp, merek, jumlah, satuan, exp_date, laboratorium, penerima)
         VALUES
         ('$tanggal','$nama_bhp','$merek','$jumlah','$satuan','$exp_date','$laboratorium','$penerima')"
    );

    echo "<script>alert('Penerimaan BHP berhasil');window.location='penerimaan.php';</script>";
    exit;
}

/* =====================
   BHP - Distribusi (Header Detail)
===================== */
if (isset($_POST['distribusibhp'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }

    $tanggal      = mysqli_real_escape_string($conn, $_POST['tanggal'] ?? '');
    $laboratorium = mysqli_real_escape_string($conn, $_POST['laboratorium'] ?? '');
    $penerima     = mysqli_real_escape_string($conn, $_POST['terima'] ?? '');
    $serah        = mysqli_real_escape_string($conn, $_POST['serah'] ?? '');

    $ids = $_POST['id'] ?? [];
    $ids = array_map('intval', (array)$ids);
    $ids = array_values(array_filter($ids, fn($v) => $v > 0));

    if (empty($tanggal) || empty($laboratorium) || empty($penerima) || empty($serah)) {
        echo "<script>alert('Data distribusi belum lengkap');window.location='sbbk.php';</script>";
        exit;
    }

    if (count($ids) === 0) {
        echo "<script>alert('Pilih minimal 1 barang');window.location='sbbk.php';</script>";
        exit;
    }

    mysqli_begin_transaction($conn);
    try {
        // 1) Generate Nomor SBBK
        $bulanAngka = (int)date('n', strtotime($tanggal));
        $tahun = date('Y', strtotime($tanggal));
        $bulanRomawiMap = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];
        $bulanRomawi = $bulanRomawiMap[$bulanAngka] ?? '';

        $cek = mysqli_query($conn, "
            SELECT COALESCE(MAX(CAST(SUBSTRING_INDEX(no_sbbk, '/', 1) AS UNSIGNED)), 0) AS nomor_terakhir
            FROM sib_sbbk
        ");
        if (!$cek) {
            throw new Exception(mysqli_error($conn));
        }

        $row = mysqli_fetch_assoc($cek);
        $urutan = ((int)($row['nomor_terakhir'] ?? 0)) + 1;
        $urutanFormat = str_pad((string)$urutan, 3, '0', STR_PAD_LEFT);
        $nosbbk = $urutanFormat . "/" ."SBBK/" ."UPTLABKESKAL/" . $bulanRomawi . "/" . $tahun;

        // 2) Insert HEADER
        $insHeader = mysqli_query($conn, "
            INSERT INTO sib_sbbk (no_sbbk, tanggal, laboratorium, penerima, serah)
            VALUES ('$nosbbk', '$tanggal', '$laboratorium', '$penerima', '$serah')
        ");
        if (!$insHeader) {
            throw new Exception(mysqli_error($conn));
        }

        $id_sbbk = (int) mysqli_insert_id($conn);
        if ($id_sbbk <= 0) {
            throw new Exception('ID SBBK gagal dibuat');
        }

        $in = implode(',', $ids);

        // 3) Validasi barang masih tersedia
        $cekTersedia = mysqli_query($conn, "
            SELECT COUNT(*) AS total
            FROM sib_penerimaan
            WHERE id IN ($in) AND status='Tersedia'
        ");
        if (!$cekTersedia) {
            throw new Exception(mysqli_error($conn));
        }
        $jmlTersedia = (int)(mysqli_fetch_assoc($cekTersedia)['total'] ?? 0);
        if ($jmlTersedia !== count($ids)) {
            throw new Exception('Ada barang yang tidak tersedia / sudah didistribusikan');
        }

        // 4) Insert DETAIL (bulk, lebih stabil)
        $insDetail = mysqli_query($conn, "
            INSERT INTO sib_sbbk_detail (id_sbbk, id_bhp, nama_bhp)
            SELECT $id_sbbk, t.id, t.nama_bhp
            FROM sib_penerimaan t
            WHERE t.id IN ($in)
        ");
        if (!$insDetail) {
            throw new Exception(mysqli_error($conn));
        }

        // 5) Update status barang
        $updStatus = mysqli_query($conn, "
            UPDATE sib_penerimaan
            SET status='Sudah Didistribusikan'
            WHERE id IN ($in)
        ");
        if (!$updStatus) {
            throw new Exception(mysqli_error($conn));
        }

        mysqli_commit($conn);
        echo "<script>alert('Distribusi berhasil');window.location='sbbk.php';</script>";
        exit;

    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "<script>alert('Distribusi gagal: " . addslashes($e->getMessage()) . "');window.location='sbbk.php';</script>";
        exit;
    }
}