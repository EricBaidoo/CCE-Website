<?php
require_once __DIR__ . '/../config/database.php';

$stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE 'faculty_%'");
$updateStmt = $pdo->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = ?");

while ($row = $stmt->fetch()) {
    $val = $row['setting_value'];
    
    // Strip prefix
    $clean = preg_replace('/^<\?=\s*(?:htmlspecialchars\()?\$setting\(\'[a-z_]+\',\s*\'/s', '', $val);
    
    // If it didn't match the first one, try without htmlspecialchars
    if ($clean === $val) {
        $clean = preg_replace('/^<\?=\s*\$setting\(\'[a-z_]+\',\s*\'/s', '', $val);
    }

    // Strip suffix
    $clean = preg_replace('/\'\)\)\s*\?>$/s', '', $clean);
    $clean = preg_replace('/\'\)\s*\?>$/s', '', $clean);
    // If it just has a trailing single quote
    $clean = preg_replace('/\'$/s', '', $clean);
    
    $clean = stripslashes($clean);
    
    if ($clean !== $val) {
        $updateStmt->execute([$clean, $row['setting_key']]);
        echo "Cleaned " . $row['setting_key'] . "<br>";
    }
}
echo "Done regex.";
