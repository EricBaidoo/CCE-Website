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
?>
<main class="container">
    <article class="event-detail">
        <h1><?= htmlspecialchars($event['title']) ?></h1>
        <?php
        // display date/time with timezone
        $tzname = $event['timezone'] ?? 'UTC';
        $tz = new DateTimeZone($tzname);
        $startLabel = $event['date'] ?? '';
        if (!empty($event['start_datetime'])) {
            $sd = new DateTime($event['start_datetime'], $tz);
            $startLabel = $sd->format('M j, Y \a\t g:ia');
        }
        $endLabel = '';
        if (!empty($event['end_datetime'])) {
            $ed = new DateTime($event['end_datetime'], $tz);
            $endLabel = $ed->format('M j, Y \a\t g:ia');
        }
        ?>
        <p class="meta"><?= htmlspecialchars($startLabel) ?><?= $endLabel ? ' – ' . htmlspecialchars($endLabel) : '' ?> • <?= htmlspecialchars($event['location']) ?> (<?= htmlspecialchars($tzname) ?>)</p>
        <?php if (!empty($event['image'])): ?><div class="event-media"><img src="<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['title']) ?>"></div><?php endif; ?>
        <div class="event-content"><?= nl2br(htmlspecialchars($event['excerpt'])) ?></div>
        <p>
            <?php if (!empty($event['registration_url'])): ?>
                <a class="event-cta" href="<?= htmlspecialchars($event['registration_url']) ?>" target="_blank" rel="noopener">Register</a>
            <?php endif; ?>
            <a href="event.php?id=<?= urlencode($event['id']) ?>&amp;ics=1" class="event-link">Add to calendar (.ics)</a>
        </p>
    </article>
</main>

<?php include 'footer.php'; ?>
