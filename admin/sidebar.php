<?php
$currentPage = basename($_SERVER['PHP_SELF']);
function isActive($page, $currentPage) {
    return $page === $currentPage ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 text-gray-300 hover:text-white transition-colors';
}
?>

<style>
    /* Global mobile fixes for admin panel layout */
    @media (max-width: 768px) {
        body { flex-direction: column !important; }
        main { padding: 1rem !important; width: 100% !important; overflow-x: hidden; }
        /* Make sure tables are horizontally scrollable on mobile */
        .overflow-x-auto { max-width: 100vw; }
    }
</style>

<!-- Mobile Header -->
<div class="md:hidden bg-primary text-white p-4 flex justify-between items-center w-full shrink-0 shadow-md relative z-30">
    <div class="font-bold text-xl flex items-center gap-3">
        <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
        CCE Admin
    </div>
    <button id="mobile-menu-btn" class="p-2 text-gray-300 hover:text-white transition-colors focus:outline-none">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
    </button>
</div>

<!-- Mobile Sidebar Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-40 hidden md:hidden backdrop-blur-sm transition-opacity opacity-0 duration-300 cursor-pointer"></div>

<!-- Sidebar -->
<aside id="sidebar" class="w-64 bg-primary text-white flex flex-col h-screen fixed md:sticky top-0 left-0 z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out shadow-2xl md:shadow-none">
    <div class="p-6 flex justify-between items-center shrink-0">
        <h2 class="text-2xl font-bold tracking-tight">CCE Admin</h2>
        <!-- Close button for mobile -->
        <button id="mobile-close-btn" class="md:hidden p-2 text-gray-400 hover:text-white focus:outline-none -mr-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
    <nav class="flex-1 px-4 space-y-2 mt-2 overflow-y-auto pb-4 custom-scrollbar">
        <a href="index" class="block px-4 py-2 rounded-lg <?= isActive('index.php', $currentPage) ?>">Dashboard</a>
        
        <div class="pt-4 pb-2">
            <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Content Management</p>
        </div>
        <a href="news" class="block px-4 py-2 rounded-lg <?= isActive('news.php', $currentPage) ?>">News</a>
        <a href="events" class="block px-4 py-2 rounded-lg <?= isActive('events.php', $currentPage) ?>">Events</a>
        
        <div class="pt-4 pb-2">
            <p class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Global Configuration</p>
        </div>
        <a href="settings" class="block px-4 py-2 rounded-lg <?= isActive('settings.php', $currentPage) ?>">Site Settings</a>
        <a href="hero" class="block px-4 py-2 rounded-lg <?= isActive('hero.php', $currentPage) ?>">Hero Carousel</a>
        <a href="people" class="block px-4 py-2 rounded-lg <?= isActive('people.php', $currentPage) ?>">Network / People</a>
        <a href="companies" class="block px-4 py-2 rounded-lg <?= isActive('companies.php', $currentPage) ?>">Institutional Partners</a>
        <a href="users" class="block px-4 py-2 rounded-lg <?= isActive('users.php', $currentPage) ?>">Admin Users</a>
    </nav>
    <div class="p-4 border-t border-white/10 shrink-0">
        <a href="logout" class="block px-4 py-2 text-sm text-gray-300 hover:text-white flex items-center gap-2 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Logout
        </a>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('mobile-menu-btn');
        const closeBtn = document.getElementById('mobile-close-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        function openMenu() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            // Small delay to allow the DOM to render the element before transitioning opacity
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
            }, 10);
            document.body.style.overflow = 'hidden'; // Prevent scrolling the main content
        }
        
        function closeMenu() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('opacity-0');
            // Wait for transition to finish before hiding the element
            setTimeout(() => {
                overlay.classList.add('hidden');
            }, 300); 
            document.body.style.overflow = '';
        }
        
        if(btn) btn.addEventListener('click', openMenu);
        if(closeBtn) closeBtn.addEventListener('click', closeMenu);
        if(overlay) overlay.addEventListener('click', closeMenu);
    });
</script>
