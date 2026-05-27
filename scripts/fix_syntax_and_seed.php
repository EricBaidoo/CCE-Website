<?php
require_once __DIR__ . '/../config/database.php';

$faculties = ['gad', 'eat', 'sat', 'paa', 'fab', 'raf', 'maa', 'cam'];

$stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");

foreach ($faculties as $code) {
    $file = __DIR__ . '/../faculty-' . $code . '.php';
    if (!file_exists($file)) continue;
    
    $content = file_get_contents($file);
    
    // 1. Fix Hero Desc
    // Match the inner text if it got nested.
    if (preg_match('/<\?= htmlspecialchars\(\$setting\(\'faculty_' . $code . '_hero_desc\', \'(.*)\'\)\) \?>/sU', $content, $matches)) {
        $inner = $matches[1];
        // If nested again, clean it
        if (preg_match('/<\?= htmlspecialchars\(\$setting\(\'.*?\', \'(.*)\'\)\) \?>/sU', $inner, $inner_matches)) {
            $inner = $inner_matches[1];
        }
        $inner = stripslashes($inner);
        // Seed DB
        $stmt->execute(["faculty_{$code}_hero_desc", $inner, $inner]);
        // Fix File
        $content = preg_replace(
            '/<\?= htmlspecialchars\(\$setting\(\'faculty_' . $code . '_hero_desc\', \'.*\'\)\) \?>/sU',
            '<?= htmlspecialchars($setting(\'faculty_' . $code . '_hero_desc\')) ?>',
            $content
        );
    }

    // 2. Fix Vision & Mission
    if (preg_match('/<\?= htmlspecialchars\(\$setting\(\'faculty_' . $code . '_vision_mission\', \'(.*)\'\)\) \?>/sU', $content, $matches)) {
        $inner = $matches[1];
        if (preg_match('/<\?= htmlspecialchars\(\$setting\(\'.*?\', \'(.*)\'\)\) \?>/sU', $inner, $inner_matches)) {
            $inner = $inner_matches[1];
        }
        $inner = stripslashes($inner);
        $stmt->execute(["faculty_{$code}_vision_mission", $inner, $inner]);
        $content = preg_replace(
            '/<\?= htmlspecialchars\(\$setting\(\'faculty_' . $code . '_vision_mission\', \'.*\'\)\) \?>/sU',
            '<?= htmlspecialchars($setting(\'faculty_' . $code . '_vision_mission\')) ?>',
            $content
        );
    }

    // 3. Fix Objectives HTML
    if (preg_match('/<\?= \$setting\(\'faculty_' . $code . '_objectives_html\', \'(.*)\'\) \?>/sU', $content, $matches)) {
        $inner = $matches[1];
        if (preg_match('/<\?= \$setting\(\'.*?\', \'(.*)\'\) \?>/sU', $inner, $inner_matches)) {
            $inner = $inner_matches[1];
        }
        $inner = stripslashes($inner);
        $stmt->execute(["faculty_{$code}_objectives_html", $inner, $inner]);
        $content = preg_replace(
            '/<\?= \$setting\(\'faculty_' . $code . '_objectives_html\', \'.*\'\) \?>/sU',
            '<?= $setting(\'faculty_' . $code . '_objectives_html\') ?>',
            $content
        );
    }

    // 4. Fix Audience
    if (preg_match('/<\?= htmlspecialchars\(\$setting\(\'faculty_' . $code . '_audience\', \'(.*)\'\)\) \?>/sU', $content, $matches)) {
        $inner = $matches[1];
        if (preg_match('/<\?= htmlspecialchars\(\$setting\(\'.*?\', \'(.*)\'\)\) \?>/sU', $inner, $inner_matches)) {
            $inner = $inner_matches[1];
        }
        $inner = stripslashes($inner);
        $stmt->execute(["faculty_{$code}_audience", $inner, $inner]);
        $content = preg_replace(
            '/<\?= htmlspecialchars\(\$setting\(\'faculty_' . $code . '_audience\', \'.*\'\)\) \?>/sU',
            '<?= htmlspecialchars($setting(\'faculty_' . $code . '_audience\')) ?>',
            $content
        );
    }
    
    // Also fix single quotes inside htmlspecialchars if there are any that caused syntax errors.
    // By completely removing the second parameter from $setting() in the template, we avoid PHP syntax errors
    // with unescaped quotes entirely, relying on the database default we just inserted.

    file_put_contents($file, $content);
    echo "Fixed and seeded faculty-$code.php<br>";
}
