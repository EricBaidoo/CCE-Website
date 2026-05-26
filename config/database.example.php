<?php
// config/database.example.php
// ============================
// COPY this file to database.php and fill in your credentials.
// database.php is gitignored and will NOT be pushed to Git.
// ============================

define('ENVIRONMENT', 'production'); // 'development' for local, 'production' for live

if (ENVIRONMENT === 'development') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}

$host = 'localhost';
$db   = 'YOUR_DATABASE_NAME';
$user = 'YOUR_DATABASE_USER';
$pass = 'YOUR_DATABASE_PASSWORD';
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
        die('Database connection failed. Please check your credentials.');
    }
}
?>
