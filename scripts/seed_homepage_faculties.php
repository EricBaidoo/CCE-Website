<?php
require_once __DIR__ . '/../config/database.php';

$faculties = [
    ['id'=>'gad', 'icon'=>'GAD', 'name'=>'Governance & Development', 'default_desc'=>'Strengthening public policy and institutional capacity.'],
    ['id'=>'eat', 'icon'=>'EAT', 'name'=>'Education & Training', 'default_desc'=>'Empowering educators to formulate robust systems.'],
    ['id'=>'sat', 'icon'=>'SAT', 'name'=>'Science & Technology', 'default_desc'=>'Promoting ethical innovation and research.'],
    ['id'=>'paa', 'icon'=>'PAA', 'name'=>'Philosophy & Arts', 'default_desc'=>'Integrating culture to shape global worldviews.'],
    ['id'=>'fab', 'icon'=>'FAB', 'name'=>'Finance & Business', 'default_desc'=>'Driving economies with competence and godliness.'],
    ['id'=>'raf', 'icon'=>'RAF', 'name'=>'Relationship & Family', 'default_desc'=>'Building strong godly families and relationships.'],
    ['id'=>'maa', 'icon'=>'MAA', 'name'=>'Missions & Apologetics', 'default_desc'=>'Engaging culture and defending the faith.'],
    ['id'=>'cam', 'icon'=>'CAM', 'name'=>'Communication & Media', 'default_desc'=>'Communicating truth in the global media space.'],
];

$stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = IF(setting_value = '' OR setting_value IS NULL, VALUES(setting_value), setting_value)");

foreach ($faculties as $fac) {
    $descKey = "home_faculty_{$fac['id']}_desc";
    $imgKey = "home_faculty_{$fac['id']}_image";
    $imgPath = "assets/image/FE-icons/{$fac['icon']}.svg";
    
    $stmt->execute([$descKey, $fac['default_desc']]);
    $stmt->execute([$imgKey, $imgPath]);
}

echo "Seeded homepage faculty defaults.";
