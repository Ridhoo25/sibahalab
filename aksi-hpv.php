<?php
require 'config.php';
require 'auth.php';

$diproses_oleh = mysqli_real_escape_string($conn, $_SESSION['nama'] ?? 'Admin');

/* =====================
   KERJAKAN (SUDAH DIKERJAKAN)
===================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi']) && $_POST['aksi'] === 'setujui') {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }

    $id = (int) $_POST['id'];

    mysqli_query($conn, "
        UPDATE sib_hpv_dna
        SET 
            status = 'Sudah Dikerjakan',
            tgl_disetujui = NOW(),
            diproses_oleh = '$diproses_oleh'
        WHERE id = $id
          AND status = 'Belum Dikerjakan'
    ");

    header("Location: hpv-dna.php");
    exit;
}
