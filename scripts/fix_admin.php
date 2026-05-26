<?php
require_once 'config/database.php';

$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (username, password_hash, role) VALUES ('admin', ?, 'admin') ON DUPLICATE KEY UPDATE password_hash = ?");
$stmt->execute([$hash, $hash]);

echo "Admin user reset successfully with password: admin123";
?>
