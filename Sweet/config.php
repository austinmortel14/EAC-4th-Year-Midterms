<?php
// config.php
$host = 'localhost';
$dbname = 'user_management';
$username = 'root';  // Change if different
$password = '';      // Change if you have a password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}