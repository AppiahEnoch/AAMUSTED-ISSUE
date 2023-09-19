<?php
session_start();
require_once './vendor/autoload.php';
include "./config/config.php";
include "./config/settings.php";

require('mc_table.php');

if (isset($_SESSION["indexNumber"])) {
    $indexNumber = $_SESSION["indexNumber"];
} else {
    header("Location: noindex/page.php");
    exit();
}



ob_end_clean();

$pdf = new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

$pdf->SetX(-110);
$pdf->Cell(100, 6, date("l jS \of F Y h:i:s A"), 0, 1, "R");
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 6, 'AAMUSTED STUDENT COMPLAINT REPORT ON COURSES', 0, 1, 'C');
$pdf->Ln();

$pdf->SetTextColor(0, 0, 255);
$pdf->SetFont('Arial', 'BU', 18);
$pdf->Cell(0, 6, "INDEX NUMBER: " . $indexNumber, 0, 1, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);

$pdf->SetWidths(array(40, 100, 50));

// Add Column Headers
$pdf->Row(array('COURSE CODE', 'COURSE TITLE', 'ISSUE'));

$sql = "SELECT * FROM StudentIssuesWithCourseDetails WHERE indexNumber = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $indexNumber);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $pdf->Row(array($row['course_code'], $row['title'], $row['studentoption']));
}

$pdf->Output('D', $indexNumber.'.pdf');

$conn->close();
?>
