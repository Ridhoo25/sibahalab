<?php
require 'config.php';
require 'auth.php';

$data = mysqli_query($conn, "SELECT * FROM sib_pemeriksaan_tb ORDER BY id DESC");
$list_tb = [];
while ($d = mysqli_fetch_array($data)) {
    $list_tb[] = $d;
}

$grouped = [];
foreach ($list_tb as $d) {
    $kab = !empty($d['kabupaten']) ? $d['kabupaten'] : parse_kabupaten($d['nama']);
    $key = strtolower($kab) . '|' . $d['tanggal_penerimaan'];
    if (!isset($grouped[$key])) {
        $grouped[$key] = [
            'kabupaten' => $kab,
            'tanggal' => $d['tanggal_penerimaan'],
            'records' => [],
            'jumlah' => 0,
            'hargatotal' => 0,
        ];
    }
    $grouped[$key]['records'][] = $d;
    $grouped[$key]['jumlah'] += (int) $d['jumlah'];
    $grouped[$key]['hargatotal'] += (int) $d['harga_total'];
}
$grouped = array_values($grouped);

$kabSum = [];
foreach ($list_tb as $d) {
    $kab = !empty($d['kabupaten']) ? $d['kabupaten'] : parse_kabupaten($d['nama']);
    if (!isset($kabSum[$kab])) {
        $kabSum[$kab] = ['jumlah' => 0, 'hargatotal' => 0];
    }
    $kabSum[$kab]['jumlah'] += (int) $d['jumlah'];
    $kabSum[$kab]['hargatotal'] += (int) $d['harga_total'];
}

$dashSampel = 0;
$dashHarga = 0;
foreach ($kabSum as $s) {
    $dashSampel += $s['jumlah'];
    $dashHarga += $s['hargatotal'];
}

ob_start();
?>
<div class="page-header">
    <div>
        <h1>Penerimaan TB</h1>
        <p class="page-subtitle">Manajemen sampel TB uji ulang dan pembayaran</p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            <i class="fas fa-plus"></i> Tambah Penerimaan
        </button>
        <a href="export-tb.php" class="btn btn-outline">
            <i class="fas fa-file-excel"></i> Export
        </a>
    </div>
</div>

