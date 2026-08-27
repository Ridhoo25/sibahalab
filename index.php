<?php
require 'config.php';

if (isset($_SESSION['log'])) {
    header('location:stock.php');
    exit;
}

function buat_soal_captcha() {
    $ops = ['+', '-', 'x'];
    $op = $ops[array_rand($ops)];
    if ($op === '+') {
        $a = rand(1, 20);
        $b = rand(1, 20);
        $jawaban = $a + $b;
    } elseif ($op === '-') {
        $a = rand(1, 20);
        $b = rand(1, $a);
        $jawaban = $a - $b;
    } else {
        $a = rand(2, 9);
        $b = rand(2, 9);
        $jawaban = $a * $b;
    }
    $_SESSION['captcha_jawaban'] = $jawaban;
    $_SESSION['captcha_soal'] = "$a $op $b";
    return "$a $op $b";
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['captcha_jawaban'])) {
    buat_soal_captcha();
}
$soal_captcha = $_SESSION['captcha_soal'] ?? '?';

if (isset($_POST['login'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $jawabanCaptcha = (int) ($_POST['captcha'] ?? '');
    $benarCaptcha = isset($_SESSION['captcha_jawaban']) && $jawabanCaptcha === (int) $_SESSION['captcha_jawaban'];

    if (!$benarCaptcha) {
        unset($_SESSION['captcha_jawaban']);
        header('location:index.php?pesan=captcha');
        exit;
    }

    $query = mysqli_query($conn, "SELECT * FROM sib_users WHERE email='$email'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        if (password_verify($password, $data['password'])) {

            if (password_needs_rehash($data['password'], PASSWORD_DEFAULT)) {
                $hashBaru = password_hash($password, PASSWORD_DEFAULT);
                mysqli_query($conn, "UPDATE sib_users SET password='$hashBaru' WHERE email='$email'");
            }

            unset($_SESSION['captcha_jawaban']);
            session_regenerate_id(true);
            $_SESSION['log'] = true;
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['last_activity'] = time();
            header('location:stock.php');
            exit;
        }

        header('location:index.php?pesan=gagal');
        exit;
    }

    header('location:index.php?pesan=gagal');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Si - BAHALAB - Login</title>
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
                <p>Digitalisasi Bahan Habis Pakai Laboratorium</p>
            </div>

            <?php if (isset($_GET['pesan'])): ?>
                <div class="login-error">
                    <?php
                    if ($_GET['pesan'] == 'gagal') {
                        echo '<i class="fas fa-exclamation-circle"></i> Email atau Password salah!';
                    } elseif ($_GET['pesan'] == 'timeout') {
                        echo '<i class="fas fa-clock"></i> Sesi Anda telah habis, silakan login kembali.';
                    } elseif ($_GET['pesan'] == 'captcha') {
                        echo '<i class="fas fa-exclamation-circle"></i> Jawaban verifikasi salah, silakan coba lagi!';
                    }
                    ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" name="email" id="email" type="email" placeholder="Masukkan email" required />
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" name="password" id="password" type="password" placeholder="Masukkan password" required />
                </div>
                <div class="form-group">
                    <label class="form-label" for="captcha">Verifikasi Keamanan</label>
                    <div class="login-captcha">
                        <div class="login-captcha-soal"><?= htmlspecialchars($soal_captcha); ?> =</div>
                        <input class="form-control login-captcha-input" name="captcha" id="captcha" type="text" inputmode="numeric" placeholder="?" required />
                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg" name="login">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk
                </button>
            </form>

            <div class="login-footer">
                <div>Belum punya akun? <a href="register.php">Daftar disini</a></div>
                <div style="margin-top:0.5rem;">Copyright &copy; <a href="https://www.instagram.com/ridhooe_/" target="_blank" rel="noopener" class="login-footer-link">RNC Systems 2025</a></div>
                <div>Laboratorium Kesehatan dan Kalibrasi Provinsi Kalimantan Tengah</div>
            </div>
        </div>
    </div>
</body>
</html>