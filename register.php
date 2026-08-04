<?php
require 'config.php';

if (isset($_POST['register'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password !== $password_confirm) {
        echo "<script>alert('Konfirmasi password tidak cocok');window.location='register.php';</script>";
        exit;
    }

    $cek = mysqli_query($conn, "SELECT email FROM sib_users WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Email sudah terdaftar');window.location='register.php';</script>";
        exit;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO sib_users (nama, email, password) VALUES ('$nama', '$email', '$password_hash')");

    echo "<script>alert('Registrasi berhasil, silakan login');window.location='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Si - BAHALAB - Register</title>
    <link rel="icon" href="assets/img/logo.png" type="image/png">
    <link href="css/trendy.css?v=<?= filemtime('css/trendy.css') ?>" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
</head>
<body>
    <div class="login-page">
        <div class="login-card">
            <div class="login-logo">
                <img src="assets/img/logo.png" alt="Si-BAHALAB">
                <h3>Si - BAHALAB</h3>
                <p>Daftar Akun Baru</p>
            </div>
            <form method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label class="form-label" for="nama">Nama Lengkap</label>
                    <input class="form-control" name="nama" id="nama" type="text" placeholder="Masukkan nama" required />
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" name="email" id="email" type="email" placeholder="Masukkan email" required />
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" name="password" id="password" type="password" placeholder="Masukkan password" required />
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirm">Konfirmasi Password</label>
                    <input class="form-control" name="password_confirm" id="password_confirm" type="password" placeholder="Ulangi password" required />
                </div>
                <button class="btn btn-primary btn-block btn-lg" name="register">
                    <i class="fas fa-user-plus"></i> Daftar
                </button>
            </form>
            <div class="login-footer">
                <div>Sudah punya akun? <a href="index.php">Login</a></div>
            </div>
        </div>
    </div>
</body>
</html>
