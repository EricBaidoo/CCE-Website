<?php
require_once __DIR__ . '/../config/database.php';

try {
    $pdo->exec("ALTER TABLE hero_slides ADD COLUMN layout_style VARCHAR(50) DEFAULT 'text_left'");
    echo "Added layout_style column.<br>";
} catch (Exception $e) {
    echo "Column layout_style might already exist.<br>";
}

try {
    $pdo->exec("ALTER TABLE hero_slides ADD COLUMN image_caption_name VARCHAR(255) DEFAULT ''");
    echo "Added image_caption_name column.<br>";
} catch (Exception $e) {
    echo "Column image_caption_name might already exist.<br>";
}

try {
    $pdo->exec("ALTER TABLE hero_slides ADD COLUMN image_caption_title VARCHAR(255) DEFAULT ''");
    echo "Added image_caption_title column.<br>";
} catch (Exception $e) {
    echo "Column image_caption_title might already exist.<br>";
}

echo "Schema update completed.";
