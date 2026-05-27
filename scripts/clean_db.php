<?php
require_once __DIR__ . '/../config/database.php';

$stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE 'faculty_%'");
$updateStmt = $pdo->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = ?");

while ($row = $stmt->fetch()) {
    $val = $row['setting_value'];
    
    // Remove the starting PHP code
    $clean = preg_replace('/^<\?=\s*(?:htmlspecialchars\()?\$setting\(\'[a-z_]+\',\s*\'/s', '', $val);
    
    // Also remove any trailing ')) ?>' if it exists (just in case)
    $clean = preg_replace('/\'\)\)\s*\?>$/s', '', $clean);
    $clean = preg_replace('/\'\)\s*\?>$/s', '', $clean);

    if ($clean !== $val) {
        $updateStmt->execute([$clean, $row['setting_key']]);
        echo "Cleaned " . $row['setting_key'] . "<br>";
    }
}
echo "Done.";