<div class="grid grid-4">
    <div class="card stat-card">
        <div class="stat-icon violet"><i class="fas fa-vial"></i></div>
        <div class="stat-info">
            <div class="stat-label">Total Sampel</div>
            <div class="stat-value"><?= $dashSampel; ?></div>
            <div class="stat-desc">Semua kabupaten</div>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon green"><i class="fas fa-money-bill-wave"></i></div>
        <div class="stat-info">
            <div class="stat-label">Total Tagihan</div>
            <div class="stat-value">Rp <?= number_format($dashHarga, 0, ',', '.'); ?></div>
            <div class="stat-desc">Semua kabupaten</div>
        </div>
    </div>
    <?php
    $colorIdx = 0;
    $colors = ['blue', 'orange', 'violet', 'green'];
    foreach ($kabSum as $kab => $s):
    ?>
    <div class="card stat-card">
        <div class="stat-icon <?= $colors[$colorIdx++ % count($colors)]; ?>"><i class="fas fa-map-marker-alt"></i></div>
        <div class="stat-info">
            <div class="stat-label"><?= htmlspecialchars($kab); ?></div>
            <div class="stat-value"><?= $s['jumlah']; ?> sampel</div>
            <div class="stat-desc">Rp <?= number_format($s['hargatotal'], 0, ',', '.'); ?></div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="data-table-wrapper" style="margin-top:1.5rem;">
    <div class="table-header">
        <span><i class="fas fa-lungs mr-2"></i>Data Sampel TB Uji Ulang</span>
    </div>
    <div class="table-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Tanggal</th>
                        <th>Kabupaten</th>
                        <th>Puskesmas</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Harga Total</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $totalSampel = 0;
                    $totalHarga = 0;
                    foreach ($grouped as $g):
                        $span = count($g['records']);
                        $jmlBelum = 0;
                        $jmlSudah = 0;
                        foreach ($g['records'] as $d) {
                            if ($d['status'] === 'Belum Dikerjakan') $jmlBelum++;
                            elseif ($d['status'] === 'Sudah Dikerjakan') $jmlSudah++;
                        }
                        $totalSampel += $g['jumlah'];
                        $totalHarga += $g['hargatotal'];
                    ?>
                    <?php foreach ($g['records'] as $idx => $d):
                        $badgeClass = $d['status'] == 'Sudah Dikerjakan' ? 'badge-success' : 'badge-warning';
                    ?>
                    <tr>
                        <?php if ($idx === 0): ?>
                        <td class="text-center align-middle" rowspan="<?= $span; ?>"><?= $i++; ?></td>
                        <td class="align-middle" rowspan="<?= $span; ?>"><?= htmlspecialchars($g['tanggal']); ?></td>
                        <td class="fw-600 align-middle" rowspan="<?= $span; ?>"><?= htmlspecialchars($g['kabupaten']); ?></td>
                        <?php endif; ?>
                        <td><?= htmlspecialchars($d['nama']); ?></td>
                        <td class="text-center"><?= (int) $d['jumlah']; ?></td>
                        <td class="text-center">Rp <?= number_format($d['harga_total'], 0, ',', '.'); ?></td>
                        <td class="text-center"><span class="badge <?= $badgeClass; ?>"><?= $d['status']; ?></span></td>
                        <td class="text-center">
                            <?php if ($d['status'] === 'Belum Dikerjakan') { ?>
                            <form method="post" action="aksi-tb.php" class="d-inline" onsubmit="return confirm('Tandai sudah dikerjakan?')">
                                <?= csrf_field() ?>
                                <input type="hidden" name="aksi" value="setujui">
                                <input type="hidden" name="id" value="<?= $d['id']; ?>">
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-check"></i> Kerjakan
                                </button>
                            </form>
                            <?php } else { echo '<span class="text-muted">-</span>'; } ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total</strong></td>
                        <td class="text-center fw-600"><?= $totalSampel; ?> sampel</td>
                        <td class="text-center fw-600">Rp <?= number_format($totalHarga, 0, ',', '.'); ?></td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="modal-overlay" id="myModal">
    <div class="modal modal-lg">
        <div class="modal-header">
            <h4>Tambah Penerimaan Sampel TB</h4>
            <button type="button" class="modal-close">&times;</button>
        </div>
        <form method="post">
            <?= csrf_field() ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Kabupaten</label>
                    <input type="text" name="kabupaten" class="form-control" list="daftarKabupaten" placeholder="Ketik / pilih kabupaten" required>
                    <datalist id="daftarKabupaten">
                        <?php
                        $daftarKab = get_daftar_kabupaten_tb();
                        foreach ($daftarKab as $kab):
                        ?>
                        <option value="<?= htmlspecialchars($kab); ?>"></option>
                        <?php endforeach; ?>
                    </datalist>
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggal &amp; Jam Penerimaan</label>
                    <input type="datetime-local" name="tanggal_penerimaan" class="form-control" value="<?= date('Y-m-d\TH:i'); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Daftar Puskesmas</label>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabelPuskesmas" style="margin-bottom:0;">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:4%;">#</th>
                                    <th style="width:40%;">Nama Puskesmas</th>
                                    <th class="text-center" style="width:30%;">Jumlah</th>
                                    <th class="text-center" style="width:14%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyPuskesmas"></tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-right"><strong>Total Sampel :</strong></td>
                                    <td class="text-center"><strong id="totalSampel">0</strong></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <button type="button" class="btn btn-outline btn-sm mt-2" id="tambahBaris">
                        <i class="fas fa-plus"></i> Tambah Puskesmas
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-close-modal">Batal</button>
                <button type="submit" name="terimatb" class="btn btn-primary">Terima</button>
            </div>
        </form>
    </div>
</div>

<script>
(function() {
    var tbody = document.getElementById('tbodyPuskesmas');
    var totalEl = document.getElementById('totalSampel');
    var counter = 0;

    function hitungTotal() {
        var total = 0;
        tbody.querySelectorAll('input[name="jumlah[]"]').forEach(function(inp) {
            var v = parseInt(inp.value, 10);
            if (!isNaN(v) && v > 0) total += v;
        });
        totalEl.textContent = total;
    }

    function tambahBaris() {
        counter++;
        var tr = document.createElement('tr');
        tr.innerHTML =
            '<td class="text-center nomorBaris">' + counter + '</td>' +
            '<td><input type="text" name="nama[]" class="form-control form-control-sm" placeholder="Contoh: Puskesmas Selat" required></td>' +
            '<td><input type="number" name="jumlah[]" class="form-control form-control-sm text-center" min="1" placeholder="0" required></td>' +
            '<td class="text-center"><button type="button" class="btn btn-danger btn-sm btn-hapus"><i class="fas fa-times"></i></button></td>';
        tbody.appendChild(tr);

        tr.querySelector('input[name="jumlah[]"]').addEventListener('input', hitungTotal);
        tr.querySelector('.btn-hapus').addEventListener('click', function() {
            tr.remove();
            hitungTotal();
            perbaruiNomor();
        });
        hitungTotal();
    }

    function perbaruiNomor() {
        tbody.querySelectorAll('.nomorBaris').forEach(function(td, idx) {
            td.textContent = idx + 1;
        });
    }

    document.getElementById('tambahBaris').addEventListener('click', tambahBaris);

    // buka modal -> beri satu baris default
    var myModal = document.getElementById('myModal');
    myModal.addEventListener('trendy:open', function() {
        if (tbody.children.length === 0) {
            tambahBaris();
        }
    });

    myModal.addEventListener('trendy:close', function() {
        tbody.innerHTML = '';
        counter = 0;
        totalEl.textContent = '0';
    });
})();
</script>

<?php
$content = ob_get_clean();
require 'layout.php';
?>
