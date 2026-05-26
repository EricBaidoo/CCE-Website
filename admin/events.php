<?php
session_start();
if (!isset($_SESSION['admin_id'])) { header("Location: login.php"); exit; }
require_once '../config/database.php';
require_once 'helpers.php';

$action = $_GET['action'] ?? 'list';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
        $stmt->execute([$_POST['delete_id']]);
        $message = "Event deleted successfully.";
        $action = 'list';
    } else {
        $id = $_POST['id'] ?? null;
        $title = $_POST['title'] ?? '';
        $date_display = $_POST['date_display'] ?? '';
        $start_date = !empty($_POST['start_date']) ? $_POST['start_date'] : null;
        $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : null;
        $location = $_POST['location'] ?? '';
        $excerpt = $_POST['excerpt'] ?? '';
        $registration_url = $_POST['registration_url'] ?? '';
        $is_featured = isset($_POST['is_featured']) ? 1 : 0;
        $faculty_id = !empty($_POST['faculty_id']) ? $_POST['faculty_id'] : null;
        $imagePath = $_POST['existing_image'] ?? '';
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../assets/image/events/';
            $fileName = 'event_' . time() . '_' . pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
            $targetFile = $uploadDir . $fileName . '.webp';
            
            $finalPath = convertAndSaveToWebp($_FILES['image']['tmp_name'], $targetFile);
            if ($finalPath) {
                $imagePath = preg_replace('/^\.\.\//', '', $finalPath);
            }
        }

        if ($id) {
            $stmt = $pdo->prepare("UPDATE events SET title=?, date_display=?, start_date=?, end_date=?, location=?, excerpt=?, registration_url=?, is_featured=?, image=?, faculty_id=? WHERE id=?");
            $stmt->execute([$title, $date_display, $start_date, $end_date, $location, $excerpt, $registration_url, $is_featured, $imagePath, $faculty_id, $id]);
            $message = "Event updated successfully.";
        } else {
            $newId = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-')) . '-' . uniqid();
            $stmt = $pdo->prepare("INSERT INTO events (id, title, date_display, start_date, end_date, location, excerpt, registration_url, is_featured, image, faculty_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$newId, $title, $date_display, $start_date, $end_date, $location, $excerpt, $registration_url, $is_featured, $imagePath, $faculty_id]);
            $message = "Event created successfully.";
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
    <title>Manage Events - CCE Admin</title>
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
            $events = $pdo->query("SELECT * FROM events ORDER BY start_date DESC")->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Manage Global Events</h1>
                    <p class="text-gray-500 mt-1">Schedule and promote upcoming summits, workshops, and gatherings.</p>
                </div>
                <a href="?action=edit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-2 px-6 rounded shadow transition-colors">Create Event</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Flyer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Details</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($events as $ev): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="../<?= htmlspecialchars($ev['image'] ?? 'assets/image/placeholder.jpg') ?>" class="h-12 w-12 object-cover border border-gray-200 rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 truncate w-48 xl:w-64"><?= htmlspecialchars($ev['title']) ?></div>
                                <div class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <?= htmlspecialchars($ev['location']) ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?= htmlspecialchars($ev['date_display']) ?></div>
                                <?php if($ev['start_date']): ?>
                                <div class="text-xs text-gray-500">System: <?= date('M d, Y', strtotime($ev['start_date'])) ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if ($ev['is_featured']): ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Featured</span>
                                <?php else: ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Standard</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="?action=edit&id=<?= urlencode($ev['id']) ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="" method="POST" class="inline" onsubmit="return confirm('Delete this event?');">
                                    <input type="hidden" name="delete_id" value="<?= htmlspecialchars($ev['id']) ?>">
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($events)): ?>
                        <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">No events scheduled.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($action === 'edit'): ?>
            <?php
            $id = $_GET['id'] ?? null;
            $ev = ['title'=>'', 'date_display'=>'', 'start_date'=>'', 'end_date'=>'', 'location'=>'', 'excerpt'=>'', 'registration_url'=>'', 'is_featured'=>0, 'image'=>'', 'faculty_id'=>''];
            if ($id) {
                $stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
                $stmt->execute([$id]);
                $ev = $stmt->fetch(PDO::FETCH_ASSOC) ?: $ev;
            }
            ?>
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900"><?= $id ? 'Edit Event' : 'Create Event' ?></h1>
                </div>
                <a href="?action=list" class="text-gray-500 hover:text-gray-700">Cancel & Go Back</a>
            </div>

            <form action="" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-xl shadow-sm border border-gray-200 max-w-4xl">
                <?php if ($id): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <?php endif; ?>
                <input type="hidden" name="existing_image" value="<?= htmlspecialchars($ev['image']) ?>">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main details -->
                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Event Title *</label>
                            <input type="text" name="title" value="<?= htmlspecialchars($ev['title']) ?>" required class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Location / Venue</label>
                            <input type="text" name="location" value="<?= htmlspecialchars($ev['location']) ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary" placeholder="e.g. Accra International Conference Center, Ghana">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Associated Faculty</label>
                            <select name="faculty_id" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                                <option value="">-- None (General Event) --</option>
                                <option value="gad" <?= $ev['faculty_id'] == 'gad' ? 'selected' : '' ?>>Governance & Development (GAD)</option>
                                <option value="eat" <?= $ev['faculty_id'] == 'eat' ? 'selected' : '' ?>>Education & Training (EAT)</option>
                                <option value="sat" <?= $ev['faculty_id'] == 'sat' ? 'selected' : '' ?>>Science & Technology (SAT)</option>
                                <option value="paa" <?= $ev['faculty_id'] == 'paa' ? 'selected' : '' ?>>Philosophy & Arts (PAA)</option>
                                <option value="fab" <?= $ev['faculty_id'] == 'fab' ? 'selected' : '' ?>>Finance & Business (FAB)</option>
                                <option value="raf" <?= $ev['faculty_id'] == 'raf' ? 'selected' : '' ?>>Relationship & Family (RAF)</option>
                                <option value="maa" <?= $ev['faculty_id'] == 'maa' ? 'selected' : '' ?>>Missions & Apologetics (MAA)</option>
                                <option value="cam" <?= $ev['faculty_id'] == 'cam' ? 'selected' : '' ?>>Communication & Media (CAM)</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">If selected, this event will appear on the specific Faculty page.</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Event Description (Excerpt)</label>
                            <textarea name="excerpt" rows="4" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary"><?= htmlspecialchars($ev['excerpt']) ?></textarea>
                            <p class="text-xs text-gray-500 mt-1">A brief summary of the event to entice attendees.</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Registration or Ticket URL</label>
                            <input type="url" name="registration_url" value="<?= htmlspecialchars($ev['registration_url']) ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary" placeholder="https://eventbrite.com/...">
                            <p class="text-xs text-gray-500 mt-1">If provided, an external "Register Now" button will appear.</p>
                        </div>
                    </div>

                    <!-- Sidebar details -->
                    <div class="space-y-6 bg-gray-50 p-6 rounded-lg border border-gray-100">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Display Date *</label>
                            <input type="text" name="date_display" value="<?= htmlspecialchars($ev['date_display']) ?>" required class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary" placeholder="e.g. Oct 12-14, 2026">
                            <p class="text-xs text-gray-500 mt-1">How the date looks to users.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">System Start Date</label>
                            <input type="date" name="start_date" value="<?= htmlspecialchars($ev['start_date']) ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                            <p class="text-xs text-gray-500 mt-1">Used for sorting and hiding past events automatically.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">System End Date</label>
                            <input type="date" name="end_date" value="<?= htmlspecialchars($ev['end_date']) ?>" class="w-full border-gray-300 rounded-md shadow-sm border p-2 focus:ring-secondary focus:border-secondary">
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" <?= $ev['is_featured'] ? 'checked' : '' ?> class="w-5 h-5 text-secondary border-gray-300 rounded focus:ring-secondary">
                                <span class="text-sm font-bold text-gray-800">Featured Event</span>
                            </label>
                            <p class="text-xs text-gray-500 mt-1 pl-7">Featured events always show on the homepage sidebar.</p>
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Event Flyer / Image</label>
                            <?php if (!empty($ev['image'])): ?>
                                <img src="../<?= htmlspecialchars($ev['image']) ?>" class="w-full object-cover mb-3 border border-gray-200 rounded">
                            <?php endif; ?>
                            <input type="file" name="image" accept="image/*" <?= !$id ? 'required' : '' ?> class="w-full text-sm">
                            <p class="text-xs text-gray-500 mt-2">Will be compressed to WebP automatically.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t mt-8 flex justify-end">
                    <button type="submit" class="bg-primary hover:bg-indigo-900 text-white font-bold py-3 px-10 rounded shadow-lg transition-colors uppercase tracking-widest text-sm">
                        <?= $id ? 'Save Changes' : 'Schedule Event' ?>
                    </button>
                </div>
            </form>
        <?php endif; ?>

    </main>
</body>
</html>
