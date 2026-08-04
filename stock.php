<?php
require 'config.php';
require 'auth.php';

$labCounts = [];
$allLabsQ = mysqli_query($conn, "SELECT DISTINCT lab FROM sib_bhp");
while ($row = mysqli_fetch_assoc($allLabsQ)) {
    $lab = $row['lab'];
    $q = mysqli_query($conn, "SELECT SUM(stok) AS total FROM sib_bhp WHERE lab='$lab'");
    $r = mysqli_fetch_assoc($q);
    $labCounts[$lab] = $r['total'] ?? 0;
}
$totalItems = array_sum($labCounts);

$labOptions = [
    'Laboratorium Hematologi Klinik',
    'Laboratorium Kimia Klinik',
    'Laboratorium Mikrobiologi Klinik',
    'Laboratorium Mikrobiologi Kesehatan Masyarakat',
    'Laboratorium Kimia Kesehatan dan Toksikologi',
    'Laboratorium Biomolekuler',
    'Laboratorium Kalibrasi',
];

ob_start();
?>
<div class="page-header">
    <div>
        <h1>Dashboard Stok BHP</h1>
        <p class="page-subtitle">Monitoring stok bahan habis pakai laboratorium</p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            <i class="fas fa-plus"></i> Tambah Data
        </button>
        <a href="export-stock.php" class="btn btn-outline">
            <i class="fas fa-file-excel"></i> Export
        </a>
    </div>
</div>

<div class="grid grid-4">
    <div class="card stat-card">
        <div class="stat-icon violet"><i class="fas fa-flask"></i></div>
        <div class="stat-info">
            <div class="stat-label">Total Item</div>
            <div class="stat-value"><?= $totalItems; ?></div>
            <div class="stat-desc">Semua laboratorium</div>
        </div>
    </div>
    <?php
    $colorIdx = 0;
    $colors = ['violet', 'blue', 'green', 'orange'];
    foreach ($labCounts as $lab => $count):
    ?>
    <div class="card stat-card">
        <div class="stat-icon <?= $colors[$colorIdx++ % count($colors)]; ?>"><i class="fas fa-box"></i></div>
        <div class="stat-info">
            <div class="stat-label"><?= $lab; ?></div>
            <div class="stat-value"><?= $count; ?></div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php
$lowStockQuery = mysqli_query($conn, "SELECT * FROM sib_bhp WHERE stok <= 5 ORDER BY stok ASC");
$lowStockItems = [];
$lowStockCount = 0;
while ($row = mysqli_fetch_assoc($lowStockQuery)) {
    $lowStockItems[] = $row;
    $lowStockCount++;
}

$ringkasanLimit = 10;
$ringkasanItems = array_slice($lowStockItems, 0, $ringkasanLimit);
$ringkasanSisa = $lowStockCount - count($ringkasanItems);
?>

