<?php
$currentPage = basename($_SERVER['PHP_SELF']);
function isActive($page, $currentPage) {
    return $page === $currentPage ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 text-gray-300 hover:text-white transition-colors';
}
?>
<!-- Sidebar -->
<aside class="w-64 bg-primary text-white flex flex-col h-screen sticky top-0">
    <div class="p-6">
        <h2 class="text-2xl font-bold tracking-tight">CCE Admin</h2>
    </div>
    <nav class="flex-1 px-4 space-y-2 mt-4 overflow-y-auto">
        <a href="index.php" class="block px-4 py-2 rounded-lg <?= isActive('index.php', $currentPage) ?>">Dashboard</a>
        
        <div class="pt-4 pb-2">
            <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Content Management</p>
        </div>
        <a href="news.php" class="block px-4 py-2 rounded-lg <?= isActive('news.php', $currentPage) ?>">News</a>
        <a href="events.php" class="block px-4 py-2 rounded-lg <?= isActive('events.php', $currentPage) ?>">Events</a>
        
        <div class="pt-4 pb-2">
            <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Global Configuration</p>
        </div>
        <a href="settings.php" class="block px-4 py-2 rounded-lg <?= isActive('settings.php', $currentPage) ?>">Site Settings</a>
        <a href="hero.php" class="block px-4 py-2 rounded-lg <?= isActive('hero.php', $currentPage) ?>">Hero Carousel</a>
        <a href="people.php" class="block px-4 py-2 rounded-lg <?= isActive('people.php', $currentPage) ?>">Network / People</a>
        <a href="companies.php" class="block px-4 py-2 rounded-lg <?= isActive('companies.php', $currentPage) ?>">Institutional Partners</a>
        <a href="users.php" class="block px-4 py-2 rounded-lg <?= isActive('users.php', $currentPage) ?>">Admin Users</a>
    </nav>
    <div class="p-4 border-t border-white/10">
        <a href="logout.php" class="block px-4 py-2 text-sm text-gray-300 hover:text-white flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Logout
        </a>
    </div>
</aside>
