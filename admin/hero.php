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
        $stmt = $pdo->prepare("DELETE FROM hero_slides WHERE id = ?");
        $stmt->execute([$_POST['delete_id']]);
        $_SESSION['flash_message'] = "Slide deleted successfully.";
        header("Location: hero.php?action=list");
        exit;
    } else {
        $id = $_POST['id'] ?? null;
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $button_text = $_POST['button_text'] ?? '';
        $button_link = $_POST['button_link'] ?? '';
        $slide_order = $_POST['slide_order'] ?? 0;
        $image_position = $_POST['image_position'] ?? 'object-center';
        $layout_style = $_POST['layout_style'] ?? 'text_left';
        $image_caption_name = $_POST['image_caption_name'] ?? '';
        $image_caption_title = $_POST['image_caption_title'] ?? '';
        $imagePath = $_POST['existing_image'] ?? '';
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../assets/image/hero/';
            $fileName = 'hero_' . time() . '_' . pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
            $targetFile = $uploadDir . $fileName . '.webp';
            
            $finalPath = convertAndSaveToWebp($_FILES['image']['tmp_name'], $targetFile);
            if ($finalPath) {
                $imagePath = preg_replace('/^\.\.\//', '', $finalPath);
            }
        }

        if ($id) {
            $stmt = $pdo->prepare("UPDATE hero_slides SET title=?, description=?, button_text=?, button_link=?, slide_order=?, image_path=?, image_position=?, layout_style=?, image_caption_name=?, image_caption_title=? WHERE id=?");
            $stmt->execute([$title, $description, $button_text, $button_link, $slide_order, $imagePath, $image_position, $layout_style, $image_caption_name, $image_caption_title, $id]);
            $_SESSION['flash_message'] = "Slide updated successfully.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO hero_slides (title, description, button_text, button_link, slide_order, image_path, image_position, layout_style, image_caption_name, image_caption_title) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $description, $button_text, $button_link, $slide_order, $imagePath, $image_position, $layout_style, $image_caption_name, $image_caption_title]);
            $_SESSION['flash_message'] = "Slide added successfully.";
        }
        header("Location: hero.php?action=list");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Hero Carousel - CCE Admin</title>
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

        <?php if ($action === 'list'): ?>
            <?php 
            $slides = $pdo->query("SELECT * FROM hero_slides ORDER BY slide_order ASC")->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Manage Hero Carousel</h1>
                    <p class="text-gray-500 mt-1">Homepage dynamic slider content.</p>
                </div>
                <a href="?action=edit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-2 px-6 rounded shadow transition-colors">Add Slide</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($slides as $slide): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="../<?= htmlspecialchars($slide['image_path']) ?>" class="h-12 w-20 object-cover border border-gray-200">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($slide['title']) ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= $slide['slide_order'] ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="?action=edit&id=<?= $slide['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="" method="POST" class="inline" onsubmit="return confirm('Delete this slide?');">
                                    <input type="hidden" name="delete_id" value="<?= $slide['id'] ?>">
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
            $slide = ['title'=>'', 'description'=>'', 'button_text'=>'', 'button_link'=>'', 'slide_order'=>'0', 'image_path'=>'', 'image_position'=>'object-center', 'layout_style'=>'text_left', 'image_caption_name'=>'', 'image_caption_title'=>''];
            if ($id) {
                $stmt = $pdo->prepare("SELECT * FROM hero_slides WHERE id = ?");
                $stmt->execute([$id]);
                $slide = $stmt->fetch(PDO::FETCH_ASSOC) ?: $slide;
            }
            ?>
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900"><?= $id ? 'Edit Slide' : 'Add Slide' ?></h1>
                </div>
                <a href="?action=list" class="text-gray-500 hover:text-gray-700">Cancel & Go Back</a>
            </div>

            <form action="" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 max-w-2xl">
                <?php if ($id): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <?php endif; ?>
                <input type="hidden" name="existing_image" value="<?= htmlspecialchars($slide['image_path']) ?>">

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Slide Title *</label>
                        <input type="text" name="title" value="<?= htmlspecialchars($slide['title']) ?>" required class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="3" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary"><?= htmlspecialchars($slide['description']) ?></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
                            <input type="text" name="button_text" value="<?= htmlspecialchars($slide['button_text']) ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Button Link URL</label>
                            <input type="text" name="button_link" value="<?= htmlspecialchars($slide['button_link']) ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Display Order</label>
                            <input type="number" name="slide_order" value="<?= htmlspecialchars($slide['slide_order']) ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                            <p class="text-xs text-gray-500 mt-1">Lower numbers appear first.</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Image Focus (Position)</label>
                            <select name="image_position" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                                <option value="object-center" <?= $slide['image_position'] === 'object-center' ? 'selected' : '' ?>>Center</option>
                                <option value="object-top" <?= $slide['image_position'] === 'object-top' ? 'selected' : '' ?>>Top</option>
                                <option value="object-bottom" <?= $slide['image_position'] === 'object-bottom' ? 'selected' : '' ?>>Bottom</option>
                                <option value="object-left" <?= $slide['image_position'] === 'object-left' ? 'selected' : '' ?>>Left</option>
                                <option value="object-right" <?= $slide['image_position'] === 'object-right' ? 'selected' : '' ?>>Right</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Adjust if image gets cropped badly.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Layout Style</label>
                            <select name="layout_style" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                                <option value="text_left" <?= $slide['layout_style'] === 'text_left' ? 'selected' : '' ?>>Text Left, Image Right</option>
                                <option value="text_right" <?= $slide['layout_style'] === 'text_right' ? 'selected' : '' ?>>Image Left, Text Right</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Which side should the text appear on desktop?</p>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4 mt-2">
                        <h3 class="text-sm font-bold text-gray-800 mb-4 uppercase">Optional Image Overlay (Caption)</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Image Subject Name</label>
                                <input type="text" name="image_caption_name" value="<?= htmlspecialchars($slide['image_caption_name']) ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary" placeholder="e.g. Emmanuel Kwame Mensah">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Image Subject Title</label>
                                <input type="text" name="image_caption_title" value="<?= htmlspecialchars($slide['image_caption_title']) ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary" placeholder="e.g. General Coordinator">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Slide Background Image</label>
                        <?php if (!empty($slide['image_path'])): ?>
                            <img src="../<?= htmlspecialchars($slide['image_path']) ?>" class="h-24 object-cover mb-2 border p-1 bg-gray-50">
                        <?php endif; ?>
                        <input type="file" name="image" accept="image/*" <?= !$id ? 'required' : '' ?> class="w-full border-gray-300 rounded-md shadow-sm border p-2">
                        <p class="text-xs text-gray-500 mt-1">Recommended: High quality horizontal image (e.g. 1920x1080).</p>
                    </div>

                    <div class="pt-4 border-t mt-4">
                        <button type="submit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-2 px-6 rounded shadow transition-colors">
                            Save Slide
                        </button>
                    </div>
                </div>
            </form>
        <?php endif; ?>

    </main>
</body>
</html>
