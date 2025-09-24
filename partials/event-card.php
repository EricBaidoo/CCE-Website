<?php
if (!isset($event)) return;
$featuredClass = isset($featuredClass) ? $featuredClass : '';

// timezone-aware computation for upcoming/past
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

$isUpcoming = $start ? ($start >= $today) : true;
$isPast = $end ? ($end < $today) : false;

// build a friendly date label: prefer explicit date string, else format start/end
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
<?php $isCompact = !empty($compact); ?>
<article class="event-card<?= $featuredClass ?> <?= $isCompact ? 'compact' : '' ?> <?= $isUpcoming ? 'event-upcoming' : ($isPast ? 'event-past' : '') ?>" data-event-id="<?= htmlspecialchars($event['id']) ?>">
    <div class="event-media">
        <img src="<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['title']) ?>" loading="lazy">
        <div class="event-badge" aria-hidden="true"><?= htmlspecialchars($dateLabel) ?></div>
    </div>
    <div class="event-body">
        <h3><?= htmlspecialchars($event['title']) ?></h3>
        <p class="meta"><?= htmlspecialchars($event['location']) ?></p>
        <?php if ($isCompact): ?>
            <p class="excerpt short"><?= htmlspecialchars($event['excerpt']) ?></p>
        <?php else: ?>
            <p><?= htmlspecialchars($event['excerpt']) ?></p>
        <?php endif; ?>
        <p class="event-actions">
                <?php if (!empty($event['registration_url']) && empty($isPast)): ?>
                    <a class="event-cta" href="<?= htmlspecialchars($event['registration_url']) ?>" target="_blank" rel="noopener" data-evt-action="register" data-evt-id="<?= htmlspecialchars($event['id']) ?>">Register</a>
                <?php endif; ?>
                <a class="event-link" href="event.php?id=<?= urlencode($event['id']) ?>" data-evt-action="details" data-evt-id="<?= htmlspecialchars($event['id']) ?>">Details</a>
        </p>
    </div>
</article>
