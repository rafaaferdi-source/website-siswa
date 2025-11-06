<?php
require 'vendor/autoload.php';
include 'koneksi.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nama');
$sheet->setCellValue('C1', 'Barang');
$sheet->setCellValue('D1', 'Satuan');
$sheet->setCellValue('E1', 'Jumlah');
$sheet->setCellValue('F1', 'Harga per Satuan');
$sheet->setCellValue('G1', 'PPN 10%');
$sheet->setCellValue('H1', 'Total');
$sheet->setCellValue('I1', 'Keterangan');

$query = mysqli_query($koneksi, "SELECT * FROM barang");
$rowCount = 2;

while ($row = mysqli_fetch_assoc($query)) {
    $sheet->setCellValue('A' . $rowCount, $row['no']);
    $sheet->setCellValue('B' . $rowCount, $row['nama']);
    $sheet->setCellValue('C' . $rowCount, $row['barang']);
    $sheet->setCellValue('D' . $rowCount, $row['satuan']);
    $sheet->setCellValue('E' . $rowCount, $row['jumlah']);
    $sheet->setCellValue('F' . $rowCount, $row['harga_per_satuan']);
    $sheet->setCellValue('G' . $rowCount, $row['ppn']);
    $sheet->setCellValue('H' . $rowCount, $row['total']);
    $sheet->setCellValue('I' . $rowCount, $row['keterangan']);
    $rowCount++;
}

$writer = new Xlsx($spreadsheet);
$filename = 'Data_Barang.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
$writer->save("php://output");
exit;
?>
