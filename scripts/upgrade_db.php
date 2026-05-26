<?php
require 'config/database.php';
try {
    $pdo->exec("ALTER TABLE people ADD COLUMN company VARCHAR(255) AFTER role");
    echo "Company column added.\n";
} catch (Exception $e) {
    echo "Company error: " . $e->getMessage() . "\n";
}
try {
    $pdo->exec("ALTER TABLE people ADD COLUMN image VARCHAR(255) AFTER photo");
    echo "Image column added.\n";
} catch (Exception $e) {
    echo "Image error: " . $e->getMessage() . "\n";
}
?>
