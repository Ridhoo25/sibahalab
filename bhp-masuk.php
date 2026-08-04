<?php
require 'config.php';
require 'auth.php';
ob_start();
?>
<div class="page-header">
    <div>
        <h1>BHP Masuk</h1>
        <p class="page-subtitle">Log barang masuk ke laboratorium</p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            <i class="fas fa-plus"></i> Tambah BHP Masuk
        </button>
        <a href="export-masuk.php" class="btn btn-outline">
            <i class="fas fa-file-excel"></i> Export
        </a>
    </div>
</div>

<div class="data-table-wrapper">
    <div class="table-header">
        <span><i class="fas fa-history mr-2"></i>Riwayat Barang Masuk</span>
    </div>
    <div class="table-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">Tanggal</th>
                        <th>Nama BHP</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Satuan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ambilsemuadatastock = mysqli_query($conn, "SELECT m.tanggal, s.nama_barang, s.satuan, m.qty, m.keterangan FROM sib_bhp_masuk m JOIN sib_bhp s ON s.id = m.id_bhp");
                    while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                    ?>
                    <tr>
                        <td class="text-center"><?= htmlspecialchars($data['tanggal']); ?></td>
                        <td class="fw-600"><?= htmlspecialchars($data['nama_barang']); ?></td>
                        <td class="text-center"><span class="badge badge-primary"><?= $data['qty']; ?></span></td>
                        <td class="text-center"><?= htmlspecialchars($data['satuan']); ?></td>
                        <td><?= htmlspecialchars($data['keterangan']); ?></td>
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
            <h4>Tambah BHP Masuk</h4>
            <button type="button" class="modal-close">&times;</button>
        </div>
        <form method="post">
            <?= csrf_field() ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama BHP</label>
                    <select name="barangnya" class="form-control" required>
                        <option value="">-- Pilih BHP --</option>
                        <?php
                        $ambilsemuadatanya = mysqli_query($conn, "select * from sib_bhp");
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                        ?>
                        <option value="<?= $fetcharray['id']; ?>"><?= htmlspecialchars($fetcharray['nama_barang']); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="qty" class="form-control" placeholder="Jumlah" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-close-modal">Batal</button>
                <button type="submit" name="barangmasuk" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
require 'layout.php';
?>
