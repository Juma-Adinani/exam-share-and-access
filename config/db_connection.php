<?php

date_default_timezone_set("Africa/Nairobi");

$host = "localhost";
$user = "root";
$pwd = "";
$db = "exam_sharing_db";

try {
    $con = mysqli_connect($host, $user, $pwd, $db);
} catch (Exception $e) {
    die("Database connection error => " . $e);
    // throw new Exception("Error Processing Request", 1);
}
