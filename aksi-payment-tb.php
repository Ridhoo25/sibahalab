<?php
require 'config.php';
require 'auth.php';

$diproses_oleh = mysqli_real_escape_string($conn, $_SESSION['nama'] ?? 'Admin');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aksi'])) {
    if (!verify_csrf_token($_POST['_csrf_token'] ?? '')) { die('CSRF token tidak valid'); }
    $aksi = $_POST['aksi'];
    $kabupaten = $_POST['kabupaten'] ?? '';
    $tanggal = $_POST['tgl'] ?? $_POST['tanggal'] ?? '';

    if (in_array($aksi, ['paid', 'unpaid']) && $kabupaten !== '' && $tanggal !== '') {
        $kab = mysqli_real_escape_string($conn, $kabupaten);
        $tgl = mysqli_real_escape_string($conn, $tanggal);
        $status = ($aksi === 'paid') ? 'Paid' : 'Unpaid';

        $q = mysqli_query($conn, "SELECT id FROM sib_payment_tb WHERE kabupaten = '$kab' AND tanggal = '$tgl'");
        if (mysqli_num_rows($q) > 0) {
            $tglPaid = ($status === 'Paid') ? ", tgl_paid = NOW(), diproses_oleh = '$diproses_oleh'" : ", tgl_paid = NULL, diproses_oleh = NULL";
            mysqli_query($conn, "UPDATE sib_payment_tb SET status = '$status' $tglPaid WHERE kabupaten = '$kab' AND tanggal = '$tgl'");
        } else {
            $tglPaid = ($status === 'Paid') ? ", NOW(), '$diproses_oleh'" : ", NULL, NULL";
            mysqli_query($conn, "INSERT INTO sib_payment_tb (kabupaten, tanggal, status, tgl_paid, diproses_oleh) VALUES ('$kab', '$tgl', '$status' $tglPaid)");
        }
    }
}

header("Location: payment-tb.php");
exit;
