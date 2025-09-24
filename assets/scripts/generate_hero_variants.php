<?php
// generate_hero_variants.php
// Usage: run via CLI or in browser (careful with timeouts) to generate responsive JPEG and WebP variants

$images = [
    __DIR__ . '/../image/001.jpg',
    __DIR__ . '/../image/002.jpg',
    __DIR__ . '/../image/003.jpg',
];

$sizes = [300, 800, 1200, 1600, 2000];
$outDir = __DIR__ . '/../image/hero';
if (!is_dir($outDir)) mkdir($outDir, 0755, true);

function resizeAndSave($srcPath, $destPath, $newW, $quality = 85) {
    $src = imagecreatefromjpeg($srcPath);
    if (!$src) return false;
    $w = imagesx($src);
    $h = imagesy($src);
    $newH = intval($h * ($newW / $w));
    $dst = imagecreatetruecolor($newW, $newH);
    imagecopyresampled($dst, $src, 0,0,0,0, $newW, $newH, $w, $h);
    $ok = imagejpeg($dst, $destPath, $quality);
    imagedestroy($dst);
    imagedestroy($src);
    return $ok;
}

foreach ($images as $imgPath) {
    if (!file_exists($imgPath)) continue;
    $base = pathinfo($imgPath, PATHINFO_FILENAME);
    foreach ($sizes as $s) {
        $jpgOut = "$outDir/{$base}-w{$s}.jpg";
        $webpOut = "$outDir/{$base}-w{$s}.webp";
        if (!file_exists($jpgOut)) {
            resizeAndSave($imgPath, $jpgOut, $s, 85);
            echo "Created: $jpgOut\n";
        }
        // create webp using GD if supported
        if (function_exists('imagecreatefromjpeg') && !file_exists($webpOut)) {
            $src = imagecreatefromjpeg($imgPath);
            $w = imagesx($src);
            $h = imagesy($src);
            $newH = intval($h * ($s / $w));
            $dst = imagecreatetruecolor($s, $newH);
            imagecopyresampled($dst, $src, 0,0,0,0, $s, $newH, $w, $h);
            imagewebp($dst, $webpOut, 80);
            imagedestroy($dst);
            imagedestroy($src);
            echo "Created: $webpOut\n";
        }
    }
}

echo "Done. Generated hero variants in $outDir\n";

?>
