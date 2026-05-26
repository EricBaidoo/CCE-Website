<?php
require_once 'config/database.php';

echo "<pre>";
echo "Starting Image Optimization & WebP Conversion...\n\n";

function convertToWebp($source, $destination, $quality = 80) {
    $info = getimagesize($source);
    if ($info === false) return false;

    if ($info['mime'] == 'image/jpeg') {
        $image = @imagecreatefromjpeg($source);
    } elseif ($info['mime'] == 'image/png') {
        $image = @imagecreatefrompng($source);
        if ($image) {
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        }
    } else {
        return false;
    }

    if (!$image) return false;

    // Convert to webp
    $result = imagewebp($image, $destination, $quality);
    imagedestroy($image);
    return $result;
}

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/assets/image'));
$convertedCount = 0;

foreach ($iterator as $file) {
    if ($file->isFile()) {
        $ext = strtolower($file->getExtension());
        if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
            $sourcePath = $file->getRealPath();
            $dir = dirname($sourcePath);
            $filename = pathinfo($sourcePath, PATHINFO_FILENAME);
            $destinationPath = $dir . DIRECTORY_SEPARATOR . $filename . '.webp';

            echo "Processing: " . str_replace(__DIR__, '', $sourcePath) . " ... ";

            // Avoid overwriting if webp already exists (unless we delete it)
            if (convertToWebp($sourcePath, $destinationPath)) {
                unlink($sourcePath); // Delete original
                echo "SUCCESS\n";
                $convertedCount++;
            } else {
                echo "FAILED\n";
            }
        }
    }
}

echo "\nConverted $convertedCount files to WebP.\n\n";

echo "Updating database records...\n";

$tables = [
    'hero_slides' => ['image_path'],
    'site_settings' => ['setting_value'],
    'people' => ['photo', 'image'],
    'companies' => ['logo'],
    'events' => ['image'],
    'news' => ['featured_image']
];

$extensions = ['.jpg', '.jpeg', '.png'];
$dbUpdates = 0;

foreach ($tables as $table => $columns) {
    foreach ($columns as $column) {
        foreach ($extensions as $ext) {
            // Check if column exists (people table has photo and image conditionally depending on old schema vs new schema)
            try {
                $stmt = $pdo->prepare("UPDATE `$table` SET `$column` = REPLACE(`$column`, ?, '.webp') WHERE `$column` LIKE ?");
                $stmt->execute([$ext, '%' . $ext]);
                $count = $stmt->rowCount();
                if ($count > 0) {
                    echo "Updated $count rows in $table.$column for $ext\n";
                    $dbUpdates += $count;
                }
            } catch (PDOException $e) {
                // Column might not exist (e.g. people.photo was removed, but just in case)
            }
        }
    }
}

echo "\nDatabase paths updated ($dbUpdates replacements made).\n";
echo "Optimization Phase 1 Complete!\n";
echo "</pre>";
?>
