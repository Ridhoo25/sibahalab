<?php
require 'config.php';
require 'auth.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('SBBK');

$sheet->mergeCells('A1:G1');
$sheet->setCellValue('A1', 'DATA SURAT BUKTI BARANG KELUAR (SBBK)');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$headers = ['No SBBK', 'Tanggal', 'Laboratorium', 'Nama BHP', 'Merek', 'Jumlah', 'Satuan'];
foreach ($headers as $i => $h) {
    $col = chr(65 + $i);
    $sheet->setCellValue($col . '3', $h);
    $sheet->getStyle($col . '3')->getFont()->setBold(true);
    $sheet->getStyle($col . '3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle($col . '3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
}

$data = mysqli_query($conn, "
    SELECT s.no_sbbk, s.tanggal, s.laboratorium, t.nama_bhp, t.merek, t.jumlah, t.satuan
    FROM sib_sbbk s
    JOIN sib_sbbk_detail sd ON sd.id_sbbk = s.id
    JOIN sib_penerimaan t ON t.id = sd.id_bhp
    ORDER BY s.id DESC
");
$row = 4;
while ($d = mysqli_fetch_array($data)) {
    $sheet->setCellValue('A' . $row, $d['no_sbbk']);
    $sheet->setCellValue('B' . $row, $d['tanggal']);
    $sheet->setCellValue('C' . $row, $d['laboratorium']);
    $sheet->setCellValue('D' . $row, $d['nama_bhp']);
    $sheet->setCellValue('E' . $row, $d['merek']);
    $sheet->setCellValue('F' . $row, $d['jumlah']);
    $sheet->setCellValue('G' . $row, $d['satuan']);

    $sheet->getStyle('A' . $row . ':G' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $sheet->getStyle('F' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $row++;
}

$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);
$sheet->getColumnDimension('G')->setAutoSize(true);

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="SBBK_' . date('Y-m-d') . '.xlsx"');
$writer->save('php://output');
