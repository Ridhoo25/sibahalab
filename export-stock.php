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
$sheet->setTitle('Data Stok BHP');

$sheet->mergeCells('A1:F1');
$sheet->setCellValue('A1', 'DATA STOK BHP');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$headers = ['No', 'Nama BHP', 'Deskripsi', 'Stok', 'Satuan', 'Laboratorium'];
foreach ($headers as $i => $h) {
    $col = chr(65 + $i);
    $sheet->setCellValue($col . '3', $h);
    $sheet->getStyle($col . '3')->getFont()->setBold(true);
    $sheet->getStyle($col . '3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle($col . '3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
}

$data = mysqli_query($conn, "SELECT * FROM sib_bhp ORDER BY nama_barang ASC");
$row = 4;
$no = 1;
while ($d = mysqli_fetch_array($data)) {
    $sheet->setCellValue('A' . $row, $no);
    $sheet->setCellValue('B' . $row, $d['nama_barang']);
    $sheet->setCellValue('C' . $row, $d['deskripsi']);
    $sheet->setCellValue('D' . $row, $d['stok']);
    $sheet->setCellValue('E' . $row, $d['satuan']);
    $sheet->setCellValue('F' . $row, $d['lab']);

    $sheet->getStyle('A' . $row . ':F' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $no++;
    $row++;
}

$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data_Stok_BHP_' . date('Y-m-d') . '.xlsx"');
$writer->save('php://output');
