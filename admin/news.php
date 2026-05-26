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
        $stmt = $pdo->prepare("DELETE FROM news WHERE id = ?");
        $stmt->execute([$_POST['delete_id']]);
        $_SESSION['flash_message'] = "News article deleted successfully.";
        header("Location: news.php?action=list");
        exit;
    } else {
        $id = $_POST['id'] ?? null;
        $title = $_POST['title'] ?? '';
        $author = $_POST['author'] ?? '';
        $published_at = $_POST['published_at'] ?? date('Y-m-d');
        $excerpt = $_POST['excerpt'] ?? '';
        $content = $_POST['content'] ?? '';
        $faculty_id = !empty($_POST['faculty_id']) ? $_POST['faculty_id'] : null;
        $imagePath = $_POST['existing_image'] ?? '';
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../assets/image/news/';
            $fileName = 'news_' . time() . '_' . pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
            $targetFile = $uploadDir . $fileName . '.webp';
            
            $finalPath = convertAndSaveToWebp($_FILES['image']['tmp_name'], $targetFile);
            if ($finalPath) {
                $imagePath = preg_replace('/^\.\.\//', '', $finalPath);
            }
        }

        if ($id) {
            $stmt = $pdo->prepare("UPDATE news SET title=?, author=?, published_at=?, excerpt=?, content=?, featured_image=?, faculty_id=? WHERE id=?");
            $stmt->execute([$title, $author, $published_at, $excerpt, $content, $imagePath, $faculty_id, $id]);
            $_SESSION['flash_message'] = "News article updated successfully.";
        } else {
            // Generate a slug-like ID
            $newId = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-')) . '-' . uniqid();
            $stmt = $pdo->prepare("INSERT INTO news (id, title, author, published_at, excerpt, content, featured_image, faculty_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$newId, $title, $author, $published_at, $excerpt, $content, $imagePath, $faculty_id]);
            $_SESSION['flash_message'] = "News article published successfully.";
        }
        header("Location: news.php?action=list");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage News - CCE Admin</title>
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
            $articles = $pdo->query("SELECT * FROM news ORDER BY published_at DESC")->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Manage News & Reports</h1>
                    <p class="text-gray-500 mt-1">Publish and edit articles for the public site.</p>
                </div>
                <a href="?action=edit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-2 px-6 rounded shadow transition-colors">Publish News</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($articles as $article): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="../<?= htmlspecialchars($article['featured_image'] ?? 'assets/image/placeholder.jpg') ?>" class="h-12 w-16 object-cover border border-gray-200">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 truncate w-64"><?= htmlspecialchars($article['title']) ?></div>
                                <div class="text-xs text-gray-500">By <?= htmlspecialchars($article['author']) ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= date('M d, Y', strtotime($article['published_at'])) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="?action=edit&id=<?= urlencode($article['id']) ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="" method="POST" class="inline" onsubmit="return confirm('Delete this article?');">
                                    <input type="hidden" name="delete_id" value="<?= htmlspecialchars($article['id']) ?>">
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($articles)): ?>
                        <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">No news articles found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($action === 'edit'): ?>
            <?php
            $id = $_GET['id'] ?? null;
            $article = ['title'=>'', 'author'=>'', 'published_at'=>date('Y-m-d'), 'excerpt'=>'', 'content'=>'', 'featured_image'=>'', 'faculty_id'=>''];
            if ($id) {
                $stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
                $stmt->execute([$id]);
                $article = $stmt->fetch(PDO::FETCH_ASSOC) ?: $article;
            }
            ?>
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900"><?= $id ? 'Edit Article' : 'Publish News' ?></h1>
                </div>
                <a href="?action=list" class="text-gray-500 hover:text-gray-700">Cancel & Go Back</a>
            </div>

            <form action="" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 max-w-4xl">
                <?php if ($id): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <?php endif; ?>
                <input type="hidden" name="existing_image" value="<?= htmlspecialchars($article['featured_image']) ?>">

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Headline Title *</label>
                        <input type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>" required class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                            <input type="text" name="author" value="<?= htmlspecialchars($article['author']) ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Publish Date</label>
                            <input type="date" name="published_at" value="<?= htmlspecialchars($article['published_at']) ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Associated Faculty</label>
                        <select name="faculty_id" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                            <option value="">-- None (General News) --</option>
                            <option value="gad" <?= ($article['faculty_id']??'') == 'gad' ? 'selected' : '' ?>>Governance & Development (GAD)</option>
                            <option value="eat" <?= ($article['faculty_id']??'') == 'eat' ? 'selected' : '' ?>>Education & Training (EAT)</option>
                            <option value="sat" <?= ($article['faculty_id']??'') == 'sat' ? 'selected' : '' ?>>Science & Technology (SAT)</option>
                            <option value="paa" <?= ($article['faculty_id']??'') == 'paa' ? 'selected' : '' ?>>Philosophy & Arts (PAA)</option>
                            <option value="fab" <?= ($article['faculty_id']??'') == 'fab' ? 'selected' : '' ?>>Finance & Business (FAB)</option>
                            <option value="raf" <?= ($article['faculty_id']??'') == 'raf' ? 'selected' : '' ?>>Relationship & Family (RAF)</option>
                            <option value="maa" <?= ($article['faculty_id']??'') == 'maa' ? 'selected' : '' ?>>Missions & Apologetics (MAA)</option>
                            <option value="cam" <?= ($article['faculty_id']??'') == 'cam' ? 'selected' : '' ?>>Communication & Media (CAM)</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">If selected, this news article will appear on the specific Faculty page.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Short Excerpt</label>
                        <textarea name="excerpt" rows="2" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary"><?= htmlspecialchars($article['excerpt']) ?></textarea>
                        <p class="text-xs text-gray-500 mt-1">A short summary shown on the homepage and news listing.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Article Content</label>
                        <textarea name="content" rows="12" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary font-mono text-sm"><?= htmlspecialchars($article['content']) ?></textarea>
                        <p class="text-xs text-gray-500 mt-1">Use HTML for formatting (e.g. &lt;p&gt;, &lt;strong&gt;, &lt;h3&gt;).</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
                        <?php if (!empty($article['featured_image'])): ?>
                            <img src="../<?= htmlspecialchars($article['featured_image']) ?>" class="h-32 object-cover mb-2 border p-1 bg-gray-50">
                        <?php endif; ?>
                        <input type="file" name="image" accept="image/*" <?= !$id ? 'required' : '' ?> class="w-full border-gray-300 rounded-md shadow-sm border p-2">
                        <p class="text-xs text-gray-500 mt-1">Recommended size: 1200x800px. Will be automatically converted to WebP for optimization.</p>
                    </div>

                    <div class="pt-4 border-t mt-4">
                        <button type="submit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-3 px-8 rounded shadow-lg transition-colors uppercase tracking-widest text-sm">
                            <?= $id ? 'Update Article' : 'Publish Article' ?>
                        </button>
                    </div>
                </div>
            </form>
        <?php endif; ?>

    </main>
</body>
</html>
