<?php
if (!isset($event)) return;
$isFeatured = !empty($is_featured);
// timezone-aware checks (reuse logic from event-card)
$tz = isset($event['timezone']) ? new DateTimeZone($event['timezone']) : new DateTimeZone(date_default_timezone_get());
$today = (new DateTimeImmutable('now', $tz))->setTime(0,0,0);
$start = null; $end = null;
if (!empty($event['start_datetime'])) {
    $start = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $event['start_datetime'], $tz);
} elseif (!empty($event['start_date'])) {
    $start = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $event['start_date'] . ' 00:00:00', $tz);
}
if (!empty($event['end_datetime'])) {
    $end = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $event['end_datetime'], $tz);
} elseif (!empty($event['end_date'])) {
    $end = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $event['end_date'] . ' 23:59:59', $tz);
}
$isPast = $end ? ($end < $today) : false;
// friendly date text
if (!empty($event['date'])) {
    $dateLabel = $event['date'];
} elseif ($start && $end && $start->format('Y-m-d') !== $end->format('Y-m-d')) {
    $dateLabel = $start->format('M j') . '–' . $end->format('j');
} elseif ($start) {
    $dateLabel = $start->format('M j');
} else {
    $dateLabel = 'TBD';
}
?>
<article class="event-row <?= $isFeatured ? 'featured' : '' ?> <?= $isPast ? 'past' : 'upcoming' ?>" data-event-id="<?= htmlspecialchars($event['id']) ?>">
    <div class="event-row-media"><img src="<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" loading="lazy"></div>
    <div class="event-row-body">
        <h3><?= htmlspecialchars($event['title']) ?></h3>
        <p class="meta"><?= htmlspecialchars($dateLabel) ?> • <?= htmlspecialchars($event['location'] ?? '') ?></p>
        <p class="excerpt"><?= htmlspecialchars($event['excerpt']) ?></p>
        <div class="event-row-actions">
            <?php if (!empty($event['registration_url']) && empty($isPast)): ?>
                <a class="event-cta" href="<?= htmlspecialchars($event['registration_url']) ?>" target="_blank" rel="noopener">Register</a>
            <?php endif; ?>
            <a class="event-link" href="event.php?id=<?= urlencode($event['id']) ?>">Details</a>
        </div>
    </div>
</article>
