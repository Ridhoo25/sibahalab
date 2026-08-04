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
$sheet->setTitle('Penerimaan HPV DNA');

$sheet->mergeCells('A1:J1');
$sheet->setCellValue('A1', 'DATA PENERIMAAN HPV DNA');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$headers = ['No', 'Tanggal', 'Kabupaten', 'Nama Puskesmas', 'Spesifikasi', 'Jumlah', 'Suhu', 'Harga Satuan', 'Harga Total', 'Status'];
foreach ($headers as $i => $h) {
    $col = chr(65 + $i);
    $sheet->setCellValue($col . '3', $h);
    $sheet->getStyle($col . '3')->getFont()->setBold(true);
    $sheet->getStyle($col . '3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle($col . '3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
}

$data = mysqli_query($conn, "SELECT * FROM sib_hpv_dna ORDER BY id DESC");
$row = 4;
$no = 1;
while ($d = mysqli_fetch_array($data)) {
    $sheet->setCellValue('A' . $row, $no);
    $sheet->setCellValue('B' . $row, $d['tanggal_penerimaan']);
    $sheet->setCellValue('C' . $row, $d['kabupaten'] ?? '-');
    $sheet->setCellValue('D' . $row, $d['nama']);
    $sheet->setCellValue('E' . $row, strtoupper($d['jenis']));
    $sheet->setCellValue('F' . $row, $d['jumlah']);
    $sheet->setCellValue('G' . $row, $d['suhu']);
    $sheet->setCellValue('H' . $row, $d['harga_satuan']);
    $sheet->setCellValue('I' . $row, $d['harga_total']);
    $sheet->setCellValue('J' . $row, $d['status']);

    $sheet->getStyle('A' . $row . ':J' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $sheet->getStyle('H' . $row)->getNumberFormat()->setFormatCode('#,##0');
    $sheet->getStyle('I' . $row)->getNumberFormat()->setFormatCode('#,##0');

    $no++;
    $row++;
}

$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);
$sheet->getColumnDimension('G')->setAutoSize(true);
$sheet->getColumnDimension('H')->setAutoSize(true);
$sheet->getColumnDimension('I')->setAutoSize(true);
$sheet->getColumnDimension('J')->setAutoSize(true);

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Penerimaan_HPVDNA_' . date('Y-m-d') . '.xlsx"');
$writer->save('php://output');