<div class="card" style="margin-top:1.5rem;<?= $lowStockCount > 0 ? 'border-left:4px solid var(--warning);' : '' ?>">
    <div class="card-header">
        <span><i class="fas fa-exclamation-triangle mr-2" style="color:<?= $lowStockCount > 0 ? 'var(--warning)' : 'var(--success)' ?>"></i>Ringkasan Stok</span>
        <span class="text-muted fs-small"><?= $lowStockCount ?> item stok menipis</span>
    </div>
    <div class="card-body">
        <?php if ($lowStockCount > 0): ?>
        <div class="alert alert-warning" style="margin-bottom:1rem;">
            <i class="fas fa-exclamation-circle"></i>
            Terdapat <strong><?= $lowStockCount ?></strong> item dengan stok menipis (≤5). Segera lakukan pengadaan.
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama BHP</th>
                        <th class="text-center">Stok</th>
                        <th>Laboratorium</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ringkasanItems as $item): ?>
                    <tr>
                        <td class="fw-600"><?= htmlspecialchars($item['nama_barang']); ?></td>
                        <td class="text-center">
                            <span class="badge badge-danger"><?= $item['stok']; ?></span>
                        </td>
                        <td><?= htmlspecialchars($item['lab']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if ($ringkasanSisa > 0): ?>
                    <tr>
                        <td colspan="3" class="text-muted text-center fs-small">
                            ... dan <?= $ringkasanSisa; ?> item lainnya
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="text-center text-muted" style="padding:1.5rem;">
            <i class="fas fa-check-circle" style="font-size:2rem;color:var(--success);"></i>
            <p style="margin-top:0.75rem;font-weight:500;">Semua stok dalam kondisi aman</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="data-table-wrapper" style="margin-top:1.5rem;">
    <div class="table-header">
        <span><i class="fas fa-table mr-2"></i>Data Stok BHP</span>
        <span class="text-muted fs-small"><?= mysqli_num_rows(mysqli_query($conn, "SELECT id FROM sib_bhp")); ?> item</span>
    </div>
    <div class="table-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama BHP</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Satuan</th>
                        <th>Laboratorium</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM sib_bhp");
                    $i = 1;
                    while($data = mysqli_fetch_array($ambilsemuadatastock)) {
                        $id_bhp = $data['id'];
                    ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td class="fw-600"><?= htmlspecialchars($data['nama_barang']); ?></td>
                        <td><?= htmlspecialchars($data['deskripsi']); ?></td>
                        <td class="text-center"><span class="badge badge-primary"><?= $data['stok']; ?></span></td>
                        <td class="text-center"><?= htmlspecialchars($data['satuan']); ?></td>
                        <td><?= htmlspecialchars($data['lab']); ?></td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $id_bhp; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $id_bhp; ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
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
            <h4>Tambah Barang</h4>
            <button type="button" class="modal-close">&times;</button>
        </div>
        <form method="post">
            <?= csrf_field() ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama BHP</label>
                    <input type="text" name="nama_barang" class="form-control" placeholder="Nama BHP" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jumlah Stok</label>
                    <input type="number" name="stok" class="form-control" placeholder="Jumlah Stok" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Satuan</label>
                    <input type="text" name="satuan" class="form-control" placeholder="Satuan (pcs, box, dll)" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Laboratorium</label>
                    <select name="lab" class="form-control" required>
                        <option value="">-- Pilih Laboratorium --</option>
                        <?php foreach ($labOptions as $opt): ?>
                        <option value="<?= $opt; ?>"><?= $opt; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-close-modal">Batal</button>
                <button type="submit" name="addnewbarang" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?php
$ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM sib_bhp");
while($data = mysqli_fetch_array($ambilsemuadatastock)) {
    $id_bhp  = $data['id'];
    $nama_barang = $data['nama_barang'];
    $deskripsi = $data['deskripsi'];
    $stok = $data['stok'];
    $satuan = $data['satuan'];
    $lab = $data['lab'];
?>

<div class="modal-overlay" id="edit<?= $id_bhp; ?>">
    <div class="modal">
        <form method="post">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h4>Edit Barang</h4>
                <button type="button" class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama BHP</label>
                    <input type="text" name="nama_barang" value="<?= htmlspecialchars($nama_barang); ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <input type="text" name="deskripsi" value="<?= htmlspecialchars($deskripsi); ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jumlah Stok</label>
                    <input type="number" name="stok" value="<?= $stok; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Satuan</label>
                    <input type="text" name="satuan" value="<?= htmlspecialchars($satuan); ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Laboratorium</label>
                    <select name="lab" class="form-control" required>
                        <option value="">-- Pilih Laboratorium --</option>
                        <?php foreach ($labOptions as $opt): ?>
                        <option value="<?= $opt; ?>" <?= $lab === $opt ? 'selected' : ''; ?>><?= $opt; ?></option>
                        <?php endforeach; ?>
                        <?php if (!in_array($lab, $labOptions)): ?>
                        <option value="<?= htmlspecialchars($lab); ?>" selected><?= htmlspecialchars($lab); ?></option>
                        <?php endif; ?>
                    </select>
                </div>
                <input type="hidden" name="id_bhp" value="<?= $id_bhp; ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-close-modal">Batal</button>
                <button type="submit" name="updatebarang" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="delete<?= $id_bhp; ?>">
    <div class="modal modal-sm">
        <form method="post">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h4>Hapus Barang</h4>
                <button type="button" class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <p>Apakah yakin ingin menghapus <strong><?= htmlspecialchars($nama_barang); ?></strong>?</p>
                <input type="hidden" name="id_bhp" value="<?= $id_bhp; ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-close-modal">Batal</button>
                <button type="submit" name="deletebarang" class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>

<?php } ?>

<?php
$content = ob_get_clean();
require 'layout.php';
?>
