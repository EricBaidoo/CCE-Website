<?php
require_once __DIR__ . '/../config/database.php';

$faculties = ['gad', 'eat', 'sat', 'paa', 'fab', 'raf', 'maa', 'cam'];

$updateStmt = $pdo->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = ?");

foreach ($faculties as $code) {
    $file = __DIR__ . '/../faculty-' . $code . '.php';
    if (!file_exists($file)) continue;
    
    $content = file_get_contents($file);
    
    // 1. Fix Hero Desc
    $content = preg_replace(
        '/<\?= htmlspecialchars\(\$setting\(\'faculty_' . $code . '_hero_desc\', \'(.*?)\'\)\) \?>/s',
        '<?= htmlspecialchars($setting(\'faculty_' . $code . '_hero_desc\')) ?>',
        $content
    );
    // If there is any nested leftover due to multiple runs
    $content = preg_replace(
        '/<\?= htmlspecialchars\(\$setting\(\'faculty_' . $code . '_hero_desc\'\)\) \?>\'\)\) \?>/s',
        '<?= htmlspecialchars($setting(\'faculty_' . $code . '_hero_desc\')) ?>',
        $content
    );

    // 2. Fix Vision & Mission
    $content = preg_replace(
        '/<\?= htmlspecialchars\(\$setting\(\'faculty_' . $code . '_vision_mission\', \'(.*?)\'\)\) \?>/s',
        '<?= htmlspecialchars($setting(\'faculty_' . $code . '_vision_mission\')) ?>',
        $content
    );
    $content = preg_replace(
        '/<\?= htmlspecialchars\(\$setting\(\'faculty_' . $code . '_vision_mission\'\)\) \?>\'\)\) \?>/s',
        '<?= htmlspecialchars($setting(\'faculty_' . $code . '_vision_mission\')) ?>',
        $content
    );

    // 3. Fix Objectives
    $content = preg_replace(
        '/<\?= \$setting\(\'faculty_' . $code . '_objectives_html\', \'(.*?)\'\) \?>/s',
        '<?= $setting(\'faculty_' . $code . '_objectives_html\') ?>',
        $content
    );
    $content = preg_replace(
        '/<\?= \$setting\(\'faculty_' . $code . '_objectives_html\'\) \?>\'\) \?>/s',
        '<?= $setting(\'faculty_' . $code . '_objectives_html\') ?>',
        $content
    );

    // 4. Fix Audience
    $content = preg_replace(
        '/<\?= htmlspecialchars\(\$setting\(\'faculty_' . $code . '_audience\', \'(.*?)\'\)\) \?>/s',
        '<?= htmlspecialchars($setting(\'faculty_' . $code . '_audience\')) ?>',
        $content
    );
    $content = preg_replace(
        '/<\?= htmlspecialchars\(\$setting\(\'faculty_' . $code . '_audience\'\)\) \?>\'\)\) \?>/s',
        '<?= htmlspecialchars($setting(\'faculty_' . $code . '_audience\')) ?>',
        $content
    );

    // Cleanup any lingering weirdness (manual regex to strip out nesting completely)
    $content = preg_replace('/\'<\?= htmlspecialchars\(\$setting\(\'[a-z_]+\'\)\) \?>\'\)\) \?>/', '', $content);

    file_put_contents($file, $content);
}

// 5. Clean Database
$stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE 'faculty_%'");
while ($row = $stmt->fetch()) {
    $val = $row['setting_value'];
    
    if (strpos($val, '<?=') !== false) {
        $startPos = strpos($val, ", '");
        if ($startPos !== false) {
            $startPos += 3;
            $endPos = strrpos($val, "'");
            if ($endPos !== false && $endPos > $startPos) {
                $clean = substr($val, $startPos, $endPos - $startPos);
                $clean = stripslashes($clean);
                
                // Ensure no inner tags remain
                $clean = preg_replace('/^<\?=\s*(?:htmlspecialchars\()?\$setting\(\'[a-z_]+\',\s*\'/s', '', $clean);
                $clean = preg_replace('/\'\)\)\s*\?>$/s', '', $clean);
                $clean = preg_replace('/\'\)\s*\?>$/s', '', $clean);

                $updateStmt->execute([$clean, $row['setting_key']]);
            }
        }
    }
}

echo "Everything fixed.";
