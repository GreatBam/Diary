<?php

$host = "db";
$db = "lesson";
$user = "root";
$pass = "admin";

try {
    $conn = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "<p style='color:aliceblue;'>Connected</p>";
} catch(PDOException $e) {
    die($e);
}