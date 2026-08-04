<?php
require 'config.php';
require 'auth.php';
$data = mysqli_query($conn, "SELECT * FROM sib_pengajuan ORDER BY id DESC");
$list_pengajuan = [];
while ($row = mysqli_fetch_array($data)) {
    $list_pengajuan[] = $row;
}

$dashStatus = ['Diajukan' => 0, 'Disetujui' => 0, 'Ditolak' => 0, 'Diproses' => 0, 'Selesai' => 0];
$dashJumlah = 0;
$dashLab = [];
foreach ($list_pengajuan as $p) {
    $dashStatus[$p['status']] = ($dashStatus[$p['status']] ?? 0) + 1;
    $dashJumlah += (int) $p['jumlah'];
    $lab = $p['laboratorium'];
    if (!isset($dashLab[$lab])) {
        $dashLab[$lab] = ['jumlah' => 0, 'rek' => 0];
    }
    $dashLab[$lab]['jumlah'] += (int) $p['jumlah'];
    $dashLab[$lab]['rek']++;
}
$dashTotal = count($list_pengajuan);

ob_start();
?>
<div class="page-header">
    <div>
        <h1>Pengajuan BHP</h1>
        <p class="page-subtitle">Pengajuan pembelian bahan habis pakai laboratorium</p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            <i class="fas fa-plus"></i> Tambah Pengajuan
        </button>
        <a href="export-pengajuan.php" class="btn btn-outline">
            <i class="fas fa-file-excel"></i> Export
        </a>
    </div>
</div>

<div class="grid grid-4">
    <div class="card stat-card">
        <div class="stat-icon violet"><i class="fas fa-clipboard-list"></i></div>
        <div class="stat-info">
            <div class="stat-label">Total Pengajuan</div>
            <div class="stat-value"><?= $dashTotal; ?></div>
            <div class="stat-desc">Semua laboratorium</div>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon green"><i class="fas fa-cubes"></i></div>
        <div class="stat-info">
            <div class="stat-label">Total Jumlah</div>
            <div class="stat-value"><?= $dashJumlah; ?></div>
            <div class="stat-desc">Semua pengajuan</div>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon orange"><i class="fas fa-hourglass-half"></i></div>
        <div class="stat-info">
            <div class="stat-label">Menunggu Persetujuan</div>
            <div class="stat-value"><?= $dashStatus['Diajukan']; ?></div>
            <div class="stat-desc">Status Diajukan</div>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon blue"><i class="fas fa-check-circle"></i></div>
        <div class="stat-info">
            <div class="stat-label">Disetujui</div>
            <div class="stat-value"><?= $dashStatus['Disetujui']; ?></div>
            <div class="stat-desc">Ditolak: <?= $dashStatus['Ditolak']; ?></div>
        </div>
    </div>
</div>

<div class="grid grid-4" style="margin-top:1.5rem;">
    <?php
    $colorIdx = 0;
    $colors = ['violet', 'blue', 'green', 'orange'];
    foreach ($dashLab as $lab => $s):
    ?>
    <div class="card stat-card">
        <div class="stat-icon <?= $colors[$colorIdx++ % count($colors)]; ?>"><i class="fas fa-flask"></i></div>
        <div class="stat-info">
            <div class="stat-label"><?= htmlspecialchars($lab); ?></div>
            <div class="stat-value"><?= $s['jumlah']; ?></div>
            <div class="stat-desc"><?= $s['rek']; ?> pengajuan</div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="data-table-wrapper" style="margin-top:1.5rem;">
    <div class="table-header">
        <span><i class="fas fa-clipboard-list mr-2"></i>Data Pengajuan BHP</span>
    </div>
    <div class="table-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Tanggal</th>
                        <th>Nama BHP</th>
                        <th>Spesifikasi</th>
                        <th class="text-center">Jumlah</th>
                        <th>Satuan</th>
                        <th>Laboratorium</th>
                        <th>Pemohon</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                        <th class="text-center">Tracking</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($list_pengajuan as $d): 
                        $status = $d['status'];
                        $badgeClass = $status == 'Disetujui' ? 'badge-success' : ($status == 'Ditolak' ? 'badge-danger' : 'badge-warning');
                    ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td><?= htmlspecialchars($d['tanggal']); ?></td>
                        <td class="fw-600"><?= htmlspecialchars($d['nama_bhp']); ?></td>
                        <td><?= htmlspecialchars($d['spesifikasi']); ?></td>
                        <td class="text-center"><?= $d['jumlah']; ?></td>
                        <td><?= htmlspecialchars($d['satuan']); ?></td>
                        <td><?= htmlspecialchars($d['laboratorium']); ?></td>
                        <td><?= htmlspecialchars($d['pemohon']); ?></td>
                        <td class="text-center"><span class="badge <?= $badgeClass; ?>"><?= $status; ?></span></td>
                        <td class="text-center">
                            <?php if ($d['status'] == 'Diajukan') { ?>
                            <div class="d-flex gap-2 justify-content-center">
                                <form method="post" action="aksi-pengajuan.php" class="d-inline" onsubmit="return confirm('Setujui pengajuan ini?')">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="aksi" value="setujui">
                                    <input type="hidden" name="id" value="<?= $d['id']; ?>">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#tolak<?= $d['id']; ?>">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <?php } else { echo '<span class="text-muted">-</span>'; } ?>
                        </td>
                        <td class="text-center">
                            <a href="tracking-pengajuan.php?id=<?= $d['id']; ?>"
                                class="btn btn-info btn-sm">
                                <i class="fas fa-search"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal-overlay" id="myModal">
    <div class="modal">
        <div class="modal-header">
            <h4>Tambah Pengajuan BHP</h4>
            <button type="button" class="modal-close">&times;</button>
        </div>
        <form method="post">
            <?= csrf_field() ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama BHP</label>
                    <input type="text" name="nama_bhp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Spesifikasi</label>
                    <textarea name="spesifikasi" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Satuan</label>
                    <input type="text" name="satuan" class="form-control" required>
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
                    <label class="form-label">Pemohon</label>
                    <input type="text" name="pemohon" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-close-modal">Batal</button>
                <button type="submit" name="ajukan" class="btn btn-primary">Ajukan</button>
            </div>
        </form>
    </div>
</div>

<?php
foreach ($list_pengajuan as $d):
    if ($d['status'] == 'Diajukan'):
?>
<div class="modal-overlay" id="tolak<?= $d['id']; ?>">
    <div class="modal">
        <form method="post" action="aksi-pengajuan.php">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5>Alasan Penolakan</h5>
                <button type="button" class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="<?= $d['id']; ?>">
                <div class="form-group">
                    <label class="form-label">Alasan</label>
                    <textarea name="alasan" class="form-control" required placeholder="Masukkan alasan penolakan"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-close-modal">Batal</button>
                <button type="submit" name="tolak" class="btn btn-danger">Tolak Pengajuan</button>
            </div>
        </form>
    </div>
</div>
<?php endif; endforeach; ?>

<?php
$content = ob_get_clean();
require 'layout.php';
?>
