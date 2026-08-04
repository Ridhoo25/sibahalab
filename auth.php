<?php

$timeout = 900;

if (!isset($_SESSION['log'])) {
    header("location:index.php");
    exit;
}

// cek apakah sudah lewat waktu
if (isset($_SESSION['last_activity'])) {
    if (time() - $_SESSION['last_activity'] > $timeout) {
        session_destroy(); // hapus semua session
        header("location:index.php?pesan=timeout");
        exit;
    }
}

// perbarui waktu aktivitas terakhir
$_SESSION['last_activity'] = time();
?>