<?php
require_once __DIR__ . '/../config/database.php';

$stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE 'faculty_%'");
$updateStmt = $pdo->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = ?");

while ($row = $stmt->fetch()) {
    $val = $row['setting_value'];
    if (strpos($val, '<?=') !== false) {
        $startPos = strpos($val, ", '");
        if ($startPos !== false) {
            $startPos += 3;
            $endPos = strrpos($val, "'");
            if ($endPos !== false && $endPos > $startPos) {
                $clean = substr($val, $startPos, $endPos - $startPos);
                $clean = stripslashes($clean);
                $updateStmt->execute([$clean, $row['setting_key']]);
                echo "Cleaned " . $row['setting_key'] . "<br>";
            }
        }
    }
}
echo "Done.";
