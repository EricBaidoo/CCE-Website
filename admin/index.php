<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once '../config/database.php';

// Fetch quick stats
$newsCount = $pdo->query("SELECT COUNT(*) FROM news")->fetchColumn();
$eventsCount = $pdo->query("SELECT COUNT(*) FROM events")->fetchColumn();
$peopleCount = $pdo->query("SELECT COUNT(*) FROM people")->fetchColumn();
$companiesCount = $pdo->query("SELECT COUNT(*) FROM companies")->fetchColumn();

// Fetch recent activity
$recentNews = $pdo->query("SELECT title, published_at FROM news ORDER BY published_at DESC LIMIT 3")->fetchAll();
$recentEvents = $pdo->query("SELECT title, start_date FROM events ORDER BY start_date DESC LIMIT 3")->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CCE Admin</title>
    <link rel="icon" href="../assets/image/CCE%20LOGO.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#251A5A',
                        secondary: '#E07A2A',
                        dark: '#110D2C',
                        light: '#F4F6F8'
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 min-h-screen flex">

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-1 p-10 overflow-y-auto">
        <header class="mb-10 flex justify-between items-end border-b border-gray-200 pb-6">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 tracking-tight">System Overview</h1>
                <p class="text-gray-500 mt-2 text-lg">Welcome back, <span class="font-semibold text-primary"><?= htmlspecialchars($_SESSION['admin_username']) ?></span>. Here's what's happening today.</p>
            </div>
            <div class="flex gap-4">
                <a href="../index.php" target="_blank" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-5 py-2.5 rounded-lg font-medium transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    View Live Site
                </a>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="absolute right-0 top-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-gray-500 text-sm font-bold uppercase tracking-wider">News Articles</h3>
                        <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                    </div>
                    <p class="text-4xl font-black text-gray-900"><?= $newsCount ?></p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="absolute right-0 top-0 w-24 h-24 bg-indigo-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-gray-500 text-sm font-bold uppercase tracking-wider">Active Events</h3>
                        <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <p class="text-4xl font-black text-gray-900"><?= $eventsCount ?></p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="absolute right-0 top-0 w-24 h-24 bg-orange-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-gray-500 text-sm font-bold uppercase tracking-wider">People</h3>
                        <div class="p-2 bg-orange-100 text-secondary rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                    </div>
                    <p class="text-4xl font-black text-gray-900"><?= $peopleCount ?></p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="absolute right-0 top-0 w-24 h-24 bg-purple-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-gray-500 text-sm font-bold uppercase tracking-wider">Partners</h3>
                        <div class="p-2 bg-purple-100 text-purple-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>
                    <p class="text-4xl font-black text-gray-900"><?= $companiesCount ?></p>
                </div>
            </div>
            
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Quick Actions Panel -->
            <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Quick Launch
                </h2>
                <div class="grid grid-cols-2 gap-4">
                    <a href="news.php?action=create" class="flex flex-col items-center justify-center p-6 bg-gray-50 hover:bg-primary hover:text-white text-gray-700 rounded-xl transition-all border border-gray-100 hover:border-primary group">
                        <svg class="w-8 h-8 mb-3 opacity-70 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        <span class="font-semibold text-sm">Publish News</span>
                    </a>
                    <a href="events.php?action=create" class="flex flex-col items-center justify-center p-6 bg-gray-50 hover:bg-secondary hover:text-white text-gray-700 rounded-xl transition-all border border-gray-100 hover:border-secondary group">
                        <svg class="w-8 h-8 mb-3 opacity-70 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="font-semibold text-sm">Create Event</span>
                    </a>
                    <a href="people.php?action=create" class="flex flex-col items-center justify-center p-6 bg-gray-50 hover:bg-gray-800 hover:text-white text-gray-700 rounded-xl transition-all border border-gray-100 hover:border-gray-800 group">
                        <svg class="w-8 h-8 mb-3 opacity-70 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        <span class="font-semibold text-sm">Add Person</span>
                    </a>
                    <a href="settings.php" class="flex flex-col items-center justify-center p-6 bg-gray-50 hover:bg-gray-800 hover:text-white text-gray-700 rounded-xl transition-all border border-gray-100 hover:border-gray-800 group">
                        <svg class="w-8 h-8 mb-3 opacity-70 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="font-semibold text-sm">Site Settings</span>
                    </a>
                </div>
            </div>

            <!-- Recent Activity Panel -->
            <div class="bg-white rounded-2xl shadow-sm p-8 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Recent Activity
                </h2>
                
                <div class="space-y-6">
                    <?php if (empty($recentNews) && empty($recentEvents)): ?>
                        <p class="text-gray-500 italic text-sm">No recent activity found in the system.</p>
                    <?php else: ?>
                        <?php foreach ($recentNews as $newsItem): ?>
                        <div class="flex items-start gap-4 pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                            <div class="bg-blue-100 text-blue-600 p-2 rounded-full shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900 line-clamp-1"><?= htmlspecialchars($newsItem['title']) ?></p>
                                <p class="text-xs text-gray-500 mt-0.5">Published News • <?= date('M d, Y', strtotime($newsItem['published_at'])) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <?php foreach ($recentEvents as $eventItem): ?>
                        <div class="flex items-start gap-4 pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                            <div class="bg-indigo-100 text-indigo-600 p-2 rounded-full shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900 line-clamp-1"><?= htmlspecialchars($eventItem['title']) ?></p>
                                <p class="text-xs text-gray-500 mt-0.5">Scheduled Event • <?= date('M d, Y', strtotime($eventItem['start_date'])) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
