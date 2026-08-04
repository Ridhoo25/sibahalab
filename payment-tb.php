<?php
require 'config.php';
require 'auth.php';

$rows_tagihan = get_rows_tagihan_tb();
$total_tagihan = 0;
foreach ($rows_tagihan as $r) {
    $total_tagihan += $r['hargatotal'];
}

$payments = [];
$q = mysqli_query($conn, "SELECT kabupaten, tanggal, status, tgl_paid, diproses_oleh FROM sib_payment_tb");
while ($r = mysqli_fetch_assoc($q)) {
    $payments[strtolower($r['kabupaten']) . '|' . $r['tanggal']] = $r;
}

foreach ($rows_tagihan as $idx => $r) {
    $key = strtolower($r['namakabupaten']) . '|' . $r['tanggaltb'];
    $p = $payments[$key] ?? null;
    if ($p) {
        $rows_tagihan[$idx]['pay_status'] = $p['status'];
        $rows_tagihan[$idx]['tgl_paid'] = $p['tgl_paid'];
        $rows_tagihan[$idx]['diproses_oleh'] = $p['diproses_oleh'];
    } else {
        $rows_tagihan[$idx]['pay_status'] = 'Unpaid';
        $rows_tagihan[$idx]['tgl_paid'] = null;
        $rows_tagihan[$idx]['diproses_oleh'] = null;
    }
}

ob_start();
?>
<div class="page-header">
    <div>
        <h1>Payment TB</h1>
        <p class="page-subtitle">Rekapitulasi tagihan/klaim pemeriksaan spesimen TB</p>
    </div>
</div>

<div class="data-table-wrapper">
    <div class="table-header">
        <span><i class="fas fa-money-bill mr-2"></i>Status Pembayaran Tagihan</span>
    </div>
    <div class="table-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Tanggal Kirim</th>
                        <th>Kabupaten</th>
                        <th>Puskesmas</th>
                        <th class="text-center">Jumlah Sampel</th>
                        <th class="text-center">Total Tagihan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($rows_tagihan as $r): ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td><?= htmlspecialchars($r['tanggal']); ?></td>
                        <td class="fw-600"><?= htmlspecialchars($r['namakabupaten']); ?></td>
                        <td>
                            <?php foreach ($r['puskesmas_list'] as $pl): ?>
                            <div class="hpv-puskesmas-line"><?= htmlspecialchars($pl); ?></div>
                            <?php endforeach; ?>
                        </td>
                        <td class="text-center"><?= (int) $r['jumlah']; ?> sampel</td>
                        <td class="text-center">Rp <?= number_format($r['hargatotal'], 0, ',', '.'); ?></td>
                        <td class="text-center">
                            <?php if ($r['pay_status'] === 'Paid'): ?>
                            <span class="badge badge-success">Paid</span>
                            <?php else: ?>
                            <span class="badge badge-danger">Unpaid</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <?php if ($r['pay_status'] === 'Unpaid'): ?>
                                <form method="post" action="aksi-payment-tb.php" class="d-inline"
                                    onsubmit="return confirm('Tandai PAID untuk tagihan <?= htmlspecialchars($r['namakabupaten']); ?> (<?= htmlspecialchars($r['tanggal']); ?>)?')">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="aksi" value="paid">
                                    <input type="hidden" name="kabupaten" value="<?= htmlspecialchars($r['namakabupaten']); ?>">
                                    <input type="hidden" name="tgl" value="<?= htmlspecialchars($r['tanggaltb']); ?>">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i> Paid
                                    </button>
                                </form>
                                <?php else: ?>
                                <form method="post" action="aksi-payment-tb.php" class="d-inline"
                                    onsubmit="return confirm('Ubah kembali ke UNPAID untuk tagihan <?= htmlspecialchars($r['namakabupaten']); ?> (<?= htmlspecialchars($r['tanggal']); ?>)?')">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="aksi" value="unpaid">
                                    <input type="hidden" name="kabupaten" value="<?= htmlspecialchars($r['namakabupaten']); ?>">
                                    <input type="hidden" name="tgl" value="<?= htmlspecialchars($r['tanggaltb']); ?>">
                                    <button type="submit" class="btn btn-warning btn-sm">
                                        <i class="fas fa-undo"></i> Unpaid
                                    </button>
                                </form>
                                <?php endif; ?>
                                <a href="invoice-tb.php?kabupaten=<?= urlencode($r['namakabupaten']); ?>&tgl=<?= urlencode($r['tanggaltb']); ?>" target="_blank"
                                    class="btn btn-danger btn-sm" title="Cetak Invoice PDF">
                                    <i class="fas fa-print"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total</strong></td>
                        <td class="text-center fw-600"><?= array_sum(array_column($rows_tagihan, 'jumlah')); ?> sampel</td>
                        <td class="text-center fw-600">Rp <?= number_format($total_tagihan, 0, ',', '.'); ?></td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require 'layout.php';
?>
