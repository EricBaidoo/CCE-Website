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
    <link rel="stylesheet" href="assets/css/index.css?v=20251226.26">
    <link rel="stylesheet" href="assets/css/header.css?v=20251227.1">
    <link rel="stylesheet" href="assets/css/footer.css?v=20251227.1">
    <link rel="stylesheet" href="assets/css/about.css?v=20251226.1">
    <link rel="stylesheet" href="assets/css/person.css?v=20251226.1">
    <link rel="stylesheet" href="assets/css/company.css?v=20251226.1">
    <link rel="stylesheet" href="assets/css/companies.css?v=20251226.1">
    <link rel="stylesheet" href="assets/css/faculty.css?v=20251227.6">
    <link rel="stylesheet" href="assets/css/events.css?v=20251226.1">
    <link rel="stylesheet" href="assets/css/resources.css?v=20251226.1">
    <link rel="stylesheet" href="assets/css/contact.css?v=20251226.1">
    <?php
    // render page-provided JSON-LD if present
    if (!empty($meta['json_ld'])) {
        echo "<script type=\"application/ld+json\">" . $meta['json_ld'] . "</script>\n";
    }
    ?>
        <!-- header styles moved to assets/css/header.css -->
</head>
<body>
<header class="cce-header">
    <div class="cce-header-top">
        <div class="cce-header-logo">
            <img src="assets/image/logo.jpeg" alt="CCE Logo">
            <div class="cce-header-org">
                Cross-Cutting<br>Excellence
            </div>
        </div>
        <div class="cce-header-mission">
            <div class="cce-header-mission-title">Building capacity of Christian professionals</div>
            <div class="cce-header-mission-subtitle">Transforming spheres of influence with godly wisdom</div>
        </div>
        <button class="cce-header-hamburger d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#cceHeaderNav" aria-controls="cceHeaderNav" aria-expanded="false" aria-label="Toggle navigation">
            <span>&#9776;</span>
        </button>
    </div>
    <nav class="cce-header-nav">
        <ul class="cce-header-nav-list collapse navbar-collapse" id="cceHeaderNav">
            <li><a class="cce-header-nav-link" href="index.php">Home</a></li>
            <li><a class="cce-header-nav-link" href="about.php">About</a></li>
            <li><a class="cce-header-nav-link" href="faculty.php">Faculty</a></li>
            <li><a class="cce-header-nav-link" href="companies.php">Companies</a></li>
            <li><a class="cce-header-nav-link" href="events.php">Events</a></li>
            <li><a class="cce-header-nav-link" href="resources.php">Resources</a></li>
            <li><a class="cce-header-nav-link" href="news.php">News</a></li>
            <li><a class="cce-header-nav-link" href="contact.php">Contact</a></li>
        </ul>
        <div class="cce-header-search d-none d-lg-flex">
            <button class="cce-header-search-btn" aria-label="Search">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
            </button>
        </div>
            
    </nav>
