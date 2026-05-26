<?php
// config/database.php

// Define environment ('development' for local XAMPP, 'production' for live Git deployment)
define('ENVIRONMENT', 'production');

if (ENVIRONMENT === 'development') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}

// Database Credentials
// IMPORTANT FOR GIT DEPLOYMENT: If deploying to a live server, update these values via your hosting panel (e.g. cPanel or environment variables).
$host = 'localhost';
$db   = 'cce_db'; // Change this to your live database name (e.g. cce_production)
$user = 'root'; // Change this to your live database user
$pass = 'root'; // Change this to your live database password
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
    if (ENVIRONMENT === 'development') {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    } else {
        // In production, just show a generic message to prevent leaking sensitive credentials
        die('Database connection failed. Please ensure your database credentials in config/database.php are correct.');
    }
}
?>
