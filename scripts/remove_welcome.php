<?php
require_once __DIR__ . '/../config/database.php';

try {
    $stmt = $pdo->prepare("DELETE FROM site_settings WHERE setting_key LIKE 'home_welcome_%'");
    $stmt->execute();
    echo "Removed " . $stmt->rowCount() . " welcome settings from the database.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
