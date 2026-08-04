<?php
require 'config.php';
require 'auth.php';

$id = (int) ($_GET['id'] ?? 0);
$d = mysqli_fetch_array(mysqli_query(
    $conn,
    "SELECT * FROM sib_pengajuan WHERE id='$id'"
));

if (!$d) {
    header("Location: pengajuan.php");
    exit;
}

ob_start();
?>
<div class="page-header">
    <div>
        <h1>Tracking Pengajuan BHP</h1>
        <p class="page-subtitle">Riwayat status pengajuan bahan habis pakai</p>
    </div>
    <a href="pengajuan.php" class="btn btn-outline">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="data-table-wrapper">
    <div class="table-header">
        <span><i class="fas fa-clipboard-list mr-2"></i>Detail Pengajuan</span>
    </div>
    <div class="table-body">
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <tr>
                    <td width="30%">Nama Barang</td>
                    <td><?= htmlspecialchars($d['nama_bhp']); ?></td>
                </tr>
                <tr>
                    <td>Spesifikasi</td>
                    <td><?= htmlspecialchars($d['spesifikasi']); ?></td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td><?= (int) $d['jumlah']; ?></td>
                </tr>
                <tr>
                    <td>Laboratorium</td>
                    <td><?= htmlspecialchars($d['laboratorium']); ?></td>
                </tr>
                <tr>
                    <td>Pemohon</td>
                    <td><?= htmlspecialchars($d['pemohon']); ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><b><?= htmlspecialchars($d['status']); ?></b></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="data-table-wrapper mt-4">
    <div class="table-header">
        <span><i class="fas fa-history mr-2"></i>Riwayat Status</span>
    </div>
    <div class="card-body">
        <ul class="list-group" style="list-style:none;padding:0;margin:0;">
            <li class="list-group-item" style="border:1px solid var(--border-color);border-radius:var(--radius-sm);padding:0.75rem 1rem;">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge badge-primary">1</span>
                    <div>
                        <b>Diajukan</b><br>
                        <span class="text-muted fs-small"><?= date('d-m-Y H:i', strtotime($d['tanggal'])); ?></span>
                    </div>
                </div>
            </li>

            <?php if ($d['status'] == 'Disetujui') { ?>
            <li class="list-group-item mt-2" style="border:1px solid var(--success);border-radius:var(--radius-sm);padding:0.75rem 1rem;background:rgba(52,199,89,0.06);">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge badge-success">2</span>
                    <div>
                        <b>Disetujui</b><br>
                        <span class="text-muted fs-small"><?= date('d-m-Y H:i', strtotime($d['tgl_disetujui'])); ?> &middot; Oleh: <?= htmlspecialchars($d['diproses_oleh']); ?></span>
                    </div>
                </div>
            </li>
            <?php } ?>

            <?php if ($d['status'] == 'Ditolak') { ?>
            <li class="list-group-item mt-2" style="border:1px solid var(--danger);border-radius:var(--radius-sm);padding:0.75rem 1rem;background:rgba(255,59,48,0.06);">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge badge-danger">2</span>
                    <div>
                        <b>Ditolak</b><br>
                        <span class="text-muted fs-small"><?= date('d-m-Y H:i', strtotime($d['tgl_ditolak'])); ?> &middot; Oleh: <?= htmlspecialchars($d['diproses_oleh']); ?></span><br>
                        <span class="fs-small">Alasan: <?= htmlspecialchars($d['alasan']); ?></span>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>

<?php
$content = ob_get_clean();
require 'layout.php';
