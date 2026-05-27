<?php
require_once __DIR__ . '/../config/database.php';

$faculties = ['gad', 'eat', 'sat', 'paa', 'fab', 'raf', 'maa', 'cam'];

// 1. Clean Database
$stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE '%_objectives_html'");
$updateStmt = $pdo->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = ?");

while ($row = $stmt->fetch()) {
    $val = $row['setting_value'];
    // Replace </li> with newline, remove <li>
    $clean = str_replace('</li>', "\n", $val);
    $clean = str_replace('<li>', "", $clean);
    
    // Trim empty lines
    $lines = explode("\n", $clean);
    $finalLines = [];
    foreach($lines as $line) {
        $line = trim($line);
        if ($line) {
            $finalLines[] = $line;
        }
    }
    $clean = implode("\n", $finalLines);
    
    if ($clean !== $val) {
        $updateStmt->execute([$clean, $row['setting_key']]);
        echo "Cleaned DB for " . $row['setting_key'] . "<br>";
    }
}

// 2. Update Files
foreach ($faculties as $code) {
    $file = __DIR__ . '/../faculty-' . $code . '.php';
    if (!file_exists($file)) continue;
    
    $content = file_get_contents($file);
    
    $oldTag = "<?= \$setting('faculty_{$code}_objectives_html') ?>";
    $newTag = "<?php 
                            \$objectives = explode(\"\\n\", trim(\$setting('faculty_{$code}_objectives_html')));
                            foreach(\$objectives as \$obj): 
                                if(trim(\$obj)): 
                            ?>
                                <li><?= htmlspecialchars(trim(strip_tags(\$obj))) ?></li>
                            <?php 
                                endif;
                            endforeach; 
                            ?>";
                            
    $content = str_replace($oldTag, $newTag, $content);
    
    file_put_contents($file, $content);
    echo "Updated file faculty-$code.php<br>";
}

echo "Objectives formatting fixed.";
