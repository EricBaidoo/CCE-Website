<?php
$dir = __DIR__;
$files = glob($dir . "/*.php");

$count = 0;
foreach ($files as $file) {
    if (strpos($file, 'admin') !== false || strpos($file, 'config') !== false || strpos($file, 'remove_ext') !== false) {
        continue;
    }
    
    $content = file_get_contents($file);
    
    $newContent = preg_replace_callback('/(href|action)=([\'"])([^"\']*?)\.php([?#][^"\']*?)?\2/i', function($matches) {
        $attr = $matches[1];
        $quote = $matches[2];
        $path = $matches[3];
        $query = isset($matches[4]) ? $matches[4] : '';
        
        if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
            return $matches[0];
        }
        
        return "$attr=$quote$path$query$quote";
    }, $content);
    
    if ($content !== $newContent) {
        file_put_contents($file, $newContent);
        $count++;
    }
}

echo "Updated $count files.\n";
?>
