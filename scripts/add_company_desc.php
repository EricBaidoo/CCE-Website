<?php
require_once 'config/database.php';
try {
    $pdo->exec("ALTER TABLE companies ADD COLUMN description TEXT NULL");
    echo "Successfully added description column to companies table.";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "Column already exists.";
    } else {
        echo "Error: " . $e->getMessage();
    }
}
?>
