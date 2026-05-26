<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; }
require_once '../config/database.php';
require_once 'helpers.php';

$action = $_GET['action'] ?? 'list';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        $stmt = $pdo->prepare("DELETE FROM companies WHERE id = ?");
        $stmt->execute([$_POST['delete_id']]);
        $message = "Company deleted successfully.";
        $action = 'list';
    } else {
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $logoPath = $_POST['existing_logo'] ?? '';
        
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../assets/image/network/';
            $fileName = 'logo_' . time() . '_' . pathinfo($_FILES['logo']['name'], PATHINFO_FILENAME);
            $targetFile = $uploadDir . $fileName . '.webp';
            
            $finalPath = convertAndSaveToWebp($_FILES['logo']['tmp_name'], $targetFile);
            if ($finalPath) {
                $logoPath = preg_replace('/^\.\.\//', '', $finalPath);
            }
        }

        if ($id) {
            $stmt = $pdo->prepare("UPDATE companies SET name=?, description=?, logo=? WHERE id=?");
            $stmt->execute([$name, $description, $logoPath, $id]);
            $message = "Company updated successfully.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO companies (name, description, logo) VALUES (?, ?, ?)");
            $stmt->execute([$name, $description, $logoPath]);
            $message = "Company added successfully.";
        }
        $action = 'list';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Partners - CCE Admin</title>
    <link rel="icon" href="../assets/image/CCE%20LOGO.png" type="image/png">
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

        <?php if ($action === 'list'): ?>
            <?php 
            $companies = $pdo->query("SELECT * FROM companies ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Manage Institutional Partners</h1>
                    <p class="text-gray-500 mt-1">Logos displayed on the homepage marquee.</p>
                </div>
                <a href="?action=edit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-2 px-6 rounded shadow transition-colors">Add Partner</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($companies as $company): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap bg-gray-50">
                                <img src="../<?= htmlspecialchars($company['logo'] ?? 'assets/image/placeholder.jpg') ?>" class="h-12 w-24 object-contain mix-blend-multiply">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($company['name']) ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="?action=edit&id=<?= $company['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="" method="POST" class="inline" onsubmit="return confirm('Delete this partner?');">
                                    <input type="hidden" name="delete_id" value="<?= $company['id'] ?>">
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($action === 'edit'): ?>
            <?php
            $id = $_GET['id'] ?? null;
            $company = ['name'=>'', 'description'=>'', 'logo'=>''];
            if ($id) {
                $stmt = $pdo->prepare("SELECT * FROM companies WHERE id = ?");
                $stmt->execute([$id]);
                $company = $stmt->fetch(PDO::FETCH_ASSOC) ?: $company;
            }
            ?>
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900"><?= $id ? 'Edit Partner' : 'Add Partner' ?></h1>
                </div>
                <a href="?action=list" class="text-gray-500 hover:text-gray-700">Cancel & Go Back</a>
            </div>

            <form action="" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 max-w-lg">
                <?php if ($id): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <?php endif; ?>
                <input type="hidden" name="existing_logo" value="<?= htmlspecialchars($company['logo']) ?>">

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Name *</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($company['name']) ?>" required class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Description</label>
                        <textarea name="description" rows="5" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary"><?= htmlspecialchars($company['description']) ?></textarea>
                        <p class="text-xs text-gray-500 mt-1">Provide a detailed description of the institutional partner to show on their profile page.</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                        <?php if (!empty($company['logo'])): ?>
                            <img src="../<?= htmlspecialchars($company['logo']) ?>" class="h-16 object-contain mb-2 border p-2 bg-gray-50">
                        <?php endif; ?>
                        <input type="file" name="logo" accept="image/*" class="w-full border-gray-300 rounded-md shadow-sm border p-2">
                        <p class="text-xs text-gray-500 mt-1">Recommended: Transparent PNG or vector SVG.</p>
                    </div>

                    <div class="pt-4 border-t mt-4">
                        <button type="submit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-2 px-6 rounded shadow transition-colors">
                            Save Partner
                        </button>
                    </div>
                </div>
            </form>
        <?php endif; ?>

    </main>
</body>
</html>
