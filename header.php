<?php
// =============================
// CCE Professional Header Component
// Clean, Modern, Professional Design
// =============================

// Get current page for active navigation
$current_page = basename($_SERVER['PHP_SELF']);
$page_title = 'CCE - Cross-Cutting Excellence';

// Set page-specific titles
switch($current_page) {
    case 'about.php':
        $page_title = 'About Us - CCE';
        break;
    case 'faculty.php':
        $page_title = 'Faculty Endeavours - CCE';
        break;
    case 'events.php':
        $page_title = 'Events - CCE';
        break;
    case 'news.php':
        $page_title = 'News & Media - CCE';
        break;
    case 'contact.php':
        $page_title = 'Contact Us - CCE';
        break;
    case 'get-involved.php':
        $page_title = 'Get Involved - CCE';
        break;
    case 'resources.php':
        $page_title = 'Resources - CCE';
        break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cross-Cutting Excellence (CCE) - Building the capacity of Christian professionals to transform their spheres of endeavour with the manifold wisdom of God.">
    <meta name="keywords" content="CCE, Cross-Cutting Excellence, Christian professionals, faculty endeavours, governance, development, education, training">
    <meta name="author" content="Cross-Cutting Excellence">
    <title><?php echo $page_title; ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="/CCE/assets/image/logo.jpeg">
    
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom Stylesheets -->
    <link rel="stylesheet" href="/CCE/assets/css/style.css">
</head>
<body>
    <!-- Professional Header -->
    <header class="professional-header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <!-- Brand Section -->
                <a class="navbar-brand d-flex align-items-center" href="/CCE/index.php">
                    <img src="/CCE/assets/image/logo.jpeg" alt="CCE Logo" class="logo me-3">
                    <div class="brand-text">
                        <h1 class="brand-name mb-0">CCE</h1>
                        <small class="brand-tagline">Cross-Cutting Excellence</small>
                    </div>
                </a>

                <!-- Mobile Toggle Button -->
                <button class="navbar-toggler" type="button" onclick="toggleMobileMenu()" aria-label="Toggle navigation">
                    <i class="fas fa-bars" id="toggleIcon"></i>
                </button>

                <!-- Navigation Menu -->
                <div class="navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="/CCE/index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>" href="/CCE/about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'faculty.php') ? 'active' : ''; ?>" href="/CCE/faculty.php">Faculty</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'events.php') ? 'active' : ''; ?>" href="/CCE/events.php">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'resources.php') ? 'active' : ''; ?>" href="/CCE/resources.php">Resources</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'news.php') ? 'active' : ''; ?>" href="/CCE/news.php">News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" href="/CCE/contact.php">Contact</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="btn btn-orange text-white px-4 <?php echo ($current_page == 'get-involved.php') ? 'active' : ''; ?>" href="/CCE/get-involved.php">Get Involved</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Mobile Menu Script -->
    <script>
        let isMenuOpen = false;
        
        function toggleMobileMenu() {
            const menu = document.getElementById('navbarNav');
            const icon = document.getElementById('toggleIcon');
            
            isMenuOpen = !isMenuOpen;
            
            if (isMenuOpen) {
                menu.classList.add('show');
                icon.className = 'fas fa-times';
            } else {
                menu.classList.remove('show');
                icon.className = 'fas fa-bars';
            }
        }
        
        // Close menu when clicking nav links
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (isMenuOpen) {
                        toggleMobileMenu();
                    }
                });
            });
        });
        
        // Scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.professional-header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
