<?php
require 'config.php';
require 'auth.php';
ob_start();
?>
<div class="page-header">
    <div>
        <h1>Distribusi BHP</h1>
        <p class="page-subtitle">Surat Bukti Barang Keluar (SBBK)</p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            <i class="fas fa-plus"></i> Distribusi BHP
        </button>
        <a href="export-sbbk.php" class="btn btn-outline">
            <i class="fas fa-file-excel"></i> Export
        </a>
    </div>
</div>

<div class="data-table-wrapper">
    <div class="table-header">
        <span><i class="fas fa-file-alt mr-2"></i>Data SBBK</span>
    </div>
    <div class="table-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">Tanggal</th>
                        <th>No SBBK</th>
                        <th>Laboratorium</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ambilsemuadata = mysqli_query($conn, "SELECT * FROM sib_sbbk ORDER BY id DESC");
                    $list_sbbk = [];
                    while ($data = mysqli_fetch_array($ambilsemuadata)) {
                        $list_sbbk[] = $data;
                    }
                    foreach ($list_sbbk as $data):
                        $tanggal = date('d-m-Y', strtotime($data['tanggal']));
                        $nosbbk = htmlspecialchars($data['no_sbbk']);
                    ?>
                    <tr>
                        <td class="text-center"><?= $tanggal; ?></td>
                        <td class="fw-600"><?= $nosbbk; ?></td>
                        <td><?= htmlspecialchars($data['laboratorium']); ?></td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="print-sbbk.php?id=<?= $data['id']; ?>" target="_blank"
                                    class="btn btn-success btn-sm">
                                    <i class="fas fa-print"></i>
                                </a>
                                <button type="button" class="btn btn-info btn-sm"
                                    onclick="trendy.openModal('detail<?= $data['id']; ?>')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="trendy.openModal('delete<?= $data['id']; ?>')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
foreach ($list_sbbk as $data):
    $tanggal = date('d-m-Y', strtotime($data['tanggal']));
    $nosbbk = htmlspecialchars($data['no_sbbk']);
?>
<div class="modal-overlay" id="delete<?= $data['id']; ?>">
    <div class="modal modal-sm">
        <form method="post">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h4>Hapus SBBK</h4>
                <button type="button" class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <p>Apakah yakin ingin menghapus SBBK <strong><?= $nosbbk; ?></strong>?</p>
                <input type="hidden" name="id_sbbk" value="<?= $data['id']; ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-close-modal">Batal</button>
                <button type="submit" name="deletesbbk" class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="detail<?= $data['id']; ?>">
    <div class="modal modal-lg">
        <div class="modal-header">
            <h4>Detail SBBK: <?= $nosbbk; ?></h4>
            <button type="button" class="modal-close">&times;</button>
        </div>
        <div class="modal-body">
            <div class="grid grid-2 mb-4">
                <div><strong>Tanggal:</strong> <?= $tanggal; ?></div>
                <div><strong>Laboratorium:</strong> <?= htmlspecialchars($data['laboratorium']); ?></div>
                <div><strong>Penerima Akhir:</strong> <?= htmlspecialchars($data['penerima']); ?></div>
                <div><strong>Menyerahkan:</strong> <?= htmlspecialchars($data['serah']); ?></div>
            </div>
            <h5 style="font-size:0.9rem;font-weight:600;margin-bottom:0.75rem;">Detail Barang:</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama BHP</th>
                            <th>Merek</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Exp Date</th>
                            <th>Penerima Awal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $detail_query = mysqli_query($conn, "SELECT t.* FROM sib_sbbk_detail sd JOIN sib_penerimaan t ON sd.id_bhp = t.id WHERE sd.id_sbbk = '" . $data['id'] . "'");
                        while ($detail = mysqli_fetch_array($detail_query)):
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($detail['nama_bhp']); ?></td>
                            <td><?= htmlspecialchars($detail['merek']); ?></td>
                            <td><?= htmlspecialchars($detail['jumlah']); ?></td>
                            <td><?= htmlspecialchars($detail['satuan']); ?></td>
                            <td><?= date('d-m-Y', strtotime($detail['exp_date'])); ?></td>
                            <td><?= htmlspecialchars($detail['penerima']); ?></td>
                        </tr>
<?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline btn-close-modal">Tutup</button>
        </div>
    </div>
</div>
<?php endforeach; ?>

<div class="modal-overlay" id="myModal">
    <div class="modal">
        <div class="modal-header">
            <h4>Distribusi BHP</h4>
            <button type="button" class="modal-close">&times;</button>
        </div>
        <form method="post">
            <?= csrf_field() ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Tanggal Distribusi</label>
                    <input type="date" name="tanggal" class="form-control" required>
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
                    <label class="form-label">Pilih Barang (tersedia)</label>
                    <div class="checkbox-list">
                        <?php
                        $ambilbarang = mysqli_query($conn, "SELECT * FROM sib_penerimaan WHERE status='Tersedia' ORDER BY nama_bhp ASC");
                        while ($b = mysqli_fetch_array($ambilbarang)) {
                        ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="id[]" 
                                value="<?= $b['id']; ?>" id="barang<?= $b['id']; ?>">
                            <label class="form-check-label" for="barang<?= $b['id']; ?>">
                                <?= htmlspecialchars($b['nama_bhp']); ?>
                            </label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Penerima</label>
                    <input type="text" name="terima" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Menyerahkan</label>
                    <select name="serah" class="form-control" required>
                        <option value="">-- Pilih Penyerah --</option>
                        <option value="Dika Apriyanthy, A.Md. Kep">Dika Apriyanthy, A.Md. Kep</option>
                        <option value="M. Jamaudin Ridho, A.Md.T">M. Jamaudin Ridho, A.Md.T</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-close-modal">Batal</button>
                <button type="submit" name="distribusibhp" class="btn btn-primary">Distribusi</button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
require 'layout.php';
?>
