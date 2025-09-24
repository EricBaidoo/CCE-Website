<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCE - Cross-Cutting Excellence</title>
    <link rel="icon" type="image/jpeg" href="/CCE/assets/image/logo.jpeg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/CCE/assets/css/global.css">
    <link rel="stylesheet" href="/CCE/assets/css/index.css">
        <style>
        .professional-header {
            background: var(--cce-black);
            color: var(--cce-orange);
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            position: relative;
            z-index: 100;
        }
        .navbar {
            background: transparent;
        }
        .navbar-brand .logo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.10);
            margin-right: 0.75rem;
        }
        .brand-name {
            font-family: 'Montserrat', 'Arial', sans-serif;
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--cce-orange);
            letter-spacing: -1px;
        }
        .brand-tagline {
            font-size: 0.95rem;
            color: var(--cce-orange);
            font-weight: 500;
        }
        .navbar-nav .nav-link {
            color: var(--cce-orange);
            font-weight: 500;
            font-size: 1.08rem;
            margin-right: 1.2rem;
            transition: color 0.2s, background 0.2s;
            text-decoration: none;
        }
        .navbar-nav .nav-link.active {
            color: var(--cce-white);
            background: var(--cce-orange);
            border-radius: 1.5rem;
            padding: 0.35em 1.1em;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(255,152,0,0.10);
            text-decoration: none;
        }
        .navbar-nav .nav-link:hover {
            color: var(--cce-orange);
            background: transparent;
            text-decoration: none;
        }
        @media (max-width: 991.98px) {
            .navbar-nav .nav-link {
                margin-right: 0.5rem;
                font-size: 1rem;
            }
            .navbar-brand .logo {
                width: 32px;
                height: 32px;
            }
        }
        </style>
</head>
<body>
<header class="professional-header">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/CCE/index.php">
                <img src="/CCE/assets/image/logo.jpeg" alt="CCE Logo" class="logo me-3">
                <div class="brand-text">
                    <span class="brand-name fw-bold fs-4">CCE</span>
                    <small class="brand-tagline d-block text-warning">Cross-Cutting Excellence</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/CCE/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/CCE/about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/CCE/faculty.php">Faculty</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/CCE/events.php">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/CCE/resources.php">Resources</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/CCE/news.php">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/CCE/contact.php">Contact</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-warning text-dark px-4" href="/CCE/get-involved.php">Get Involved</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
