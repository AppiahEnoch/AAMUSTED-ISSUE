<?php


session_start();
require_once './vendor/autoload.php';
include "./config/config.php";
include "./config/settings.php";
use PhpOffice\PhpSpreadsheet\IOFactory;


global $conn;
$inserted = 0;
$updated = 0;

$conn->begin_transaction();

$sql = "INSERT INTO course (course_code, title, semester, year) VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE 
        course_code = VALUES(course_code),
        title = VALUES(title),
        semester = VALUES(semester),
        year = VALUES(year)";
$stmt = $conn->prepare($sql);

$inputFileName = $_FILES['courseListFile']['tmp_name'];
$spreadsheet = IOFactory::load($inputFileName);
$worksheet = $spreadsheet->getActiveSheet();
$header = $worksheet->rangeToArray('A1:D1', null, true, false)[0];

$valid_headers = ['COURSE-CODE', 'TITLE', 'SEMESTER', 'YEAR'];
if ($header !== $valid_headers) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid headers']);
    $conn->rollback();
    exit;
}

foreach ($worksheet->rangeToArray('A2:D' . $worksheet->getHighestRow(), null, true, false) as $row) {
    list($course_code, $title, $semester, $year) = $row;
    $course_code = strtoupper($course_code);
    $title = strtoupper($title);

    $stmt->bind_param("ssii", $course_code, $title, $semester, $year);
    if ($stmt->execute()) {
        if ($stmt->affected_rows === 1) {
            $inserted++;
        } elseif ($stmt->affected_rows === 2) {
            $updated++;
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        $conn->rollback();
        exit;
    }
}

$conn->commit();
echo json_encode(['status' => 'success', 'message' => "$inserted records inserted and $updated records updated"]);
