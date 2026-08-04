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
$sheet->setTitle('Hasil Uji Ulang TB');

$sheet->mergeCells('A1:H1');
$sheet->setCellValue('A1', 'DATA HASIL UJI ULANG TB');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$headers = ['No', 'Tanggal', 'Kabupaten', 'Nama Puskesmas', 'Jumlah', 'Harga Satuan', 'Harga Total', 'Status'];
foreach ($headers as $i => $h) {
    $col = chr(65 + $i);
    $sheet->setCellValue($col . '3', $h);
    $sheet->getStyle($col . '3')->getFont()->setBold(true);
    $sheet->getStyle($col . '3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle($col . '3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
}

$data = mysqli_query($conn, "SELECT * FROM sib_pemeriksaan_tb ORDER BY id DESC");
$row = 4;
$no = 1;
while ($d = mysqli_fetch_array($data)) {
    $sheet->setCellValue('A' . $row, $no);
    $sheet->setCellValue('B' . $row, $d['tanggal_penerimaan']);
    $sheet->setCellValue('C' . $row, $d['kabupaten'] ?? '-');
    $sheet->setCellValue('D' . $row, $d['nama']);
    $sheet->setCellValue('E' . $row, $d['jumlah']);
    $sheet->setCellValue('F' . $row, $d['harga_satuan']);
    $sheet->setCellValue('G' . $row, $d['harga_total']);
    $sheet->setCellValue('H' . $row, $d['status']);

    $sheet->getStyle('A' . $row . ':H' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode('#,##0');
    $sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode('#,##0');

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

$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Hasil_Uji_Ulang_TB_' . date('Y-m-d') . '.xlsx"');
$writer->save('php://output');
