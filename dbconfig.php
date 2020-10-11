<?php
date_default_timezone_set ("Asia/Tehran");

$conn = new PDO("mysql:host=localhost;dbname=jobchat;charset=utf8mb4", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $conn = new PDO("mysql:host=localhost;dbname=job_vacancy;charset=utf8", "root", "");
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);