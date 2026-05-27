<?php
require_once __DIR__ . '/../config/database.php';

$p1 = 'Cross-Cutting Excellence (CCE) is a network of Christian Professionals endeavouring to transform their secular space with the wisdom of God; and we are serious about this. Our mission is to build the capability of Christian Professionals through Seculo-Spiritual Aptitude (SSA).';
$quote = 'Excellence is to excel, to have excess competence, be abundantly fruitful, to have more than may be immediately required...relevant more. Excellence is to possess eternal life.';
$p2 = 'Christians are made to be excellent across-board: perfect unto every good work. The capacity of Christians is more than is needed for themselves; we have capacity to transform our lives, help transform others, catalyse the transformation of a whole global generation, generations; we have capacity even to judge angels. These are not mere accolades; they are the word of God that does not return unto him void until it has accomplished its purpose.';

$stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = IF(setting_value = '' OR setting_value IS NULL, VALUES(setting_value), setting_value)");
$stmt->execute(['about_intro_p1', $p1]);
$stmt->execute(['about_intro_quote', $quote]);
$stmt->execute(['about_intro_p2', $p2]);

echo "Seeded 3 new intro fields.";
