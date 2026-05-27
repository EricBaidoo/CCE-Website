<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
require_once '../config/database.php';
require_once 'helpers.php';

$message = $_SESSION['flash_message'] ?? '';
unset($_SESSION['flash_message']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE site_settings SET setting_value = ? WHERE setting_key = ?");
    if (isset($_POST['settings']) && is_array($_POST['settings'])) {
        foreach ($_POST['settings'] as $key => $value) {
            $stmt->execute([$value, $key]);
        }
    }
    
    // Handle image upload for coordinator_image
    if (isset($_FILES['coordinator_image_file']) && $_FILES['coordinator_image_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/image/pics/';
        $fileName = 'coordinator_' . time() . '_' . pathinfo($_FILES['coordinator_image_file']['name'], PATHINFO_FILENAME);
        $targetFile = $uploadDir . $fileName . '.webp';
        
        $finalPath = convertAndSaveToWebp($_FILES['coordinator_image_file']['tmp_name'], $targetFile);
        if ($finalPath) {
            $publicPath = preg_replace('/^\.\.\//', '', $finalPath);
            $stmt->execute([$publicPath, 'coordinator_image']);
        }
    }

    // Handle site_logo upload
    if (isset($_FILES['site_logo_file']) && $_FILES['site_logo_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/image/';
        $fileName = 'site_logo_' . time();
        $targetFile = $uploadDir . $fileName . '.webp';
        
        $finalPath = convertAndSaveToWebp($_FILES['site_logo_file']['tmp_name'], $targetFile);
        if ($finalPath) {
            $publicPath = preg_replace('/^\.\.\//', '', $finalPath);
            // Insert or Update site_logo
            $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM site_settings WHERE setting_key = 'site_logo'");
            $checkStmt->execute();
            if ($checkStmt->fetchColumn() > 0) {
                $stmt->execute([$publicPath, 'site_logo']);
            } else {
                $insertStmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES ('site_logo', ?)");
                $insertStmt->execute([$publicPath]);
            }
        }
    }
    
    $_SESSION['flash_message'] = "Global settings updated successfully.";
    header("Location: settings.php");
    exit;
}

// Fetch all current settings
$settingsStmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings");
$settingsArray = $settingsStmt->fetchAll(PDO::FETCH_KEY_PAIR);
$setting = function($key) use ($settingsArray) {
    return htmlspecialchars($settingsArray[$key] ?? '');
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Settings - CCE Admin</title>
    <link rel="icon" href="../assets/image/logo.webp" type="image/webp">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: { primary: '#251A5A', secondary: '#E07A2A' } } }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex">
    <?php include 'sidebar.php'; ?>

    <main class="flex-1 p-8 overflow-y-auto">
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Global Site Settings</h1>
            <p class="text-gray-500 mt-1">Manage all dynamic text across the public website.</p>
        </header>

        <?php if ($message): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                <span class="block sm:inline"><?= $message ?></span>
            </div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data" class="space-y-8 max-w-4xl">
            
            <!-- SEO & Meta -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">General & SEO</h2>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Site Logo</label>
                        <?php if (!empty($settingsArray['site_logo'])): ?>
                            <img src="../<?= htmlspecialchars($settingsArray['site_logo']) ?>" class="h-16 object-contain mb-2 border p-1 bg-gray-50">
                        <?php endif; ?>
                        <input type="file" name="site_logo_file" accept="image/*" class="w-full border-gray-300 rounded-md shadow-sm border p-2">
                        <p class="text-xs text-gray-500 mt-1">Upload to replace the logo. Recommended format: WebP or PNG with transparent background.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Site Title</label>
                        <input type="text" name="settings[site_title]" value="<?= $setting('site_title') ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Site Description (Meta)</label>
                        <textarea name="settings[site_description]" rows="2" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary"><?= $setting('site_description') ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Top Bar Welcome Message</label>
                        <input type="text" name="settings[welcome_message]" value="<?= $setting('welcome_message') ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>
                </div>
            </div>

            <!-- Contact & Socials -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">Contact & Social Links (Footer)</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Email</label>
                        <input type="text" name="settings[contact_email]" value="<?= $setting('contact_email') ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Phone</label>
                        <input type="text" name="settings[contact_phone]" value="<?= $setting('contact_phone') ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Address</label>
                        <input type="text" name="settings[contact_address]" value="<?= $setting('contact_address') ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Facebook URL</label>
                        <input type="text" name="settings[social_facebook]" value="<?= $setting('social_facebook') ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Twitter URL</label>
                        <input type="text" name="settings[social_twitter]" value="<?= $setting('social_twitter') ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label>
                        <input type="text" name="settings[social_linkedin]" value="<?= $setting('social_linkedin') ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instagram URL</label>
                        <input type="text" name="settings[social_instagram]" value="<?= $setting('social_instagram') ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>
                </div>
            </div>

            <!-- General Coordinator Section -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h2 class="text-xl font-bold text-primary mb-4 border-b pb-2">General Coordinator Block (Homepage)</h2>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Coordinator Name</label>
                        <input type="text" name="settings[coordinator_name]" value="<?= $setting('coordinator_name') ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Current Coordinator Image</label>
                        <?php if ($settingsArray['coordinator_image']): ?>
                            <img src="../<?= htmlspecialchars($settingsArray['coordinator_image']) ?>" class="h-32 object-contain mb-2 border p-1 bg-gray-50">
                        <?php endif; ?>
                        <input type="file" name="coordinator_image_file" accept="image/*" class="w-full border-gray-300 rounded-md shadow-sm border p-2">
                        <p class="text-xs text-gray-500 mt-1">Upload to replace the image. Leave blank to keep current.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quote (Large Italic Text)</label>
                        <textarea name="settings[coordinator_quote]" rows="2" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary"><?= $setting('coordinator_quote') ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Main Message (HTML allowed)</label>
                        <textarea name="settings[coordinator_message]" rows="8" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary font-mono text-sm"><?= $setting('coordinator_message') ?></textarea>
                        <p class="text-xs text-gray-500 mt-1">Use HTML tags like &lt;p&gt; and &lt;br&gt; to format paragraphs.</p>
                    </div>
                </div>
            </div>

            <div class="pt-4 pb-12">
                <button type="submit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-3 px-8 rounded shadow-lg transition-colors uppercase tracking-widest text-sm">
                    Save All Settings
                </button>
            </div>
            
        </form>
    </main>
</body>
</html>
