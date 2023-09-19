<?php
session_start();
require_once './vendor/autoload.php';
include "./config/config.php";
include "./config/settings.php";

$query = "SELECT * FROM course";
$result = $conn->query($query);

$courses = [];

while($row = $result->fetch_assoc()) {
  $courses[] = $row;
}

echo json_encode($courses);
