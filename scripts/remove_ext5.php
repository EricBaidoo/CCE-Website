<?php
$files = glob("*.php");
$files = array_merge($files, glob("partials/*.php"));

echo "Found " . count($files) . " files.\n";

$count = 0;
foreach ($files as $file) {
    if (strpos($file, 'admin') !== false || strpos($file, 'config') !== false || strpos($file, 'remove_ext') !== false) {
        continue;
    }
    
    $content = file_get_contents($file);
    
    // Only replace .php at the end of href string, avoiding http links
    $newContent = preg_replace_callback('/href="([^"]+)\.php"/i', function($m) {
        if (strpos($m[1], 'http') === 0) return $m[0];
        return 'href="' . $m[1] . '"';
    }, $content);
    
    $newContent = preg_replace_callback('/href="([^"]+)\.php\?([^"]*)"/i', function($m) {
        if (strpos($m[1], 'http') === 0) return $m[0];
        return 'href="' . $m[1] . '?' . $m[2] . '"';
    }, $newContent);
    
    $newContent = preg_replace_callback('/action="([^"]+)\.php"/i', function($m) {
        if (strpos($m[1], 'http') === 0) return $m[0];
        return 'action="' . $m[1] . '"';
    }, $newContent);

    if ($content !== $newContent) {
        file_put_contents($file, $newContent);
        echo "Updated $file\n";
        $count++;
    }
}

echo "Updated $count files.\n";
?>
