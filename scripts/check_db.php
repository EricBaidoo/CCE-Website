<?php
require_once __DIR__ . '/../config/database.php';
$stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE 'faculty_%'");
while ($row = $stmt->fetch()) {
    echo "<b>" . $row['setting_key'] . "</b>:<br>" . htmlspecialchars($row['setting_value']) . "<br><br>";
}
