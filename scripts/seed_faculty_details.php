<?php
require_once __DIR__ . '/../config/database.php';

$faculties = [
    'gad' => 'Governance & Development',
    'eat' => 'Education & Training',
    'sat' => 'Science & Technology',
    'paa' => 'Philosophy & Arts',
    'fab' => 'Finance & Business',
    'raf' => 'Relationship & Family',
    'maa' => 'Missions & Apologetics',
    'cam' => 'Communication & Media',
];

$stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = IF(setting_value = '' OR setting_value IS NULL, VALUES(setting_value), setting_value)");

foreach ($faculties as $code => $name) {
    // 1. Hero
    $stmt->execute([
        "faculty_{$code}_hero_desc", 
        "Welcome to the $name Faculty Endeavour. We are equipping Christian professionals to transform this sphere with the wisdom of God."
    ]);
    
    // 2. Vision & Mission
    $stmt->execute([
        "faculty_{$code}_vision_mission", 
        "Our vision is to see the $name sector fully aligned with God's redemptive purpose. Our mission is to build the capacity of practitioners to exercise godly wisdom, competence, and seculo-spiritual aptitude in every engagement."
    ]);

    // 3. Objectives
    $stmt->execute([
        "faculty_{$code}_objectives", 
        "To provide rigorous training and capacity building for professionals.\nTo foster a supportive network of Christian practitioners.\nTo develop innovative, ethical, and sustainable solutions.\nTo influence policies and frameworks with biblical principles."
    ]);

    // 4. Audience
    $stmt->execute([
        "faculty_{$code}_audience", 
        "Professionals seeking to align their career with God's redemptive purpose."
    ]);
}

echo "Seeded detailed faculty contents.";
