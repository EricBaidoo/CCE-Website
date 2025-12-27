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
<main class="events-page">
    <section class="page-header">
        <h1 class="page-title">Events & Conferences</h1>
        <p class="page-subtitle">Explore upcoming and past gatherings, workshops, and conferences designed to equip Christian professionals for transformative leadership</p>
        <form class="filters-bar" method="get" action="events.php">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-4">
                    <label class="form-label" for="status">Show</label>
                    <select id="status" name="status" class="form-select">
                        <option value="upcoming" <?= $status==='upcoming'?'selected':'' ?>>Upcoming Events</option>
                        <option value="past" <?= $status==='past'?'selected':'' ?>>Past Events</option>
                        <option value="all" <?= $status==='all'?'selected':'' ?>>All Events</option>
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="q">Search</label>
                    <input id="q" name="q" type="text" class="form-control" value="<?= htmlspecialchars($q) ?>" placeholder="Search by title, location, or description">
                </div>
                <div class="col-12 col-md-2">
                    <button class="btn btn-primary w-100" type="submit">Apply</button>
                </div>
            </div>
        </form>
    </section>

    <section class="events-grid">
        <?php if (empty($filtered)): ?>
            <div class="col-12"><div class="alert alert-info">No events found for the selected filters.</div></div>
        <?php else: ?>
            <?php foreach ($filtered as $event): ?>
                <?php $e = $event; $event = $e; $featuredClass = !empty($event['is_featured']) ? ' featured' : ''; include __DIR__ . '/partials/event-card.php'; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</main>
<?php include 'footer.php'; ?>
