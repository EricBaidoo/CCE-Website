<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if (!isset($pdo)) {
        require_once __DIR__ . '/config/database.php';
    }
    
    // Load Site Settings into a helper function
    $settingsStmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings");
    $settingsArray = $settingsStmt->fetchAll(PDO::FETCH_KEY_PAIR);
    $setting = function($key, $default = '') use ($settingsArray) {
        return $settingsArray[$key] ?? $default;
    };

    $meta = isset($meta) && is_array($meta) ? $meta : [];
    $title = $meta['title'] ?? $setting('site_title', 'CCE - Cross-Cutting Excellence');
    $description = $meta['description'] ?? $setting('site_description', 'Cross-Cutting Excellence (CCE) mobilizes Christian professionals.');

    $image = $meta['image'] ?? $setting('site_logo', 'assets/image/logo.webp');
    $url = $meta['url'] ?? ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ($_SERVER['REQUEST_URI'] ?? '/CCE/');
    $type = $meta['type'] ?? 'website';
    ?>
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="icon" type="image/webp" href="<?= htmlspecialchars($setting('site_logo', 'assets/image/logo.webp')) ?>">
    <meta name="description" content="<?= htmlspecialchars($description) ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($description) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($image) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($url) ?>">
    <meta property="og:type" content="<?= htmlspecialchars($type) ?>">

    <!-- Modern Typography (UN/ILO Standard) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&family=Oswald:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (CDN for Dev) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#251A5A',
                        secondary: '#E07A2A',
                        accent: '#FF9E4A',
                        dark: '#110D2C',
                        light: '#F4F6F8'
                    },
                    fontFamily: {
                        sans: ['Roboto', 'sans-serif'],
                        heading: ['Oswald', 'sans-serif'],
                    },
                    animation: {
                        'marquee': 'marquee 120s linear infinite',
                    },
                    keyframes: {
                        marquee: {
                            '0%': { transform: 'translateX(0%)' },
                            '100%': { transform: 'translateX(-50%)' },
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Roboto', sans-serif; background-color: #ffffff; color: #333333; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Oswald', sans-serif; text-transform: uppercase; }
        
        /* Institutional Sharp Borders */
        .institutional-border { border-bottom: 0.125rem solid #E07A2A; }
    </style>

    <?php if (!empty($meta['json_ld'])) echo "<script type=\"application/ld+json\">" . $meta['json_ld'] . "</script>\n"; ?>
</head>
<body class="antialiased flex flex-col min-h-screen">

<!-- Top Utility Bar (UN/ILO Style) -->
<div class="bg-primary text-white text-xs py-1.5 px-4 z-50 relative border-b border-white/10">
    <div class="container mx-auto flex justify-between items-center max-w-7xl">
        <div class="flex items-center gap-4">
            <span class="font-medium tracking-wide uppercase"><?= htmlspecialchars($setting('welcome_message', 'Welcome to the CCE Official Website')) ?></span>
        </div>
        <div class="hidden md:flex items-center gap-6 font-medium">
            <a href="#" class="hover:text-secondary transition-colors uppercase tracking-wider">English</a>
            <a href="#" class="hover:text-secondary transition-colors uppercase tracking-wider">Media Center</a>
            <a href="contact" class="hover:text-secondary transition-colors uppercase tracking-wider">Contact Us</a>
            <div class="flex items-center gap-1 border-l border-white/20 pl-4 cursor-pointer hover:text-secondary">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35"></path></svg>
                <span class="uppercase tracking-wider">Search</span>
            </div>
        </div>
    </div>
</div>

<!-- Main Institutional Navigation -->
<header class="w-full bg-white z-40 shadow-sm border-b border-gray-200" id="main-nav">
    <div class="container mx-auto px-4 max-w-7xl">
        <nav class="flex justify-between items-stretch h-24">
            <!-- Logo area with strict alignment -->
            <a href="index" class="flex items-center gap-4 h-full border-r border-gray-100 pr-8">
                <img src="<?= htmlspecialchars($setting('site_logo', 'assets/image/logo.webp')) ?>" alt="CCE Logo" class="h-16 w-16 object-contain">
                <div class="flex flex-col justify-center border-l-2 border-secondary pl-4">
                    <span class="font-heading font-bold text-primary text-2xl leading-none tracking-normal">Cross-Cutting</span>
                    <span class="font-heading font-bold text-secondary text-lg leading-none tracking-normal mt-1">Excellence</span>
                </div>
            </a>

            <!-- Desktop Menu -->
            <ul class="hidden lg:flex items-stretch font-medium text-gray-700 text-sm tracking-widest uppercase">
                <li><a href="index" class="flex items-center h-full px-5 hover:bg-gray-50 hover:text-primary border-b-2 border-transparent hover:border-secondary transition-all">Home</a></li>
                <li><a href="about" class="flex items-center h-full px-5 hover:bg-gray-50 hover:text-primary border-b-2 border-transparent hover:border-secondary transition-all">About CCE</a></li>
                <li><a href="faculty" class="flex items-center h-full px-5 hover:bg-gray-50 hover:text-primary border-b-2 border-transparent hover:border-secondary transition-all">Faculties</a></li>
                <li><a href="events" class="flex items-center h-full px-5 hover:bg-gray-50 hover:text-primary border-b-2 border-transparent hover:border-secondary transition-all">Events</a></li>
                <li><a href="news" class="flex items-center h-full px-5 hover:bg-gray-50 hover:text-primary border-b-2 border-transparent hover:border-secondary transition-all">News & Media</a></li>
            </ul>

            <!-- CTA & Mobile Toggle -->
            <div class="flex items-center gap-4 border-l border-gray-100 pl-8">
                <a href="get-involved" class="hidden lg:flex items-center justify-center bg-secondary hover:bg-orange-600 text-white font-bold py-2 px-6 transition-colors uppercase text-sm tracking-wider h-10">
                    Get Involved
                </a>
                
                <!-- Mobile menu button -->
                <button class="lg:hidden text-primary p-2 focus:outline-none" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </nav>
        
        <!-- Mobile Menu Panel -->
        <div id="mobile-menu" class="hidden bg-gray-50 border-t border-gray-200">
            <ul class="flex flex-col font-medium text-gray-700 text-sm uppercase tracking-wider divide-y divide-gray-200">
                <li><a href="index" class="block py-4 px-4 hover:bg-gray-100 hover:text-primary">Home</a></li>
                <li><a href="about" class="block py-4 px-4 hover:bg-gray-100 hover:text-primary">About CCE</a></li>
                <li><a href="faculty" class="block py-4 px-4 hover:bg-gray-100 hover:text-primary">Faculties</a></li>
                <li><a href="events" class="block py-4 px-4 hover:bg-gray-100 hover:text-primary">Events</a></li>
                <li><a href="news" class="block py-4 px-4 hover:bg-gray-100 hover:text-primary">News & Media</a></li>
                <li class="p-4"><a href="get-involved" class="block text-center bg-secondary text-white py-3">Get Involved</a></li>
            </ul>
        </div>
    </div>
</header>
