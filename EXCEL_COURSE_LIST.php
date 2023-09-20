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

$sql = "SELECT * FROM studentissueswithcoursedetails ORDER BY courseCode,studentoption ASC, indexNumber ASC";
$result = $conn->query($sql);

$currentRow = 1;

$lastCourseCode = null;

while ($row = $result->fetch_assoc()) {
    if ($lastCourseCode != $row['courseCode']) {
        $currentRow += 2;
        
        $sheet->setCellValue('A' . $currentRow, 'Course Code: ' . $row['courseCode']);
        $sheet->setCellValue('B' . $currentRow, 'Course Title: ' . $row['title']);

        $sheet->getStyle('A' . $currentRow . ':B' . $currentRow)
            ->getFont()
            ->setBold(true)
            ->setSize(16);
        
        $currentRow++;
        
        // Set Column Headers for each session
        $sheet->setCellValue('B' . $currentRow, 'Index Number');
        $sheet->setCellValue('C' . $currentRow, 'Year');
        $sheet->setCellValue('D' . $currentRow, 'Semester');
        $sheet->setCellValue('E' . $currentRow, 'Student Option');
        $sheet->setCellValue('F' . $currentRow, 'Student Issue Date');

        $sheet->getStyle('B' . $currentRow . ':F' . $currentRow)->getFont()->setBold(true);
        
        $currentRow++;
    }

    $sheet->setCellValue('B' . $currentRow, $row['indexNumber']);
    $sheet->setCellValue('C' . $currentRow, $row['year']);
    $sheet->setCellValue('D' . $currentRow, $row['semester']);
    $sheet->setCellValue('E' . $currentRow, $row['studentoption']);
    $sheet->setCellValue('F' . $currentRow, $row['StudentIssueDate']);

    $sheet->getStyle('C' . $currentRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D' . $currentRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

    $lastCourseCode = $row['courseCode'];
    $currentRow++;
}

foreach(range('A', 'F') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

$writer = new Xlsx($spreadsheet);
$excelFilePath = 'Excel/COURSE_BASED_ISSUES.xlsx';
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
