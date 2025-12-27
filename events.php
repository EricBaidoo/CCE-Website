<?php
$meta = [
    'title' => 'CCE Events & Conferences',
    'description' => 'Explore upcoming and past events, workshops, and conferences by the Cross-Cutting Excellence Network.',
];
include 'header.php';
$events = include __DIR__ . '/data/events.php';

// Read filters from query
$status = isset($_GET['status']) ? $_GET['status'] : 'upcoming'; // upcoming | past | all
$q = isset($_GET['q']) ? trim($_GET['q']) : '';

// Helper to classify events (timezone-aware, similar to card partial)
function classify_event($e) {
    $tz = isset($e['timezone']) ? new DateTimeZone($e['timezone']) : new DateTimeZone(date_default_timezone_get());
    $today = (new DateTimeImmutable('now', $tz))->setTime(0,0,0);
    $start = null; $end = null;
    if (!empty($e['start_datetime'])) {
        $start = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $e['start_datetime'], $tz);
    } elseif (!empty($e['start_date'])) {
        $start = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $e['start_date'] . ' 00:00:00', $tz);
    }
    if (!empty($e['end_datetime'])) {
        $end = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $e['end_datetime'], $tz);
    } elseif (!empty($e['end_date'])) {
        $end = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $e['end_date'] . ' 23:59:59', $tz);
    }
    $isUpcoming = $start ? ($start >= $today) : true;
    $isPast = $end ? ($end < $today) : false;
    return [$isUpcoming, $isPast];
}

// Apply filters
$filtered = array_filter($events, function($e) use ($status, $q) {
    list($isUpcoming, $isPast) = classify_event($e);
    if ($status === 'upcoming' && !$isUpcoming) return false;
    if ($status === 'past' && !$isPast) return false;
    if (!empty($q)) {
        $hay = strtolower(($e['title'] ?? '') . ' ' . ($e['excerpt'] ?? '') . ' ' . ($e['location'] ?? ''));
        if (strpos($hay, strtolower($q)) === false) return false;
    }
    return true;
});

