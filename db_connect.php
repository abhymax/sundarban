<?php
// db_connect.php

$host = 'localhost';
$dbname = 'sundarban_safari';
$username = 'root'; // Update with your DB username
$password = '';     // Update with your DB password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    // Set errormode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Default fetch mode
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    // In production, log this error instead of showing it
    die("Connection failed: " . $e->getMessage());
}
?>