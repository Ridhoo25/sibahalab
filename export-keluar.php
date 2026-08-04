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
$sheet->setTitle('BHP Keluar');

$sheet->mergeCells('A1:E1');
$sheet->setCellValue('A1', 'DATA BHP KELUAR');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$headers = ['Tanggal', 'Nama BHP', 'Jumlah', 'Satuan', 'Penerima'];
foreach ($headers as $i => $h) {
    $col = chr(65 + $i);
    $sheet->setCellValue($col . '3', $h);
    $sheet->getStyle($col . '3')->getFont()->setBold(true);
    $sheet->getStyle($col . '3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle($col . '3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
}

$data = mysqli_query($conn, "SELECT k.*, s.nama_barang, s.satuan FROM sib_bhp_keluar k JOIN sib_bhp s ON s.id = k.id_bhp ORDER BY k.id_bhp DESC");
$row = 4;
while ($d = mysqli_fetch_array($data)) {
    $sheet->setCellValue('A' . $row, $d['tanggal']);
    $sheet->setCellValue('B' . $row, $d['nama_barang']);
    $sheet->setCellValue('C' . $row, $d['qty']);
    $sheet->setCellValue('D' . $row, $d['satuan']);
    $sheet->setCellValue('E' . $row, $d['penerima']);

    $sheet->getStyle('A' . $row . ':E' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $sheet->getStyle('C' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $row++;
}

$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="BHP_Keluar_' . date('Y-m-d') . '.xlsx"');
$writer->save('php://output');
