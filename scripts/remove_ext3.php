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
    
    $newContent = preg_replace('/(href|action)=([\'"])([^"\']*?)\.php([?#][^"\']*?)?\2/i', '$1=$2$3$4$2', $content);
    
    // Quick fix: restore absolute URLs like http://...
    $newContent = preg_replace('/(href|action)=([\'"])(https?:\/\/[^"\']*?)\.php([^"\']*?)?\2/i', '$1=$2$3.php$4$2', $newContent);
    
    if ($content !== $newContent) {
        file_put_contents($file, $newContent);
        echo "Updated $file\n";
        $count++;
    }
}

echo "Updated $count files.\n";
?>
