<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; }
require_once '../config/database.php';
require_once 'helpers.php';

$message = $_SESSION['flash_message'] ?? '';
unset($_SESSION['flash_message']);

// Define the schema for editable page content
$page_schema = [
    'Homepage' => [
        'home_faculties_title' => ['label' => 'Faculties Section Title', 'type' => 'text'],
    ],
    'About Us: Hero & Intro' => [
        'about_hero_title' => ['label' => 'Hero Title', 'type' => 'text'],
        'about_hero_desc' => ['label' => 'Hero Description', 'type' => 'textarea'],
        'about_vision' => ['label' => 'Our Vision', 'type' => 'textarea'],
        'about_mission' => ['label' => 'Our Mission', 'type' => 'textarea'],
        'about_intro_p1' => ['label' => 'Introduction (First Paragraph)', 'type' => 'textarea'],
        'about_intro_quote' => ['label' => 'Introduction (Pull Quote)', 'type' => 'textarea'],
        'about_intro_p2' => ['label' => 'Introduction (Final Paragraph)', 'type' => 'textarea'],
    ],
    'About Us: The Charter' => [
        'about_charter_1_title' => ['label' => 'Point 1 Title', 'type' => 'text'],
        'about_charter_1_desc' => ['label' => 'Point 1 Description', 'type' => 'textarea'],
        'about_charter_2_title' => ['label' => 'Point 2 Title', 'type' => 'text'],
        'about_charter_2_desc' => ['label' => 'Point 2 Description', 'type' => 'textarea'],
        'about_charter_3_title' => ['label' => 'Point 3 Title', 'type' => 'text'],
        'about_charter_3_desc' => ['label' => 'Point 3 Description', 'type' => 'textarea'],
        'about_charter_4_title' => ['label' => 'Point 4 Title', 'type' => 'text'],
        'about_charter_4_desc' => ['label' => 'Point 4 Description', 'type' => 'textarea'],
        'about_charter_5_title' => ['label' => 'Point 5 Title', 'type' => 'text'],
        'about_charter_5_desc' => ['label' => 'Point 5 Description', 'type' => 'textarea'],
        'about_charter_6_title' => ['label' => 'Point 6 Title', 'type' => 'text'],
        'about_charter_6_desc' => ['label' => 'Point 6 Description', 'type' => 'textarea'],
        'about_charter_7_title' => ['label' => 'Point 7 Title', 'type' => 'text'],
        'about_charter_7_desc' => ['label' => 'Point 7 Description', 'type' => 'textarea'],
        'about_charter_8_title' => ['label' => 'Point 8 Title', 'type' => 'text'],
        'about_charter_8_desc' => ['label' => 'Point 8 Description', 'type' => 'textarea'],
    ],
    'About Us: Institutional History' => [
        'about_history_1_title' => ['label' => 'Phase 1 Title', 'type' => 'text'],
        'about_history_1_desc' => ['label' => 'Phase 1 Description', 'type' => 'textarea'],
        'about_history_2_title' => ['label' => 'Phase 2 Title', 'type' => 'text'],
        'about_history_2_desc' => ['label' => 'Phase 2 Description', 'type' => 'textarea'],
        'about_history_3_title' => ['label' => 'Phase 3 Title', 'type' => 'text'],
        'about_history_3_desc' => ['label' => 'Phase 3 Description', 'type' => 'textarea'],
    ],

    'About Us: Operational Framework' => [
        'about_ops_intro' => ['label' => 'Operations Intro Text', 'type' => 'textarea'],
        'about_ops_1_title' => ['label' => 'Item 1 Title', 'type' => 'text'],
        'about_ops_1_desc' => ['label' => 'Item 1 Description', 'type' => 'textarea'],
        'about_ops_2_title' => ['label' => 'Item 2 Title', 'type' => 'text'],
        'about_ops_2_desc' => ['label' => 'Item 2 Description', 'type' => 'textarea'],
        'about_ops_3_title' => ['label' => 'Item 3 Title', 'type' => 'text'],
        'about_ops_3_desc' => ['label' => 'Item 3 Description', 'type' => 'textarea'],
        'about_ops_4_title' => ['label' => 'Item 4 Title', 'type' => 'text'],
        'about_ops_4_desc' => ['label' => 'Item 4 Description', 'type' => 'textarea'],
        'about_ops_5_title' => ['label' => 'Item 5 Title', 'type' => 'text'],
        'about_ops_5_desc' => ['label' => 'Item 5 Description', 'type' => 'textarea'],
    ],
    'Resources' => [
        'resources_hero_title' => ['label' => 'Hero Title', 'type' => 'text'],
        'resources_hero_desc' => ['label' => 'Hero Description', 'type' => 'textarea'],
    ],
    'Get Involved' => [
        'involved_hero_title' => ['label' => 'Hero Title', 'type' => 'text'],
        'involved_hero_desc' => ['label' => 'Hero Description', 'type' => 'textarea'],
    ],
];

