<?php
// config/database.php

// Check for a local override file (for XAMPP development)
// This file is gitignored, so it won't affect production
if (file_exists(__DIR__ . '/database.local.php')) {
    require_once __DIR__ . '/database.local.php';
    return; // Stop here, local config handles everything
}

// ==============================
// PRODUCTION CREDENTIALS BELOW
// ==============================
define('ENVIRONMENT', 'production');

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

$host = 'localhost';
$db   = 'u420775839_cce_production';
$user = 'u420775839_cce_admin';
$pass = 'Eric0056@2024';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Database connection failed. Please check your credentials.');
}
?>
