<?php
require 'config.php';
require 'auth.php';

$diproses_oleh = mysqli_real_escape_string($conn, $_SESSION['nama'] ?? 'Admin');

// SETUJUI
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi']) && $_POST['aksi'] === 'setujui') {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $id = (int)($_POST['id'] ?? 0);

    mysqli_query($conn,"
        UPDATE sib_pengajuan SET 
            status='Disetujui',
            tgl_disetujui=NOW(),
            diproses_oleh='$diproses_oleh'
        WHERE id='$id'
    ");

    header("location:pengajuan.php");
    exit;
}

// TOLAK
if(isset($_POST['tolak'])){
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $id     = (int)($_POST['id'] ?? 0);
    $alasan = mysqli_real_escape_string($conn, $_POST['alasan']);

    mysqli_query($conn,"
        UPDATE sib_pengajuan SET 
            status='Ditolak',
            alasan='$alasan',
            tgl_ditolak=NOW(),
            diproses_oleh='$diproses_oleh'
        WHERE id='$id'
    ");

    header("location:pengajuan.php");
    exit;
}
