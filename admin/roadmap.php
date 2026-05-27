<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; }
require_once '../config/database.php';
require_once 'helpers.php';

$action = $_GET['action'] ?? 'list';
$message = $_SESSION['flash_message'] ?? '';
unset($_SESSION['flash_message']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        $stmt = $pdo->prepare("DELETE FROM roadmap_phases WHERE id = ?");
        $stmt->execute([$_POST['delete_id']]);
        $_SESSION['flash_message'] = "Phase deleted successfully.";
        header("Location: roadmap.php?action=list");
        exit;
    } else {
        $id = $_POST['id'] ?? null;
        $title = $_POST['title'] ?? '';
        $bullets = $_POST['bullets'] ?? '';
        $sort_order = $_POST['sort_order'] ?? 0;

        if ($id) {
            $stmt = $pdo->prepare("UPDATE roadmap_phases SET title=?, bullets=?, sort_order=? WHERE id=?");
            $stmt->execute([$title, $bullets, $sort_order, $id]);
            $_SESSION['flash_message'] = "Phase updated successfully.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO roadmap_phases (title, bullets, sort_order) VALUES (?, ?, ?)");
            $stmt->execute([$title, $bullets, $sort_order]);
            $_SESSION['flash_message'] = "Phase added successfully.";
        }
        header("Location: roadmap.php?action=list");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Strategic Roadmap - CCE Admin</title>
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
            $phases = $pdo->query("SELECT * FROM roadmap_phases ORDER BY sort_order ASC")->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Manage Strategic Roadmap</h1>
                    <p class="text-gray-500 mt-1">Add, edit, or remove phases from the About Us roadmap.</p>
                </div>
                <a href="?action=edit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-2 px-6 rounded shadow transition-colors">Add Phase</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phase Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($phases as $phase): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-primary"><?= htmlspecialchars($phase['title']) ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= $phase['sort_order'] ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="?action=edit&id=<?= $phase['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="" method="POST" class="inline" onsubmit="return confirm('Delete this phase?');">
                                    <input type="hidden" name="delete_id" value="<?= $phase['id'] ?>">
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($phases)): ?>
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">No phases found. Click "Add Phase" to create one.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($action === 'edit'): ?>
            <?php
            $id = $_GET['id'] ?? null;
            $phase = ['title'=>'', 'bullets'=>'', 'sort_order'=>'0'];
            if ($id) {
                $stmt = $pdo->prepare("SELECT * FROM roadmap_phases WHERE id = ?");
                $stmt->execute([$id]);
                $phase = $stmt->fetch(PDO::FETCH_ASSOC) ?: $phase;
            }
            ?>
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900"><?= $id ? 'Edit Phase' : 'Add Phase' ?></h1>
                </div>
                <a href="?action=list" class="text-gray-500 hover:text-gray-700">Cancel & Go Back</a>
            </div>

            <form action="" method="POST" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 max-w-2xl">
                <?php if ($id): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <?php endif; ?>

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phase Title *</label>
                        <input type="text" name="title" required value="<?= htmlspecialchars($phase['title']) ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary" placeholder="e.g. PHASE I: Establishment (2016-2021)">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phase Bullets * (One item per line)</label>
                        <p class="text-xs text-gray-500 mb-2">Do not enter HTML. Type one point per line, and the system will format them automatically.</p>
                        <textarea name="bullets" required rows="5" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary" placeholder="First point&#10;Second point&#10;Third point"><?= htmlspecialchars($phase['bullets']) ?></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="<?= $phase['sort_order'] ?>" class="w-24 border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                        <span class="text-xs text-gray-500 ml-2">Lower numbers appear first.</span>
                    </div>
                </div>

                <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end">
                    <button type="submit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-2 px-8 rounded shadow transition-colors">
                        Save Phase
                    </button>
                </div>
            </form>
        <?php endif; ?>

    </main>
</body>
</html>
