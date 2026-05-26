<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; }
require_once '../config/database.php';
require_once 'helpers.php';

$action = $_GET['action'] ?? 'list';
$message = $_SESSION['flash_message'] ?? '';
$error = $_SESSION['flash_error'] ?? '';
unset($_SESSION['flash_message'], $_SESSION['flash_error']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        // Prevent deleting the only admin
        $adminCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
        if ($adminCount <= 1) {
            $_SESSION['flash_error'] = "Cannot delete the last remaining admin user.";
        } else {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$_POST['delete_id']]);
            $_SESSION['flash_message'] = "User deleted successfully.";
        }
        header("Location: users.php?action=list");
        exit;
    } else {
        $id = $_POST['id'] ?? null;
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'admin';
        
        if (empty($username)) {
            $error = "Username is required.";
            $action = 'edit';
        } else {
            if ($id) {
                // Editing existing user
                if (!empty($password)) {
                    // Update password too
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("UPDATE users SET username=?, password_hash=?, role=? WHERE id=?");
                    try {
                        $stmt->execute([$username, $hash, $role, $id]);
                        $_SESSION['flash_message'] = "User updated successfully (password changed).";
                    } catch (PDOException $e) {
                        $error = "Username might already exist.";
                    }
                } else {
                    // Update without changing password
                    $stmt = $pdo->prepare("UPDATE users SET username=?, role=? WHERE id=?");
                    try {
                        $stmt->execute([$username, $role, $id]);
                        $_SESSION['flash_message'] = "User updated successfully.";
                    } catch (PDOException $e) {
                        $error = "Username might already exist.";
                    }
                }
            } else {
                // New user
                if (empty($password)) {
                    $error = "Password is required for new users.";
                    $action = 'edit';
                } else {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, role) VALUES (?, ?, ?)");
                    try {
                        $stmt->execute([$username, $hash, $role]);
                        $_SESSION['flash_message'] = "User created successfully.";
                    } catch (PDOException $e) {
                        $error = "Username already exists.";
                    }
                }
            }
            if (empty($error)) {
                header("Location: users.php?action=list");
                exit;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - CCE Admin</title>
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
        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if ($action === 'list'): ?>
            <?php 
            $users = $pdo->query("SELECT id, username, role, created_at FROM users ORDER BY username ASC")->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Manage Users</h1>
                    <p class="text-gray-500 mt-1">Admin accounts that can access this dashboard.</p>
                </div>
                <a href="?action=edit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-2 px-6 rounded shadow transition-colors">Add User</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= htmlspecialchars($user['username']) ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <?= htmlspecialchars($user['role']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= date('Y-m-d H:i', strtotime($user['created_at'])) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="?action=edit&id=<?= $user['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="" method="POST" class="inline" onsubmit="return confirm('Delete this user?');">
                                    <input type="hidden" name="delete_id" value="<?= $user['id'] ?>">
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
            $id = $_GET['id'] ?? ($_POST['id'] ?? null);
            $user = ['username'=>'', 'role'=>'admin'];
            if ($id) {
                $stmt = $pdo->prepare("SELECT id, username, role FROM users WHERE id = ?");
                $stmt->execute([$id]);
                $fetched = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($fetched) $user = $fetched;
            }
            // Retain POST data on error
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user['username'] = $_POST['username'] ?? '';
                $user['role'] = $_POST['role'] ?? 'admin';
            }
            ?>
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900"><?= $id ? 'Edit User' : 'Add User' ?></h1>
                </div>
                <a href="?action=list" class="text-gray-500 hover:text-gray-700">Cancel & Go Back</a>
            </div>

            <form action="" method="POST" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 max-w-lg">
                <?php if ($id): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <?php endif; ?>

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Username *</label>
                        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password <?= $id ? '(Leave blank to keep unchanged)' : '*' ?></label>
                        <input type="password" name="password" <?= $id ? '' : 'required' ?> class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select name="role" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>

                    <div class="pt-4 border-t mt-4">
                        <button type="submit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-2 px-6 rounded shadow transition-colors">
                            <?= $id ? 'Update User' : 'Create User' ?>
                        </button>
                    </div>
                </div>
            </form>
        <?php endif; ?>

    </main>
</body>
</html>
