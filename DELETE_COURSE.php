<?php
session_start();
require_once './vendor/autoload.php';
include "./config/config.php";
include "./config/settings.php";

$sql = "DELETE FROM course";
$result = $conn->query($sql);

echo 1;
