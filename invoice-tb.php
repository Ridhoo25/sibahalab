<?php
require 'config.php';
require 'auth.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$kabupaten = $_GET['kabupaten'] ?? '';
$bulan = $_GET['bulan'] ?? '';
$tahun = $_GET['tahun'] ?? '';
$nomor = $_GET['nomor'] ?? '';
$tanggal = $_GET['tanggal'] ?? '';
$tgl = $_GET['tgl'] ?? '';

$rows_tagihan = get_rows_tagihan_tb($kabupaten, $bulan, $tahun, $tgl);
$total_tagihan = 0;
foreach ($rows_tagihan as $r) {
    $total_tagihan += $r['hargatotal'];
}

$nomor_tagihan = $nomor;
$tanggal_tagihan = $tanggal ? date('d-m-Y', strtotime($tanggal)) : date('d-m-Y');
$kabupaten_tagihan = $kabupaten;
$kop_src = str_replace('\\', '/', __DIR__) . '/assets/img/kop.png';

ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <style>
        @page { size: A4 portrait; margin: 15mm 18mm 15mm 18mm; }
        body { font-family: 'DejaVu Sans', Arial, sans-serif; font-size: 11px; color: #000; }
        .invoice-kop { text-align: center; margin-bottom: 8px; }
        .invoice-kop-img { width: 100%; max-width: 100%; }
        .invoice-title { text-align: center; font-size: 14px; font-weight: bold; margin: 10px 0 12px; }
        .invoice-meta { width: 100%; margin-bottom: 12px; }
        .invoice-meta-left { width: 55%; vertical-align: top; }
        .invoice-meta-right { width: 45%; vertical-align: top; }
        .invoice-table { width: 100%; border-collapse: collapse; }
        .invoice-table th, .invoice-table td { border: 1px solid #000; }
        .invoice-table thead th { background: #eee; font-size: 10px; text-align: center; }
        .inv-no { width: 6%; text-align: center; }
        .inv-tgl { width: 14%; text-align: center; }
        .inv-puskesmas { width: 32%; }
        .inv-puskesmas-detail { font-size: 8px; color: #555; font-style: italic; margin-top: 2px; }
        .inv-jml { width: 12%; text-align: center; }
        .inv-harga { width: 18%; text-align: right; }
        .inv-total { width: 18%; text-align: right; font-weight: bold; }
        .inv-terbilang { text-align: left; font-style: italic; }
        .inv-grandtotal { text-align: center; font-weight: bold; }
        .inv-grandtotal-nominal { font-size: 13px; }
        .invoice-bottom { width: 100%; margin-top: 16px; }
        .invoice-bank { width: 50%; vertical-align: bottom; font-size: 10px; }
        .invoice-sign { width: 50%; text-align: center; vertical-align: bottom; }
    </style>
</head>
<body>
    <?php include 'template-invoice-tb.php'; ?>
</body>
</html>
<?php
$html = ob_get_clean();

$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('defaultFont', 'DejaVu Sans');
$options->set('chroot', [__DIR__]);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('Tagihan_TB_' . date('Y-m-d') . '.pdf', ['Attachment' => true]);
