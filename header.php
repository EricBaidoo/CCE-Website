<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    // allow pages to set $meta = ['title'=>..., 'description'=>..., 'image'=>..., 'url'=>..., 'type'=>...]
    $meta = isset($meta) && is_array($meta) ? $meta : [];
    $title = isset($meta['title']) ? $meta['title'] : 'CCE - Cross-Cutting Excellence';
    $description = isset($meta['description']) ? $meta['description'] : 'Cross-Cutting Excellence (CCE) mobilizes Christian professionals to reclaim and transform secular institutions through godly wisdom and professional excellence.';
    $image = isset($meta['image']) ? $meta['image'] : 'assets/image/logo.jpeg';
    $url = isset($meta['url']) ? $meta['url'] : ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ($_SERVER['REQUEST_URI'] ?? '/CCE/');
    $type = isset($meta['type']) ? $meta['type'] : 'website';
    ?>
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="icon" type="image/jpeg" href="assets/image/logo.jpeg">
    <meta name="description" content="<?= htmlspecialchars($description) ?>">
    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($description) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($image) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($url) ?>">
    <meta property="og:type" content="<?= htmlspecialchars($type) ?>">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($title) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($description) ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($image) ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <!-- Cache-busting token added during active development to ensure latest CSS is loaded -->
    <link rel="stylesheet" href="assets/css/global.css?v=20250925.2">
    <link rel="stylesheet" href="assets/css/index.css?v=20250925.2">
    <link rel="stylesheet" href="assets/css/header.css?v=20250925.2">
    <link rel="stylesheet" href="assets/css/footer.css?v=20251203.1">
    <link rel="stylesheet" href="assets/css/person.css?v=20250925.2">
    <?php
    // render page-provided JSON-LD if present
    if (!empty($meta['json_ld'])) {
        echo "<script type=\"application/ld+json\">" . $meta['json_ld'] . "</script>\n";
    }
    ?>
        <!-- header styles moved to assets/css/header.css -->
</head>
<body>
<header class="professional-header">
    <!-- Top Brand Section -->
    <div class="brand-section">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <!-- Logo and Organization Name -->
                <div class="brand-area d-flex align-items-center">
                    <img src="assets/image/logo.jpeg" alt="CCE Logo" class="brand-logo me-3">
                    <div class="org-name">
                        <div class="org-title">Cross-Cutting</div>
                        <div class="org-title">Excellence</div>
                    </div>
                </div>
                
                <!-- Mission Statement -->
                <div class="mission-area text-end d-none d-lg-block">
                    <div class="mission-text">Building capacity of Christian professionals</div>
                    <div class="mission-subtitle">Transforming spheres of influence with godly wisdom</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Navigation Section -->
    <nav class="main-navigation">
        <div class="container">
            <div class="navbar navbar-expand-lg navbar-dark p-0">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="faculty.php">Faculty</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="events.php">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="resources.php">Resources</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="news.php">News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                    </ul>
                    
                    <!-- Search Icon -->
                    <div class="search-area d-none d-lg-block">
                        <button class="search-btn" aria-label="Search">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
