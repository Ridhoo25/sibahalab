<?php
require 'config.php';
require 'auth.php';

if (isset($_POST['adduser'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = mysqli_query($conn, "SELECT email FROM sib_users WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Email sudah terdaftar');window.location='users.php';</script>";
        exit;
    }

    mysqli_query($conn, "INSERT INTO sib_users (nama, email, password) VALUES ('$nama', '$email', '$password')");
    header("Location: users.php");
    exit;
}

if (isset($_POST['updateuser'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $id = (int) $_POST['id_user'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE sib_users SET nama='$nama', email='$email', password='$password' WHERE id='$id'");
    } else {
        mysqli_query($conn, "UPDATE sib_users SET nama='$nama', email='$email' WHERE id='$id'");
    }
    header("Location: users.php");
    exit;
}

if (isset($_POST['deleteuser'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $id = (int) $_POST['id_user'];
    mysqli_query($conn, "DELETE FROM sib_users WHERE id='$id'");
    header("Location: users.php");
    exit;
}

$usersQuery = mysqli_query($conn, "SELECT * FROM sib_users ORDER BY nama ASC");

ob_start();
?>
<div class="page-header">
    <div>
        <h1>Manajemen User</h1>
        <p class="page-subtitle">Kelola data pengguna aplikasi</p>
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        <i class="fas fa-plus"></i> Tambah User
    </button>
</div>

<div class="data-table-wrapper" style="margin-top:1.5rem;">
    <div class="table-header">
        <span><i class="fas fa-users mr-2"></i>Daftar User</span>
        <span class="text-muted fs-small"><?= mysqli_num_rows($usersQuery); ?> user</span>
    </div>
    <div class="table-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    mysqli_data_seek($usersQuery, 0);
                    while($data = mysqli_fetch_array($usersQuery)) {
                        $id_user = $data['id'];
                    ?>
                    <tr>
                        <td class="text-center"><?= $i++; ?></td>
                        <td class="fw-600"><?= htmlspecialchars($data['nama']); ?></td>
                        <td><?= htmlspecialchars($data['email']); ?></td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $id_user; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $id_user; ?>">
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
            <h4>Tambah User</h4>
            <button type="button" class="modal-close">&times;</button>
        </div>
        <form method="post">
            <?= csrf_field() ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama lengkap" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="email@domain.com" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required minlength="6">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-close-modal">Batal</button>
                <button type="submit" name="adduser" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?php
mysqli_data_seek($usersQuery, 0);
while($data = mysqli_fetch_array($usersQuery)) {
    $id_user = $data['id'];
    $nama = $data['nama'];
    $email = $data['email'];
?>

<div class="modal-overlay" id="edit<?= $id_user; ?>">
    <div class="modal">
        <form method="post">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h4>Edit User</h4>
                <button type="button" class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($nama); ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($email); ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password Baru (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" minlength="6">
                </div>
                <input type="hidden" name="id_user" value="<?= $id_user; ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-close-modal">Batal</button>
                <button type="submit" name="updateuser" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="delete<?= $id_user; ?>">
    <div class="modal modal-sm">
        <form method="post">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h4>Hapus User</h4>
                <button type="button" class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <p>Apakah yakin ingin menghapus <strong><?= htmlspecialchars($nama); ?></strong>?</p>
                <input type="hidden" name="id_user" value="<?= $id_user; ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-close-modal">Batal</button>
                <button type="submit" name="deleteuser" class="btn btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>

<?php } ?>

<?php
$content = ob_get_clean();
require 'layout.php';
?>