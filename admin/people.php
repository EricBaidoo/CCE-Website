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
        $stmt = $pdo->prepare("DELETE FROM people WHERE id = ?");
        $stmt->execute([$_POST['delete_id']]);
        $_SESSION['flash_message'] = "Person deleted successfully.";
        header("Location: people.php?action=list");
        exit;
    } else {
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? '';
        $role = $_POST['role'] ?? '';
        $company = $_POST['company'] ?? '';
        $email = $_POST['email'] ?? '';
        $linkedin = $_POST['linkedin'] ?? '';
        $bio_short = $_POST['bio_short'] ?? '';
        $faculty_id = !empty($_POST['faculty_id']) ? $_POST['faculty_id'] : null;
        $imagePath = $_POST['existing_image'] ?? '';
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../assets/image/pics/';
            $fileName = 'person_' . time() . '_' . pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
            $targetFile = $uploadDir . $fileName . '.webp';
            
            $finalPath = convertAndSaveToWebp($_FILES['image']['tmp_name'], $targetFile);
            if ($finalPath) {
                $imagePath = preg_replace('/^\.\.\//', '', $finalPath);
            }
        }

        if ($id) {
            // Update
            $stmt = $pdo->prepare("UPDATE people SET name=?, role=?, company=?, email=?, linkedin=?, bio_short=?, image=?, faculty_id=? WHERE id=?");
            $stmt->execute([$name, $role, $company, $email, $linkedin, $bio_short, $imagePath, $faculty_id, $id]);
            $_SESSION['flash_message'] = "Person updated successfully.";
        } else {
            // Insert
            $newId = uniqid('person_');
            $stmt = $pdo->prepare("INSERT INTO people (id, name, role, company, email, linkedin, bio_short, image, faculty_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$newId, $name, $role, $company, $email, $linkedin, $bio_short, $imagePath, $faculty_id]);
            $_SESSION['flash_message'] = "Person added successfully.";
        }
        header("Location: people.php?action=list");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage People - CCE Admin</title>
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
            $people = $pdo->query("SELECT * FROM people ORDER BY name ASC")->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Manage People</h1>
                    <p class="text-gray-500 mt-1">Network & Leadership Roster</p>
                </div>
                <a href="?action=edit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-2 px-6 rounded shadow transition-colors">Add Person</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($people as $person): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="../<?= htmlspecialchars($person['image'] ?? $person['photo'] ?? 'assets/image/placeholder-user.png') ?>" class="h-10 w-10 object-cover rounded-full">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($person['name'] ?? '') ?></div>
                                <div class="text-sm text-gray-500"><?= htmlspecialchars($person['company'] ?? '') ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?= htmlspecialchars($person['role']) ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="?action=edit&id=<?= $person['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="" method="POST" class="inline" onsubmit="return confirm('Delete this person?');">
                                    <input type="hidden" name="delete_id" value="<?= $person['id'] ?>">
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
            $person = ['name'=>'', 'role'=>'', 'company'=>'', 'email'=>'', 'linkedin'=>'', 'bio_short'=>'', 'image'=>'', 'faculty_id'=>''];
            if ($id) {
                $stmt = $pdo->prepare("SELECT * FROM people WHERE id = ?");
                $stmt->execute([$id]);
                $person = $stmt->fetch(PDO::FETCH_ASSOC) ?: $person;
            }
            ?>
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900"><?= $id ? 'Edit Person' : 'Add Person' ?></h1>
                </div>
                <a href="?action=list" class="text-gray-500 hover:text-gray-700">Cancel & Go Back</a>
            </div>

            <form action="" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 max-w-2xl">
                <?php if ($id): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <?php endif; ?>
                <input type="hidden" name="existing_image" value="<?= htmlspecialchars($person['image'] ?? $person['photo'] ?? '') ?>">

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($person['name'] ?? '') ?>" required class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                            <input type="text" name="role" value="<?= htmlspecialchars($person['role'] ?? '') ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Company / Org</label>
                            <input type="text" name="company" value="<?= htmlspecialchars($person['company'] ?? '') ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Faculty Association</label>
                        <select name="faculty_id" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                            <option value="">-- None (General Staff/Leader) --</option>
                            <option value="gad" <?= ($person['faculty_id']??'') == 'gad' ? 'selected' : '' ?>>Governance & Development (GAD)</option>
                            <option value="eat" <?= ($person['faculty_id']??'') == 'eat' ? 'selected' : '' ?>>Education & Training (EAT)</option>
                            <option value="sat" <?= ($person['faculty_id']??'') == 'sat' ? 'selected' : '' ?>>Science & Technology (SAT)</option>
                            <option value="paa" <?= ($person['faculty_id']??'') == 'paa' ? 'selected' : '' ?>>Philosophy & Arts (PAA)</option>
                            <option value="fab" <?= ($person['faculty_id']??'') == 'fab' ? 'selected' : '' ?>>Finance & Business (FAB)</option>
                            <option value="raf" <?= ($person['faculty_id']??'') == 'raf' ? 'selected' : '' ?>>Relationship & Family (RAF)</option>
                            <option value="maa" <?= ($person['faculty_id']??'') == 'maa' ? 'selected' : '' ?>>Missions & Apologetics (MAA)</option>
                            <option value="cam" <?= ($person['faculty_id']??'') == 'cam' ? 'selected' : '' ?>>Communication & Media (CAM)</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">If the role is 'Coordinator', they will appear on the Faculty page.</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($person['email'] ?? '') ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label>
                            <input type="url" name="linkedin" value="<?= htmlspecialchars($person['linkedin'] ?? '') ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Biography</label>
                        <textarea name="bio_short" rows="4" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary"><?= htmlspecialchars($person['bio_short'] ?? '') ?></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                        <?php if (!empty($person['image']) || !empty($person['photo'])): ?>
                            <img src="../<?= htmlspecialchars($person['image'] ?? $person['photo']) ?>" class="h-24 w-24 object-cover mb-2 border">
                        <?php endif; ?>
                        <input type="file" name="image" accept="image/*" class="w-full border-gray-300 rounded-md shadow-sm border p-2">
                    </div>

                    <div class="pt-4 border-t mt-4">
                        <button type="submit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-2 px-6 rounded shadow transition-colors">
                            Save Person
                        </button>
                    </div>
                </div>
            </form>
        <?php endif; ?>

    </main>
</body>
</html>
