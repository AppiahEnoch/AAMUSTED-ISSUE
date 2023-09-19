<?php
session_start();
require_once './vendor/autoload.php';
include "./config/config.php";
include "./config/settings.php";

$indexNumber = $_POST['indexNumber'];
$_SESSION["indexNumber"] = $indexNumber;

$courseData = json_decode($_POST['courseData'], true);

foreach ($courseData as $courseCode => $studentOption) {
    $sql = "INSERT INTO studentissues (indexNumber, courseCode, studentoption) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE studentoption = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $indexNumber, $courseCode, $studentOption, $studentOption);
    $stmt->execute();
}

echo 1;
?>
