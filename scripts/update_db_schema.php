<?php
require_once __DIR__ . '/config/db.php';

try {
    $pdo->exec("ALTER TABLE events ADD COLUMN faculty_id VARCHAR(10) NULL AFTER location");
    echo "Added faculty_id to events table.\n";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "faculty_id already exists in events table.\n";
    } else {
        echo "Error on events: " . $e->getMessage() . "\n";
    }
}

try {
    $pdo->exec("ALTER TABLE people ADD COLUMN faculty_id VARCHAR(10) NULL AFTER role");
    echo "Added faculty_id to people table.\n";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "faculty_id already exists in people table.\n";
    } else {
        echo "Error on people: " . $e->getMessage() . "\n";
    }
}
?>
