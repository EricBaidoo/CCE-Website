<?php
require_once __DIR__ . '/../config/database.php';
$stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE 'faculty_%'");
while ($row = $stmt->fetch()) {
    $val = $row['setting_value'];
    echo "<b>" . $row['setting_key'] . "</b>:<br>";
    echo "Length: " . strlen($val) . "<br>";
    echo "First 10 chars (raw): " . htmlspecialchars(substr($val, 0, 10)) . "<br>";
    echo "First 10 chars (hex): " . bin2hex(substr($val, 0, 10)) . "<br>";
    echo "<br>";
    break; // just check the first one
}
