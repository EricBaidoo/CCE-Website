<?php
$filesToMove = [
    "setup_db.php", "migrate_cms.php", "migrate_data.php", "remove_ext.php", 
    "remove_ext2.php", "remove_ext3.php", "remove_ext4.php", "remove_ext5.php", 
    "generate_faculties.php", "optimize_images.php", "test_webp.php", "seed.php", 
    "update_db_schema.php", "upgrade_db.php", "upgrade_faculties.php", 
    "add_company_desc.php", "debug_db.php", "fix_admin.php", "database.sql"
];

$targetDir = __DIR__ . '/scripts';
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$count = 0;
foreach ($filesToMove as $file) {
    if (file_exists(__DIR__ . '/' . $file)) {
        rename(__DIR__ . '/' . $file, $targetDir . '/' . $file);
        $count++;
    }
}

echo "Moved $count development scripts to the scripts/ directory.\n";
?>
