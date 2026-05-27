<?php
$faculties = ['gad', 'eat', 'sat', 'paa', 'fab', 'raf', 'maa', 'cam'];

foreach ($faculties as $code) {
    $file = __DIR__ . '/../faculty-' . $code . '.php';
    if (!file_exists($file)) continue;
    
    $content = file_get_contents($file);
    
    // Replace Hero Desc
    $content = preg_replace(
        '/<p class="text-xl md:text-2xl text-gray-300 font-light leading-relaxed max-w-3xl">\s*(.*?)\s*<\/p>/s',
        '<p class="text-xl md:text-2xl text-gray-300 font-light leading-relaxed max-w-3xl">
                <?= htmlspecialchars($setting(\'faculty_' . $code . '_hero_desc\', \'$1\')) ?>
            </p>',
        $content,
        1
    );

    // Replace Vision & Mission
    $content = preg_replace(
        '/<h2 class="text-3xl font-heading font-bold text-primary mb-6 border-b-2 border-secondary pb-2 inline-block">VISION & MISSION<\/h2>\s*<p class="text-gray-700 leading-loose text-lg font-light">\s*(.*?)\s*<\/p>/s',
        '<h2 class="text-3xl font-heading font-bold text-primary mb-6 border-b-2 border-secondary pb-2 inline-block">VISION & MISSION</h2>
                        <p class="text-gray-700 leading-loose text-lg font-light">
                            <?= htmlspecialchars($setting(\'faculty_' . $code . '_vision_mission\', \'$1\')) ?>
                        </p>',
        $content,
        1
    );

    // Replace Objectives
    $content = preg_replace(
        '/<ul class="list-disc pl-6 space-y-4 text-gray-700 text-lg font-light marker:text-secondary">\s*(.*?)\s*<\/ul>/s',
        '<ul class="list-disc pl-6 space-y-4 text-gray-700 text-lg font-light marker:text-secondary">
                            <?= $setting(\'faculty_' . $code . '_objectives_html\', \'$1\') ?>
                        </ul>',
        $content,
        1
    );

    // Replace Audience
    $content = preg_replace(
        '/<h3 class="text-xl font-heading font-bold text-primary mb-4 uppercase tracking-wider">Who Should Join\?<\/h3>\s*<p class="text-gray-600 font-light leading-relaxed mb-6">\s*(.*?)\s*<\/p>/s',
        '<h3 class="text-xl font-heading font-bold text-primary mb-4 uppercase tracking-wider">Who Should Join?</h3>
                        <p class="text-gray-600 font-light leading-relaxed mb-6">
                            <?= htmlspecialchars($setting(\'faculty_' . $code . '_audience\', \'$1\')) ?>
                        </p>',
        $content,
        1
    );

    file_put_contents($file, $content);
    echo "Updated faculty-$code.php<br>";
}
