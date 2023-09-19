<?php
session_start();
require_once './vendor/autoload.php';
include "./config/config.php";
include "./config/settings.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Change query to filter only IC issues
$sql = "SELECT * FROM studentissueswithcoursedetails WHERE studentoption = 'NOT IN PORTAL' ORDER BY indexNumber ASC";
$result = $conn->query($sql);

$currentRow = 1;

// Set Column Headers
$sheet->setCellValue('B' . $currentRow, 'Course Code');
$sheet->setCellValue('C' . $currentRow, 'Title');
$sheet->setCellValue('D' . $currentRow, 'Year');
$sheet->setCellValue('E' . $currentRow, 'Semester');
$sheet->setCellValue('F' . $currentRow, 'Student Option');
$sheet->setCellValue('G' . $currentRow, 'Student Issue Date');

$sheet->getStyle('A1:G1')->getFont()->setBold(true);

$currentRow++;

$lastIndexNumber = null;

while ($row = $result->fetch_assoc()) {
 
    $sheet->setCellValue('A' . $currentRow, $row['indexNumber']);
    $sheet->setCellValue('B' . $currentRow, $row['courseCode']);
    $sheet->setCellValue('C' . $currentRow, $row['title']);
    $sheet->setCellValue('D' . $currentRow, $row['year']);
    $sheet->setCellValue('E' . $currentRow, $row['semester']);
    $sheet->setCellValue('F' . $currentRow, $row['studentoption']);
    $sheet->setCellValue('G' . $currentRow, $row['StudentIssueDate']);

    $sheet->getStyle('D' . $currentRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E' . $currentRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $lastIndexNumber = $row['indexNumber'];
    $currentRow++;
}

foreach(range('A', 'G') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

$writer = new Xlsx($spreadsheet);
$excelFilePath = 'Excel/NOT_IN_PORTAL_ISSUES.xlsx';
$writer->save($excelFilePath);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($excelFilePath) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($excelFilePath));
readfile($excelFilePath);
?>
