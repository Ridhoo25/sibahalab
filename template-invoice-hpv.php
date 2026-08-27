<?php
/* =========================================================
   TEMPLATE INVOICE TAGIHAN HPV DNA
   Variabel yang dipakai:
   - $rows_tagihan   : array (namapuskesmas, tanggal, jumlah, hargasatuan, hargatotal)
   - $kabupaten_tagihan : nama kabupaten
   - $nomor_tagihan  : nomor surat
   - $tanggal_tagihan: tanggal surat (format d-m-Y)
   - $total_tagihan  : total keseluruhan
   ========================================================= */

if (!isset($rows_tagihan)) {
    $rows_tagihan = [];
}
$nomor_tagihan  = $nomor_tagihan  ?? '......../UPTLabkeskal/HPV-DNA/443.46/........';
$tanggal_tagihan = $tanggal_tagihan ?? date('d-m-Y');
$kabupaten_tagihan = $kabupaten_tagihan ?? '';
$total_tagihan = $total_tagihan ?? 0;
$kop_src = $kop_src ?? 'assets/img/kop.png';

$tglObj = DateTime::createFromFormat('d-m-Y', $tanggal_tagihan);
if (!$tglObj) {
    $tglObj = new DateTime();
}
$bulanRomawiMap = [1=>'I',2=>'II',3=>'III',4=>'IV',5=>'V',6=>'VI',7=>'VII',8=>'VIII',9=>'IX',10=>'X',11=>'XI',12=>'XII'];
$tglLong = $tglObj->format('j') . ' ' . bulan_nama($tglObj->format('n')) . ' ' . $tglObj->format('Y');
$bulanRomawi = $bulanRomawiMap[(int)$tglObj->format('n')];

if (strpos($nomor_tagihan, '........') !== false) {
    $nomor_tagihan = '......../UPTLabkeskal/HPV-DNA/443.46/' . $bulanRomawi . '/' . $tglObj->format('Y');
}

if (!function_exists('bulan_nama')) {
    function bulan_nama($bulan) {
        $nama = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
                 7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
        return $nama[(int)$bulan] ?? '';
    }
}
?>

<div class="invoice-hpv">
    <div class="invoice-kop">
        <div class="invoice-kop-logos">
            <img src="<?= htmlspecialchars($kop_src); ?>" alt="Kop Surat" class="invoice-kop-img">
        </div>
    </div>

    <div class="invoice-title">REKAPITULASI TAGIHAN/KLAIM PEMERIKSAAN SPESIMEN</div>

    <table class="invoice-meta" cellpadding="2" cellspacing="0">
        <tr>
            <td class="invoice-meta-left">
                Nomor : <?= htmlspecialchars($nomor_tagihan); ?><br>
                Tanggal : <?= $tglLong; ?>
            </td>
            <td class="invoice-meta-right">
                Kepada<br>
                Yth. Dinas Kesehatan Kabupaten <?= htmlspecialchars($kabupaten_tagihan); ?><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cq. Tim Kerja P2PTM
            </td>
        </tr>
    </table>

    <table class="invoice-table" cellpadding="4" cellspacing="0">
        <thead>
            <tr>
                <th class="inv-no">NO.</th>
                <th class="inv-tgl">TANGGAL</th>
                <th class="inv-puskesmas">NAMA PUSKESMAS</th>
                <th class="inv-jml">JUMLAH SPESIMEN</th>
                <th class="inv-harga">HARGA SATUAN</th>
                <th class="inv-total">JUMLAH TAGIHAN/KLAIM</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th>3</th>
                <th>4</th>
                <th>5 (3 x 4)</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($rows_tagihan as $r):
                $baris = !empty($r['puskesmas_rows']) ? $r['puskesmas_rows'] : [[
                    'namapuskesmas' => $r['namapuskesmas'],
                    'jumlah' => $r['jumlah'],
                    'hargasatuan' => $r['hargasatuan'],
                    'hargatotal' => $r['hargatotal'],
                ]];
                foreach ($baris as $br): ?>
            <tr>
                <td class="inv-no"><?= $no++; ?></td>
                <td class="inv-tgl"><?= htmlspecialchars($r['tanggal']); ?></td>
                <td class="inv-puskesmas"><?= htmlspecialchars($br['namapuskesmas']); ?></td>
                <td class="inv-jml"><?= $br['jumlah']; ?></td>
                <td class="inv-harga">Rp <?= number_format($br['hargasatuan'], 0, ',', '.'); ?></td>
                <td class="inv-total">Rp <?= number_format($br['hargatotal'], 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach;
            endforeach; ?>
            <?php
            // hitung total baris agar baris kosong sesuai format
            $barisTerisi = 0;
            foreach ($rows_tagihan as $r) {
                $barisTerisi += !empty($r['puskesmas_rows']) ? count($r['puskesmas_rows']) : 1;
            }
            $kosong = 10 - $barisTerisi;
            for ($k = 0; $k < max($kosong, 0); $k++): ?>
            <tr>
                <td class="inv-no"><?= $no++; ?></td>
                <td class="inv-tgl"></td>
                <td class="inv-puskesmas"></td>
                <td class="inv-jml"></td>
                <td class="inv-harga"></td>
                <td class="inv-total"></td>
            </tr>
            <?php endfor; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="inv-terbilang">
                    Terbilang : &quot;<?= trim(terbilang($total_tagihan)); ?> Rupiah&quot;
                </td>
                <td colspan="2" class="inv-grandtotal">
                    TOTAL TAGIHAN/KLAIM<br>
                    <span class="inv-grandtotal-nominal">Rp <?= number_format($total_tagihan, 0, ',', '.'); ?></span>
                </td>
            </tr>
        </tfoot>
    </table>

    <table class="invoice-bottom" cellpadding="0" cellspacing="0">
        <tr>
            <td class="invoice-bank">
                Pembayaran Tagihan Melalui :<br>
                Nama Bank&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Bank Kalteng<br>
                Nomor Rekening&nbsp;&nbsp;: 1000 102 007 170<br>
                Atas Nama Rekening : PENERIMAA BLUD UPT LABKESKAL PROVINSI KALTENG
            </td>
            <td class="invoice-sign">
                Palangka Raya, <?= $tglLong; ?><br>
                Plt. Kepala UPT.<br>
                Laboratorium Kesehatan dan Kalibrasi<br>
                Provinsi Kalimantan Tengah<br><br><br>
                <b>dr. DAMAR PRAMUSINTA, MPH</b><br>
                NIP. 197603102003121008
            </td>
        </tr>
    </table>
</div>
