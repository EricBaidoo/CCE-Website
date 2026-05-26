<?php
require_once __DIR__ . '/config/database.php';

$updates = [
    // ============ EVENTS ============
    // Image paths in events table
    ["UPDATE events SET image = REPLACE(image, '.jpg', '.webp') WHERE image LIKE '%.jpg'", "events .jpg"],
    ["UPDATE events SET image = REPLACE(image, '.jpeg', '.webp') WHERE image LIKE '%.jpeg'", "events .jpeg"],
    ["UPDATE events SET image = REPLACE(image, '.png', '.webp') WHERE image LIKE '%.png'", "events .png"],
    ["UPDATE events SET image = REPLACE(image, '.JPG', '.webp') WHERE image LIKE '%.JPG'", "events .JPG"],

    // ============ NEWS ============
    ["UPDATE news SET featured_image = REPLACE(featured_image, '.jpg', '.webp') WHERE featured_image LIKE '%.jpg'", "news .jpg"],
    ["UPDATE news SET featured_image = REPLACE(featured_image, '.jpeg', '.webp') WHERE featured_image LIKE '%.jpeg'", "news .jpeg"],
    ["UPDATE news SET featured_image = REPLACE(featured_image, '.png', '.webp') WHERE featured_image LIKE '%.png'", "news .png"],

    // ============ PEOPLE ============
    ["UPDATE people SET photo = REPLACE(photo, '.jpg', '.webp') WHERE photo LIKE '%.jpg'", "people photo .jpg"],
    ["UPDATE people SET photo = REPLACE(photo, '.jpeg', '.webp') WHERE photo LIKE '%.jpeg'", "people photo .jpeg"],
    ["UPDATE people SET photo = REPLACE(photo, '.png', '.webp') WHERE photo LIKE '%.png'", "people photo .png"],
    ["UPDATE people SET photo = REPLACE(photo, '.JPG', '.webp') WHERE photo LIKE '%.JPG'", "people photo .JPG"],
    ["UPDATE people SET photo = REPLACE(photo, '.jfif', '.webp') WHERE photo LIKE '%.jfif'", "people photo .jfif"],
    ["UPDATE people SET image = REPLACE(image, '.jpg', '.webp') WHERE image LIKE '%.jpg'", "people image .jpg"],
    ["UPDATE people SET image = REPLACE(image, '.jpeg', '.webp') WHERE image LIKE '%.jpeg'", "people image .jpeg"],
    ["UPDATE people SET image = REPLACE(image, '.png', '.webp') WHERE image LIKE '%.png'", "people image .png"],
    ["UPDATE people SET image = REPLACE(image, '.JPG', '.webp') WHERE image LIKE '%.JPG'", "people image .JPG"],

    // ============ COMPANIES ============
    ["UPDATE companies SET logo = REPLACE(logo, '.jpg', '.webp') WHERE logo LIKE '%.jpg'", "companies .jpg"],
    ["UPDATE companies SET logo = REPLACE(logo, '.jpeg', '.webp') WHERE logo LIKE '%.jpeg'", "companies .jpeg"],
    ["UPDATE companies SET logo = REPLACE(logo, '.png', '.webp') WHERE logo LIKE '%.png'", "companies .png"],

    // ============ HERO SLIDES ============
    ["UPDATE hero_slides SET image_path = REPLACE(image_path, '.jpg', '.webp') WHERE image_path LIKE '%.jpg'", "hero .jpg"],
    ["UPDATE hero_slides SET image_path = REPLACE(image_path, '.jpeg', '.webp') WHERE image_path LIKE '%.jpeg'", "hero .jpeg"],
    ["UPDATE hero_slides SET image_path = REPLACE(image_path, '.png', '.webp') WHERE image_path LIKE '%.png'", "hero .png"],

    // ============ SITE SETTINGS ============
    ["UPDATE site_settings SET setting_value = REPLACE(setting_value, '.jpg', '.webp') WHERE setting_key LIKE '%image%' AND setting_value LIKE '%.jpg'", "settings .jpg"],
    ["UPDATE site_settings SET setting_value = REPLACE(setting_value, '.jpeg', '.webp') WHERE setting_key LIKE '%image%' AND setting_value LIKE '%.jpeg'", "settings .jpeg"],
    ["UPDATE site_settings SET setting_value = REPLACE(setting_value, '.png', '.webp') WHERE setting_key LIKE '%image%' AND setting_value LIKE '%.png'", "settings .png"],
];

$totalAffected = 0;
echo "<h2>Fixing image paths in database...</h2><pre>\n";
foreach ($updates as [$sql, $label]) {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();
    $totalAffected += $count;
    if ($count > 0) {
        echo "✅ $label: $count rows updated\n";
    }
}
echo "\nTotal rows fixed: $totalAffected\n";

// Verify: show current image paths
echo "\n--- Current image paths ---\n";
echo "\nEVENTS:\n";
foreach ($pdo->query("SELECT id, image FROM events")->fetchAll() as $r) {
    echo "  {$r['id']}: {$r['image']}\n";
}
echo "\nHERO:\n";
foreach ($pdo->query("SELECT id, image_path FROM hero_slides")->fetchAll() as $r) {
    echo "  {$r['id']}: {$r['image_path']}\n";
}
echo "\nPEOPLE (first 5):\n";
foreach ($pdo->query("SELECT id, photo FROM people LIMIT 5")->fetchAll() as $r) {
    echo "  {$r['id']}: {$r['photo']}\n";
}
echo "\nSETTINGS:\n";
foreach ($pdo->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE '%image%' OR setting_key LIKE '%logo%'")->fetchAll() as $r) {
    echo "  {$r['setting_key']}: {$r['setting_value']}\n";
}
echo "</pre>";
?>
