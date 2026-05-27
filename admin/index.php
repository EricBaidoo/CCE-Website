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
    <link rel="icon" href="../assets/image/logo.webp" type="image/webp">
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
    <main class="flex-1 p-6 md:p-10 overflow-y-auto bg-[#F8F9FA]">
        <header class="mb-10 flex flex-col md:flex-row md:justify-between md:items-end border-b border-gray-200 pb-6 gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-primary tracking-tight">System Overview</h1>
                <p class="text-gray-500 mt-2 text-base md:text-lg">Welcome back, <span class="font-bold text-secondary"><?= htmlspecialchars($_SESSION['admin_username']) ?></span>. Here is your daily summary.</p>
            </div>
            <div>
                <a href="../" target="_blank" class="inline-flex bg-white border border-gray-300 text-gray-700 hover:text-primary hover:border-primary px-5 py-2.5 rounded-md font-medium transition-colors shadow-sm items-center gap-2 text-sm uppercase tracking-wider">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    View Live Site
                </a>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            
            <!-- Stat Card 1 -->
            <div class="bg-white rounded-xl shadow-sm border-t-4 border-blue-500 p-6 flex flex-col justify-between hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-1">Published News</p>
                        <h3 class="text-3xl font-black text-gray-900"><?= $newsCount ?></h3>
                    </div>
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                </div>
                <a href="news" class="text-blue-500 text-sm font-semibold hover:text-blue-700 flex items-center gap-1">Manage Articles <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
            </div>
            
            <!-- Stat Card 2 -->
            <div class="bg-white rounded-xl shadow-sm border-t-4 border-secondary p-6 flex flex-col justify-between hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-1">Active Events</p>
                        <h3 class="text-3xl font-black text-gray-900"><?= $eventsCount ?></h3>
                    </div>
                    <div class="p-3 bg-orange-50 text-secondary rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <a href="events" class="text-secondary text-sm font-semibold hover:text-orange-700 flex items-center gap-1">Manage Events <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
            </div>

            <!-- Stat Card 3 -->
            <div class="bg-white rounded-xl shadow-sm border-t-4 border-primary p-6 flex flex-col justify-between hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-1">Network People</p>
                        <h3 class="text-3xl font-black text-gray-900"><?= $peopleCount ?></h3>
                    </div>
                    <div class="p-3 bg-indigo-50 text-primary rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
                <a href="people" class="text-primary text-sm font-semibold hover:text-indigo-900 flex items-center gap-1">View Network <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
            </div>

            <!-- Stat Card 4 -->
            <div class="bg-white rounded-xl shadow-sm border-t-4 border-emerald-500 p-6 flex flex-col justify-between hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-1">Partners</p>
                        <h3 class="text-3xl font-black text-gray-900"><?= $companiesCount ?></h3>
                    </div>
                    <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                </div>
                <a href="companies" class="text-emerald-500 text-sm font-semibold hover:text-emerald-700 flex items-center gap-1">View Partners <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></a>
            </div>
            
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Quick Actions Panel -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
                <h2 class="text-lg font-bold text-primary mb-6 uppercase tracking-widest border-b border-gray-100 pb-4">Quick Launch</h2>
                <div class="grid grid-cols-2 gap-4">
                    <a href="news?action=create" class="flex flex-col items-center text-center justify-center p-6 bg-gray-50 hover:bg-primary hover:text-white text-gray-700 rounded-lg transition-colors border border-gray-200 hover:border-primary group">
                        <svg class="w-8 h-8 mb-3 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        <span class="font-semibold text-sm">Publish News</span>
                    </a>
                    <a href="events?action=create" class="flex flex-col items-center text-center justify-center p-6 bg-gray-50 hover:bg-secondary hover:text-white text-gray-700 rounded-lg transition-colors border border-gray-200 hover:border-secondary group">
                        <svg class="w-8 h-8 mb-3 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="font-semibold text-sm">Create Event</span>
                    </a>
                    <a href="people?action=create" class="flex flex-col items-center text-center justify-center p-6 bg-gray-50 hover:bg-gray-800 hover:text-white text-gray-700 rounded-lg transition-colors border border-gray-200 hover:border-gray-800 group">
                        <svg class="w-8 h-8 mb-3 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        <span class="font-semibold text-sm">Add Person</span>
                    </a>
                    <a href="settings" class="flex flex-col items-center text-center justify-center p-6 bg-gray-50 hover:bg-gray-800 hover:text-white text-gray-700 rounded-lg transition-colors border border-gray-200 hover:border-gray-800 group">
                        <svg class="w-8 h-8 mb-3 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                        <span class="font-semibold text-sm">Site Settings</span>
                    </a>
                </div>
            </div>

            <!-- Recent Activity Panel -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
                <h2 class="text-lg font-bold text-primary mb-6 uppercase tracking-widest border-b border-gray-100 pb-4">Recent Activity</h2>
                
                <div class="space-y-5">
                    <?php if (empty($recentNews) && empty($recentEvents)): ?>
                        <p class="text-gray-500 italic text-sm">No recent activity found in the system.</p>
                    <?php else: ?>
                        <?php foreach ($recentNews as $newsItem): ?>
                        <div class="flex items-start gap-4">
                            <div class="bg-blue-50 text-blue-500 p-2.5 rounded-md border border-blue-100 shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate"><?= htmlspecialchars($newsItem['title']) ?></p>
                                <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider">News • <?= date('M d, Y', strtotime($newsItem['published_at'])) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <?php foreach ($recentEvents as $eventItem): ?>
                        <div class="flex items-start gap-4">
                            <div class="bg-orange-50 text-secondary p-2.5 rounded-md border border-orange-100 shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate"><?= htmlspecialchars($eventItem['title']) ?></p>
                                <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider">Event • <?= date('M d, Y', strtotime($eventItem['start_date'])) ?></p>
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
