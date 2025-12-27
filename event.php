<?php
$events = include __DIR__ . '/data/events.php';
$id = isset($_GET['id']) ? $_GET['id'] : null;
$event = null;
foreach ($events as $e) { if ($e['id'] === $id) { $event = $e; break; } }

if (!$event) {
    http_response_code(404);
    include 'header.php';
    echo '<main class="container"><h1>Event not found</h1><p>The event you requested was not found.</p></main>';
    include 'footer.php';
    exit;
}

// If ?ics=1 requested, output an iCalendar file with timezone-aware datetimes (UTC)
if (isset($_GET['ics']) && $_GET['ics'] == '1') {
    $uid = $event['id'] . '@cce.org';
    $summary = $event['title'];
    $description = strip_tags($event['excerpt'] ?? '');
    $location = $event['location'] ?? '';

    // determine timezone and convert to UTC
    $tz = isset($event['timezone']) ? new DateTimeZone($event['timezone']) : new DateTimeZone('UTC');
    $dtstart = null; $dtend = null;
    if (!empty($event['start_datetime'])) {
        $d = new DateTime($event['start_datetime'], $tz);
        $d->setTimezone(new DateTimeZone('UTC'));
        $dtstart = $d->format('Ymd\THis\Z');
    }
    if (!empty($event['end_datetime'])) {
        $d2 = new DateTime($event['end_datetime'], $tz);
        $d2->setTimezone(new DateTimeZone('UTC'));
        $dtend = $d2->format('Ymd\THis\Z');
    }

    // DTSTAMP is now
    $dtstamp = (new DateTime('now', new DateTimeZone('UTC')))->format('Ymd\THis\Z');

    header('Content-Type: text/calendar; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $event['id'] . '.ics"');

    echo "BEGIN:VCALENDAR\r\nVERSION:2.0\r\nPRODID:-//CCE//EN\r\n";
    echo "BEGIN:VEVENT\r\nUID:$uid\r\nDTSTAMP:$dtstamp\r\n";
    if ($dtstart) echo "DTSTART:$dtstart\r\n";
    if ($dtend) echo "DTEND:$dtend\r\n";
    echo "SUMMARY:" . addcslashes($summary, "\n,;") . "\r\n";
    echo "DESCRIPTION:" . addcslashes($description, "\n,;") . "\r\n";
    if ($location) echo "LOCATION:" . addcslashes($location, "\n,;") . "\r\n";
    // include URL if available
    if (!empty($event['link'])) {
        $urlForIcs = $event['link'];
        echo "URL:" . addcslashes($urlForIcs, "\n,;") . "\r\n";
    }
    // include organizer if available
    if (!empty($event['organizer'])) {
        // organizer can be string or array with name and email/url
        if (is_array($event['organizer'])) {
            $orgName = $event['organizer']['name'] ?? '';
            $orgEmail = $event['organizer']['email'] ?? '';
            $orgLine = $orgName ?: $orgEmail;
            echo "ORGANIZER:" . addcslashes($orgLine, "\n,;") . "\r\n";
        } else {
            echo "ORGANIZER:" . addcslashes($event['organizer'], "\n,;") . "\r\n";
        }
    }
    echo "END:VEVENT\r\nEND:VCALENDAR";
    exit;
}

// Prepare meta and JSON-LD for header
$meta = [
    'title' => $event['title'],
    'description' => $event['excerpt'] ?? '',
    'image' => $event['image'] ?? '/CCE/assets/image/logo.jpeg',
    'url' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost') . $_SERVER['REQUEST_URI'],
    'type' => 'event'
];

$jsonld = [
    '@context' => 'https://schema.org',
    '@type' => 'Event',
    'name' => $event['title'],
    // prefer ISO datetimes if available
    'startDate' => !empty($event['start_datetime']) ? (new DateTime($event['start_datetime'], new DateTimeZone($event['timezone'] ?? 'UTC')))->format(DateTime::ATOM) : ($event['start_date'] ?? null),
    'endDate' => !empty($event['end_datetime']) ? (new DateTime($event['end_datetime'], new DateTimeZone($event['timezone'] ?? 'UTC')))->format(DateTime::ATOM) : ($event['end_date'] ?? null),
    'location' => ['@type' => 'Place', 'name' => $event['location'] ?? ''],
    'image' => [ (isset($event['image']) && strpos($event['image'], 'http') === 0) ? $event['image'] : ((isset($_SERVER['HTTP_HOST']) ? ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on') ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] : '') . '/' . ltrim($event['image'] ?? '/CCE/assets/image/logo.jpeg', '/')) ],
    'description' => $event['excerpt'] ?? ''
];
$jsonld['url'] = $meta['url'];

// organizer
if (!empty($event['organizer'])) {
    if (is_array($event['organizer'])) {
        $jsonld['organizer'] = ['@type' => 'Organization', 'name' => $event['organizer']['name'] ?? '', 'url' => $event['organizer']['url'] ?? ''];
    } else {
        $jsonld['organizer'] = ['@type' => 'Organization', 'name' => $event['organizer']];
    }
}

// eventStatus
$jsonld['eventStatus'] = !empty($event['is_cancelled']) ? 'https://schema.org/EventCancelled' : 'https://schema.org/EventScheduled';

// offers (registration)
if (!empty($event['registration_url'])) {
    $jsonld['offers'] = ['@type' => 'Offer', 'url' => $event['registration_url'], 'availability' => 'https://schema.org/InStock'];
}

$meta['json_ld'] = json_encode($jsonld, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);

include 'header.php';

// display date/time with timezone
$tzname = $event['timezone'] ?? 'UTC';
$tz = new DateTimeZone($tzname);
$startLabel = $event['date'] ?? '';
if (!empty($event['start_datetime'])) {
    $sd = new DateTime($event['start_datetime'], $tz);
    $startLabel = $sd->format('M j, Y');
}
$endLabel = '';
if (!empty($event['end_datetime'])) {
    $ed = new DateTime($event['end_datetime'], $tz);
    $endLabel = $ed->format('M j, Y');
}
$dateDisplay = $startLabel . ($endLabel && $endLabel !== $startLabel ? ' – ' . $endLabel : '');

// Check if event is past
$today = new DateTimeImmutable('now', $tz);
$isPast = false;
if (!empty($event['end_datetime'])) {
    $eventEnd = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $event['end_datetime'], $tz);
    $isPast = $eventEnd < $today;
}
?>
<main class="single-event-page">
    <!-- Event Hero Section -->
    <section class="event-hero-section" style="background-image: url('<?= htmlspecialchars($event['image'] ?? 'assets/image/hero/001-w800.jpg') ?>')">
        <div class="hero-overlay"></div>
        <div class="hero-content-wrapper">
            <div class="container">
                <div class="event-breadcrumb">
                    <a href="index.php">Home</a>
                    <span class="separator">/</span>
                    <a href="events.php">Events</a>
                    <span class="separator">/</span>
                    <span class="current"><?= htmlspecialchars($event['title']) ?></span>
                </div>
                
                <div class="event-hero-content">
                    <div class="event-badges">
                        <span class="event-status-badge <?= $isPast ? 'past' : 'upcoming' ?>">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <?= $isPast ? 'Past Event' : 'Upcoming Event' ?>
                        </span>
                        <?php if (!empty($event['is_featured'])): ?>
                        <span class="featured-badge">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            Featured
                        </span>
                        <?php endif; ?>
                    </div>
                    
                    <h1 class="event-hero-title"><?= htmlspecialchars($event['title']) ?></h1>
                    
                    <div class="event-hero-meta">
                        <div class="meta-item">
                            <div class="meta-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </div>
                            <div class="meta-text">
                                <div class="meta-label">Date</div>
                                <div class="meta-value"><?= htmlspecialchars($dateDisplay) ?></div>
                            </div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </div>
                            <div class="meta-text">
                                <div class="meta-label">Location</div>
                                <div class="meta-value"><?= htmlspecialchars($event['location']) ?></div>
                            </div>
                        </div>
                        <?php if (!empty($event['start_datetime'])): ?>
                        <div class="meta-item">
                            <div class="meta-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </div>
                            <div class="meta-text">
                                <div class="meta-label">Time</div>
                                <div class="meta-value"><?= (new DateTime($event['start_datetime'], $tz))->format('g:i a') ?> <?= htmlspecialchars($tzname) ?></div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="event-hero-actions">
                        <?php if (!empty($event['registration_url']) && !$isPast): ?>
                        <a href="<?= htmlspecialchars($event['registration_url']) ?>" class="btn-primary" target="_blank" rel="noopener">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            Register Now
                        </a>
                        <?php endif; ?>
                        <a href="event.php?id=<?= urlencode($event['id']) ?>&amp;ics=1" class="btn-secondary">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            Add to Calendar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Event Content Section -->
    <section class="event-detail-section">
        <div class="container">
            <div class="event-layout">
                <div class="event-main-content">
                    <div class="content-card">
                        <div class="content-header">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            <h2>About This Event</h2>
                        </div>
                        <div class="content-body">
                            <p class="event-description"><?= nl2br(htmlspecialchars($event['excerpt'])) ?></p>
                        </div>
                    </div>

                    <?php if (!empty($event['link']) && $event['link'] !== 'events.php' && $event['link'] !== 'event.php'): ?>
                    <div class="content-card external-link-card">
                        <a href="<?= htmlspecialchars($event['link']) ?>" class="external-link-btn" target="_blank" rel="noopener">
                            <div class="link-content">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                    <polyline points="15 3 21 3 21 9"></polyline>
                                    <line x1="10" y1="14" x2="21" y2="3"></line>
                                </svg>
                                <span>View Full Event Details</span>
                            </div>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="event-sidebar">
                    <div class="sidebar-card info-card">
                        <div class="card-header">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            </svg>
                            <h3>Event Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="info-item">
                                <div class="info-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Date</div>
                                    <div class="info-value"><?= htmlspecialchars($dateDisplay) ?></div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Location</div>
                                    <div class="info-value"><?= htmlspecialchars($event['location']) ?></div>
                                </div>
                            </div>
                            <?php if (!empty($event['start_datetime'])): ?>
                            <div class="info-item">
                                <div class="info-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Time</div>
                                    <div class="info-value"><?= (new DateTime($event['start_datetime'], $tz))->format('g:i a') ?> <?= htmlspecialchars($tzname) ?></div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if (!empty($event['organizer'])): ?>
                            <div class="info-item">
                                <div class="info-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Organizer</div>
                                    <div class="info-value">
                                        <?php 
                                        if (is_array($event['organizer'])) {
                                            echo htmlspecialchars($event['organizer']['name'] ?? '');
                                        } else {
                                            echo htmlspecialchars($event['organizer']);
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="sidebar-card actions-card">
                        <div class="card-header">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <h3>Quick Actions</h3>
                        </div>
                        <div class="card-body">
                            <div class="action-buttons">
                                <?php if (!empty($event['registration_url']) && !$isPast): ?>
                                <a href="<?= htmlspecialchars($event['registration_url']) ?>" class="action-btn primary" target="_blank" rel="noopener">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="8.5" cy="7" r="4"></circle>
                                        <line x1="20" y1="8" x2="20" y2="14"></line>
                                        <line x1="23" y1="11" x2="17" y2="11"></line>
                                    </svg>
                                    Register Now
                                </a>
                                <?php endif; ?>
                                <a href="event.php?id=<?= urlencode($event['id']) ?>&amp;ics=1" class="action-btn secondary">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    Add to Calendar
                                </a>
                                <a href="events.php" class="action-btn outline">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="19" y1="12" x2="5" y2="12"></line>
                                        <polyline points="12 19 5 12 12 5"></polyline>
                                    </svg>
                                    Back to Events
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Events & Conferences Section -->
    <section class="related-events-section">
        <div class="container">
            <div class="section-header">
                <div class="header-content">
                    <span class="section-label">Discover More</span>
                    <h2 class="section-title">Upcoming Events & Conferences</h2>
                    <p class="section-subtitle">Explore other opportunities to connect, learn, and grow with the CCE community</p>
                </div>
                <a href="events.php" class="view-all-link">
                    View All Events
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>

            <?php
            // Get related events (exclude current event, show upcoming events first)
            $relatedEvents = array_filter($events, function($e) use ($event) {
                return $e['id'] !== $event['id'];
            });

            // Sort: upcoming first, then by date
            usort($relatedEvents, function($a, $b) {
                $tz = new DateTimeZone('Africa/Accra');
                $today = new DateTimeImmutable('now', $tz);
                
                $aEnd = null;
                $bEnd = null;
                
                if (!empty($a['end_datetime'])) {
                    $aEnd = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $a['end_datetime'], $tz);
                } elseif (!empty($a['end_date'])) {
                    $aEnd = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $a['end_date'] . ' 23:59:59', $tz);
                }
                
                if (!empty($b['end_datetime'])) {
                    $bEnd = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $b['end_datetime'], $tz);
                } elseif (!empty($b['end_date'])) {
                    $bEnd = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $b['end_date'] . ' 23:59:59', $tz);
                }
                
                $aIsPast = $aEnd ? ($aEnd < $today) : false;
                $bIsPast = $bEnd ? ($bEnd < $today) : false;
                
                // Upcoming events first
                if ($aIsPast !== $bIsPast) {
                    return $aIsPast ? 1 : -1;
                }
                
                // Then by start date
                $aStart = $a['start_datetime'] ?? ($a['start_date'] ?? '');
                $bStart = $b['start_datetime'] ?? ($b['start_date'] ?? '');
                return strcmp($aStart, $bStart);
            });

            // Pagination
            $perPage = 6;
            $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
            $totalEvents = count($relatedEvents);
            $totalPages = ceil($totalEvents / $perPage);
            $page = min($page, max(1, $totalPages));
            $offset = ($page - 1) * $perPage;
            $paginatedEvents = array_slice($relatedEvents, $offset, $perPage);
            ?>

            <?php if (!empty($paginatedEvents)): ?>
            <div class="related-events-grid">
                <?php foreach ($paginatedEvents as $relEvent): ?>
                    <?php
                    // Check if past event
                    $relTz = isset($relEvent['timezone']) ? new DateTimeZone($relEvent['timezone']) : new DateTimeZone('Africa/Accra');
                    $relToday = new DateTimeImmutable('now', $relTz);
                    $relEnd = null;
                    if (!empty($relEvent['end_datetime'])) {
                        $relEnd = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $relEvent['end_datetime'], $relTz);
                    } elseif (!empty($relEvent['end_date'])) {
                        $relEnd = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $relEvent['end_date'] . ' 23:59:59', $relTz);
                    }
                    $relIsPast = $relEnd ? ($relEnd < $relToday) : false;
                    ?>
                    <article class="related-event-card<?= $relIsPast ? ' past-event' : '' ?>">
                        <div class="card-image">
                            <img src="<?= htmlspecialchars($relEvent['image']) ?>" alt="<?= htmlspecialchars($relEvent['title']) ?>" loading="lazy">
                            <div class="image-overlay"></div>
                            <?php if ($relIsPast): ?>
                            <span class="event-status-tag past">Past Event</span>
                            <?php elseif (!empty($relEvent['is_featured'])): ?>
                            <span class="event-status-tag featured">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                </svg>
                                Featured
                            </span>
                            <?php else: ?>
                            <span class="event-status-tag upcoming">Upcoming</span>
                            <?php endif; ?>
                        </div>
                        <div class="card-content">
                            <div class="card-meta">
                                <span class="date">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <?= htmlspecialchars($relEvent['date']) ?>
                                </span>
                                <span class="location">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    <?= htmlspecialchars($relEvent['location']) ?>
                                </span>
                            </div>
                            <h3 class="card-title">
                                <a href="event.php?id=<?= urlencode($relEvent['id']) ?>">
                                    <?= htmlspecialchars($relEvent['title']) ?>
                                </a>
                            </h3>
                            <p class="card-excerpt"><?= htmlspecialchars(mb_substr($relEvent['excerpt'], 0, 100)) ?><?= mb_strlen($relEvent['excerpt']) > 100 ? '...' : '' ?></p>
                            <div class="card-actions">
                                <a href="event.php?id=<?= urlencode($relEvent['id']) ?>" class="btn-learn-more">
                                    Learn More
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="event.php?id=<?= urlencode($event['id']) ?>&page=<?= $page - 1 ?>" class="pagination-btn prev">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                        Previous
                    </a>
                <?php endif; ?>

                <div class="pagination-numbers">
                    <?php
                    $startPage = max(1, $page - 2);
                    $endPage = min($totalPages, $page + 2);
                    
                    if ($startPage > 1): ?>
                        <a href="event.php?id=<?= urlencode($event['id']) ?>&page=1" class="pagination-number">1</a>
                        <?php if ($startPage > 2): ?>
                            <span class="pagination-ellipsis">...</span>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <a href="event.php?id=<?= urlencode($event['id']) ?>&page=<?= $i ?>" class="pagination-number<?= $i === $page ? ' active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>

                    <?php if ($endPage < $totalPages): ?>
                        <?php if ($endPage < $totalPages - 1): ?>
                            <span class="pagination-ellipsis">...</span>
                        <?php endif; ?>
                        <a href="event.php?id=<?= urlencode($event['id']) ?>&page=<?= $totalPages ?>" class="pagination-number"><?= $totalPages ?></a>
                    <?php endif; ?>
                </div>

                <?php if ($page < $totalPages): ?>
                    <a href="event.php?id=<?= urlencode($event['id']) ?>&page=<?= $page + 1 ?>" class="pagination-btn next">
                        Next
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php else: ?>
            <div class="no-related-events">
                <p>No other events available at this time.</p>
            </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