// Add all 8 faculties to the schema dynamically
$faculties_list = [
    'gad' => 'Governance & Development',
    'eat' => 'Education & Training',
    'sat' => 'Science & Technology',
    'paa' => 'Philosophy & Arts',
    'fab' => 'Finance & Business',
    'raf' => 'Relationship & Family',
    'maa' => 'Missions & Apologetics',
    'cam' => 'Communication & Media',
];

foreach ($faculties_list as $code => $name) {
    // Add Homepage fields
    $page_schema['Homepage']["home_faculty_{$code}_desc"] = ['label' => "$name (Homepage Brief Content)", 'type' => 'textarea'];
    $page_schema['Homepage']["home_faculty_{$code}_image"] = ['label' => "$name (Homepage Icon/Image)", 'type' => 'image'];
}

foreach ($faculties_list as $code => $name) {
    $page_schema["Faculty: $name"] = [
        "faculty_{$code}_hero_desc" => ['label' => 'Hero Description', 'type' => 'textarea'],
        "faculty_{$code}_vision_mission" => ['label' => 'Vision & Mission Text', 'type' => 'textarea'],
        "faculty_{$code}_objectives" => ['label' => 'Key Objectives (One per line)', 'type' => 'textarea'],
        "faculty_{$code}_audience" => ['label' => 'Target Audience (Who Should Join)', 'type' => 'textarea'],
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");
    
    if (isset($_POST['settings'])) {
        foreach ($_POST['settings'] as $key => $value) {
            $stmt->execute([$key, $value, $value]);
        }
    }
    
    if (isset($_FILES['settings_files'])) {
        $uploadDir = '../assets/image/FE-icons/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        
        foreach ($_FILES['settings_files']['name'] as $key => $filename) {
            if ($_FILES['settings_files']['error'][$key] === UPLOAD_ERR_OK) {
                $tmpName = $_FILES['settings_files']['tmp_name'][$key];
                $destFile = $uploadDir . $key . '_' . time() . '.webp';
                $finalPath = convertAndSaveToWebp($tmpName, $destFile);
                if ($finalPath) {
                    $imagePath = preg_replace('/^\.\.\//', '', $finalPath);
                    $stmt->execute([$key, $imagePath, $imagePath]);
                }
            }
        }
    }
    
    $_SESSION['flash_message'] = "Page content updated successfully.";
    header("Location: pages.php");
    exit;
}

// Fetch all settings
$stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings");
$current_settings = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $current_settings[$row['setting_key']] = $row['setting_value'];
}

function getVal($key, $current_settings) {
    return htmlspecialchars($current_settings[$key] ?? '');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Page Content - CCE Admin</title>
    <link rel="icon" href="../assets/image/logo.webp" type="image/webp">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { primary: '#251A5A', secondary: '#E07A2A' } } } }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex">
    <?php include 'sidebar.php'; ?>

    <main class="flex-1 p-8 overflow-y-auto">
        <?php if ($message): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Manage Page Content</h1>
            <p class="text-gray-500 mt-1">Edit the text and descriptions that appear across various pages.</p>
        </div>

        <form action="" method="POST" enctype="multipart/form-data" class="space-y-8">
            <?php foreach ($page_schema as $group_name => $fields): ?>
                <details class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden group mb-4">
                    <summary class="bg-gray-50 px-6 py-4 border-b border-gray-200 cursor-pointer font-bold text-xl text-primary flex justify-between items-center hover:bg-indigo-50 transition-colors">
                        <?= htmlspecialchars($group_name) ?>
                        <svg class="w-6 h-6 transform transition-transform group-open:rotate-180 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </summary>
                    <div class="p-6 space-y-6">
                            <?php foreach ($fields as $key => $field): ?>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1"><?= htmlspecialchars($field['label']) ?></label>
                                    <?php if ($field['type'] === 'textarea'): ?>
                                        <textarea name="settings[<?= $key ?>]" rows="4" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary"><?= getVal($key, $current_settings) ?></textarea>
                                    <?php elseif ($field['type'] === 'image'): ?>
                                        <?php $currentImg = getVal($key, $current_settings); ?>
                                        <?php if ($currentImg): ?>
                                            <div class="mb-2">
                                                <img src="../<?= $currentImg ?>" class="h-16 object-contain bg-gray-50 rounded border border-gray-200">
                                            </div>
                                        <?php endif; ?>
                                        <input type="file" name="settings_files[<?= $key ?>]" accept="image/*" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                                    <?php else: ?>
                                        <input type="text" name="settings[<?= $key ?>]" value="<?= getVal($key, $current_settings) ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                    </div>
                </details>
            <?php endforeach; ?>

            <div class="sticky bottom-0 bg-white p-4 border-t border-gray-200 flex justify-end shadow-lg rounded-t-xl z-10">
                <button type="submit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-2 px-8 rounded shadow transition-colors text-lg">
                    Save All Changes
                </button>
            </div>
        </form>

    </main>
</body>
</html>
