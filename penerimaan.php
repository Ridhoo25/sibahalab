<?php
require 'config.php';
require 'auth.php';

$dashLab = [];
$dashQuery = mysqli_query($conn, "SELECT laboratorium, SUM(jumlah) AS total_jml, COUNT(*) AS transaksi FROM sib_penerimaan GROUP BY laboratorium ORDER BY total_jml DESC");
while ($r = mysqli_fetch_assoc($dashQuery)) {
    $dashLab[$r['laboratorium']] = ['jumlah' => (int) $r['total_jml'], 'transaksi' => (int) $r['transaksi']];
}

$dashJumlah = 0;
$dashTransaksi = 0;
foreach ($dashLab as $s) {
    $dashJumlah += $s['jumlah'];
    $dashTransaksi += $s['transaksi'];
}

ob_start();
?>
<div class="page-header">
    <div>
        <h1>Penerimaan BHP</h1>
        <p class="page-subtitle">Monitoring penerimaan bahan habis pakai</p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            <i class="fas fa-plus"></i> Tambah Penerimaan
        </button>
        <a href="export-penerimaan.php" class="btn btn-outline">
            <i class="fas fa-file-excel"></i> Export
        </a>
    </div>
</div>

<div class="grid grid-4">
    <div class="card stat-card">
        <div class="stat-icon violet"><i class="fas fa-boxes"></i></div>
        <div class="stat-info">
            <div class="stat-label">Total Penerimaan</div>
            <div class="stat-value"><?= $dashJumlah; ?></div>
            <div class="stat-desc">Semua laboratorium</div>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon blue"><i class="fas fa-file-invoice"></i></div>
        <div class="stat-info">
            <div class="stat-label">Total Transaksi</div>
            <div class="stat-value"><?= $dashTransaksi; ?></div>
            <div class="stat-desc">Semua laboratorium</div>
        </div>
    </div>
    <?php
    $colorIdx = 0;
    $colors = ['green', 'orange', 'violet', 'blue'];
    foreach ($dashLab as $lab => $s):
    ?>
    <div class="card stat-card">
        <div class="stat-icon <?= $colors[$colorIdx++ % count($colors)]; ?>"><i class="fas fa-flask"></i></div>
        <div class="stat-info">
            <div class="stat-label"><?= htmlspecialchars($lab); ?></div>
            <div class="stat-value"><?= $s['jumlah']; ?></div>
            <div class="stat-desc"><?= $s['transaksi']; ?> transaksi</div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="data-table-wrapper" style="margin-top:1.5rem;">
    <div class="table-header">
        <span><i class="fas fa-inbox mr-2"></i>Data Penerimaan BHP</span>
        <span class="text-muted fs-small"><?= mysqli_num_rows(mysqli_query($conn, "SELECT id FROM sib_penerimaan")); ?> record</span>
    </div>
    <div class="table-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">Tanggal</th>
                        <th>Nama BHP</th>
                        <th>Merek</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Satuan</th>
                        <th class="text-center">Exp Date</th>
                        <th>Laboratorium</th>
                        <th>Penerima</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ambilsemuadata = mysqli_query($conn, "SELECT * FROM sib_penerimaan ORDER BY id DESC");
                    while ($data = mysqli_fetch_array($ambilsemuadata)) {
                        $status = $data['status'];
                        $badgeClass = $status == 'Tersedia' ? 'badge-success' : ($status == 'Sudah Didistribusikan' ? 'badge-info' : 'badge-secondary');
                    ?>
                    <tr>
                        <td class="text-center"><?= date('d-m-Y', strtotime($data['tanggal'])); ?></td>
                        <td class="fw-600"><?= htmlspecialchars($data['nama_bhp']); ?></td>
                        <td><?= htmlspecialchars($data['merek']); ?></td>
                        <td class="text-center"><?= $data['jumlah']; ?></td>
                        <td class="text-center"><?= htmlspecialchars($data['satuan']); ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($data['exp_date'])); ?></td>
                        <td><?= htmlspecialchars($data['laboratorium']); ?></td>
                        <td><?= htmlspecialchars($data['penerima']); ?></td>
                        <td class="text-center"><span class="badge <?= $badgeClass; ?>"><?= $status; ?></span></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal-overlay" id="myModal">
    <div class="modal">
        <div class="modal-header">
            <h4>Tambah Penerimaan BHP</h4>
            <button type="button" class="modal-close">&times;</button>
        </div>
        <form method="post">
            <?= csrf_field() ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Tanggal Terima</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama BHP</label>
                    <input type="text" name="nama_bhp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Merek</label>
                    <input type="text" name="merek" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" min="1" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Satuan</label>
                    <input type="text" name="satuan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Exp Date</label>
                    <input type="date" name="exp_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Laboratorium</label>
                    <select name="laboratorium" class="form-control" required>
                        <option value="">-- Pilih Laboratorium --</option>
                        <option value="Laboratorium Hematologi Klinik">Laboratorium Hematologi Klinik</option>
                        <option value="Laboratorium Kimia Klinik">Laboratorium Kimia Klinik</option>
                        <option value="Laboratorium Mikrobiologi Klinik">Laboratorium Mikrobiologi Klinik</option>
                        <option value="Laboratorium Mikrobiologi Kesehatan Masyarakat">Laboratorium Mikrobiologi Kesehatan Masyarakat</option>
                        <option value="Laboratorium Kimia Kesehatan dan Toksikologi">Laboratorium Kimia Kesehatan dan Toksikologi</option>
                        <option value="Laboratorium Biomolekuler">Laboratorium Biomolekuler</option>
                        <option value="Laboratorium Kalibrasi">Laboratorium Kalibrasi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Penerima</label>
                    <select name="penerima" class="form-control" required>
                        <option value="">-- Pilih Penerima --</option>
                        <option value="Dika Apriyanthy, A.Md. Kep">Dika Apriyanthy, A.Md. Kep</option>
                        <option value="M. Jamaudin Ridho, A.Md.T">M. Jamaudin Ridho, A.Md.T</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-close-modal">Batal</button>
                <button type="submit" name="terimabhp" class="btn btn-primary">Terima</button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
require 'layout.php';
?>
