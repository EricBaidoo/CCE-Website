<?php
// Simple avatar generator: reads data/people.php and creates 200px thumbnails (jpg + webp)
$data = include __DIR__ . '/../../data/people.php';
$outDir = __DIR__ . '/../../assets/image/avatars/';
if (!is_dir($outDir)) mkdir($outDir, 0755, true);

foreach ($data as $p) {
    $src = __DIR__ . '/../../' . $p['photo'];
    if (!file_exists($src)) {
        echo "Source not found: {$src}\n";
        continue;
    }
    $img = @imagecreatefromstring(file_get_contents($src));
    if (!$img) { echo "Failed to read image: {$src}\n"; continue; }
    $w = imagesx($img);
    $h = imagesy($img);
    $size = 400; // create larger thumbnails for retina
    $dst = imagecreatetruecolor($size, $size);
    // preserve alpha for png
    imagefill($dst, 0, 0, imagecolorallocate($dst, 255,255,255));
    // compute crop
    $min = min($w, $h);
    $sx = ($w - $min) / 2;
    $sy = ($h - $min) / 2;
    imagecopyresampled($dst, $img, 0,0, $sx, $sy, $size, $size, $min, $min);

    $base = $outDir . $p['id'];
    // save jpg
    imagejpeg($dst, $base . '-w400.jpg', 84);
    // save webp if supported
    if (function_exists('imagewebp')) imagewebp($dst, $base . '-w400.webp', 80);

    imagedestroy($img);
    imagedestroy($dst);
    echo "Generated avatar for {$p['id']}\n";
}

echo "Done\n";