// Sort: featured first, then by start date desc for past, asc for upcoming
usort($filtered, function($a, $b) use ($status) {
    $fa = !empty($a['is_featured']);
    $fb = !empty($b['is_featured']);
    if ($fa !== $fb) return $fb <=> $fa; // featured first
    $sa = $a['start_datetime'] ?? ($a['start_date'] ?? '');
    $sb = $b['start_datetime'] ?? ($b['start_date'] ?? '');
    if (empty($sa) || empty($sb)) return 0;
    if ($status === 'past') return strcmp($sb, $sa); // newest past first
    return strcmp($sa, $sb); // upcoming by soonest
});
?>
<main class="events-listing-page">
    <!-- Events Hero Section -->
    <section class="events-hero-section">
        <div class="hero-overlay"></div>
        <div class="container hero-content-wrapper">
            <nav class="events-breadcrumb" aria-label="Breadcrumb">
                <a href="index.php">Home</a>
                <span class="separator">/</span>
                <span class="current">Events & Conferences</span>
            </nav>
            
            <div class="events-hero-content">
                <h1 class="events-hero-title">Events & Conferences</h1>
                <p class="events-hero-subtitle">Join us at upcoming gatherings, workshops, and conferences designed to equip Christian professionals for transformative leadership and excellence.</p>
                
                <div class="events-stats">
                    <div class="stat-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <div class="stat-content">
                            <span class="stat-value"><?= count($filtered) ?></span>
                            <span class="stat-label">Events</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        <div class="stat-content">
                            <span class="stat-value">Global</span>
                            <span class="stat-label">Reach</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="events-filter-section">
        <div class="container">
            <div class="filter-container">
                <form class="events-filter-bar" method="get" action="events.php">
                    <div class="filter-group">
                        <label class="filter-label" for="status">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                            </svg>
                            <span>Filter by</span>
                        </label>
                        <select id="status" name="status" class="filter-select">
                            <option value="upcoming" <?= $status==='upcoming'?'selected':'' ?>>Upcoming Events</option>
                            <option value="past" <?= $status==='past'?'selected':'' ?>>Past Events</option>
                            <option value="all" <?= $status==='all'?'selected':'' ?>>All Events</option>
                        </select>
                    </div>
                    <div class="filter-group search-group">
                        <label class="filter-label" for="q">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                            <span>Search</span>
                        </label>
                        <input id="q" name="q" type="text" class="filter-input" value="<?= htmlspecialchars($q) ?>" placeholder="Search by title, location, or keywords...">
                    </div>
                    <button class="filter-submit" type="submit">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span>Apply</span>
                    </button>
                </form>

                <div class="events-results-info">
                    <div class="results-count">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span><strong><?= count($filtered) ?></strong> event<?= count($filtered) !== 1 ? 's' : '' ?> found</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Grid Section -->
    <section class="events-content-section">
        <div class="container">
            <?php if (empty($filtered)): ?>
                <div class="no-events-message">
                    <div class="empty-icon">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                            <line x1="8" y1="14" x2="16" y2="14"></line>
                            <line x1="8" y1="18" x2="12" y2="18"></line>
                        </svg>
                    </div>
                    <h3>No events found</h3>
                    <p>We couldn't find any events matching your criteria. Try adjusting your filters or search query.</p>
                    <a href="events.php" class="btn-reset">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="1 4 1 10 7 10"></polyline>
                            <polyline points="23 20 23 14 17 14"></polyline>
                            <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                        </svg>
                        Reset Filters
                    </a>
                </div>
            <?php else: ?>
                <div class="events-grid">
                    <?php foreach ($filtered as $event): ?>
                        <?php 
                        $e = $event; 
                        $event = $e; 
                        $featuredClass = !empty($event['is_featured']) ? ' featured' : '';
                        
                        // Determine if past
                        $tz = isset($event['timezone']) ? new DateTimeZone($event['timezone']) : new DateTimeZone(date_default_timezone_get());
                        $today = (new DateTimeImmutable('now', $tz))->setTime(0,0,0);
                        $end = null;
                        if (!empty($event['end_datetime'])) {
                            $end = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $event['end_datetime'], $tz);
                        } elseif (!empty($event['end_date'])) {
                            $end = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $event['end_date'] . ' 23:59:59', $tz);
                        }
                        $isPastEvent = $end ? ($end < $today) : false;
                        ?>
                        <article class="event-card<?= $featuredClass ?><?= $isPastEvent ? ' past-event' : '' ?>">
                            <div class="event-image-wrapper">
                                <img src="<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" loading="lazy" class="event-image">
                                <div class="event-overlay"></div>
                                <div class="event-badges">
                                    <?php if (!empty($event['is_featured'])): ?>
                                    <span class="badge featured-badge">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                        </svg>
                                        Featured
                                    </span>
                                    <?php endif; ?>
                                    <?php if ($isPastEvent): ?>
                                    <span class="badge past-badge">Past Event</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="event-content">
                                <div class="event-meta">
                                    <span class="meta-date">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        <?= htmlspecialchars($event['date']) ?>
                                    </span>
                                    <span class="meta-separator">•</span>
                                    <span class="meta-location">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <?= htmlspecialchars($event['location']) ?>
                                    </span>
                                </div>
                                <h3 class="event-title">
                                    <a href="event.php?id=<?= urlencode($event['id']) ?>">
                                        <?= htmlspecialchars($event['title']) ?>
                                    </a>
                                </h3>
                                <p class="event-excerpt"><?= htmlspecialchars(mb_substr($event['excerpt'], 0, 140)) ?><?= mb_strlen($event['excerpt']) > 140 ? '...' : '' ?></p>
                                <div class="event-actions">
                                    <a href="event.php?id=<?= urlencode($event['id']) ?>" class="btn-details">
                                        View Details
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </a>
                                    <?php if (!empty($event['registration_url']) && !$isPastEvent): ?>
                                    <a href="<?= htmlspecialchars($event['registration_url']) ?>" class="btn-register" target="_blank" rel="noopener">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="8.5" cy="7" r="4"></circle>
                                            <line x1="20" y1="8" x2="20" y2="14"></line>
                                            <line x1="23" y1="11" x2="17" y2="11"></line>
                                        </svg>
                                        Register
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php include 'footer.php'; ?>
