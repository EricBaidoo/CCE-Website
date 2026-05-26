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
    
    $newContent = preg_replace('/href="([^"]+)\.php"/i', 'href="$1"', $content);
    $newContent = preg_replace('/href=\'([^\']+)\.php\'/i', 'href=\'$1\'', $newContent);
    $newContent = preg_replace('/href="([^"]+)\.php\?([^"]*)"/i', 'href="$1?$2"', $newContent);
    $newContent = preg_replace('/action="([^"]+)\.php"/i', 'action="$1"', $newContent);
    
    // fix PHP tags embedded in links like href="faculty-<?= $fac['id'] ?>.php"
    $newContent = preg_replace('/href="faculty-<\?= \$fac\[\'id\'\] \?>\.php"/i', 'href="faculty-<?= $fac[\'id\'] ?>"', $newContent);
    
    // revert external links just in case
    $newContent = preg_replace('/href="(https?:\/\/[^"]+)"/i', 'href="$1.php"', $newContent); // this is wrong, ignore external links

    if ($content !== $newContent) {
        file_put_contents($file, $newContent);
        echo "Updated $file\n";
        $count++;
    }
}

echo "Updated $count files.\n";
?>
