<?php
$host = 'localhost';
$user = 'root';
$pass = 'root';

try {
    // 1. Connect without database
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 2. Create Database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS cce_db");
    echo "Database created or already exists.<br>";
    
    // 3. Connect to the new database
    $pdo->exec("USE cce_db");
    
    // 4. Run database.sql
    $sql = file_get_contents(__DIR__ . '/database.sql');
    if ($sql !== false) {
        $pdo->exec($sql);
        echo "Database tables created successfully from database.sql.<br>";
    } else {
        echo "Error reading database.sql.<br>";
    }
    
    // 5. Run seed script logic here directly instead of relying on the browser to do it.
    echo "<hr>Running seeder...<br>";
    include __DIR__ . '/seed.php';

} catch (PDOException $e) {
    die("Database setup failed: " . $e->getMessage());
}
?>
