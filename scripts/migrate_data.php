<?php
require_once __DIR__ . '/config/database.php';

try {
    // 1. Migrate News
    $allNews = include __DIR__ . '/data/news.php';
    if (is_array($allNews) && count($allNews) > 0) {
        $stmtNews = $pdo->prepare("INSERT IGNORE INTO news (id, title, published_at, author, excerpt, featured_image, content) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $newsCount = 0;
        foreach ($allNews as $news) {
            $stmtNews->execute([
                $news['id'],
                $news['title'],
                $news['published_at'],
                $news['author'],
                $news['excerpt'],
                $news['featured_image'],
                $news['content']
            ]);
            $newsCount++;
        }
        echo "Migrated $newsCount news articles.\n";
    }

    // 2. Migrate Events
    $allEvents = include __DIR__ . '/data/events.php';
    if (is_array($allEvents) && count($allEvents) > 0) {
        $stmtEvents = $pdo->prepare("INSERT IGNORE INTO events (id, title, date_display, start_date, end_date, start_datetime, end_datetime, timezone, location, image, excerpt, registration_url, is_featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $eventsCount = 0;
        foreach ($allEvents as $event) {
            $stmtEvents->execute([
                $event['id'],
                $event['title'],
                $event['date'] ?? '',
                $event['start_date'] ?? null,
                $event['end_date'] ?? null,
                $event['start_datetime'] ?? null,
                $event['end_datetime'] ?? null,
                $event['timezone'] ?? 'Africa/Accra',
                $event['location'] ?? '',
                $event['image'] ?? '',
                $event['excerpt'] ?? '',
                $event['registration_url'] ?? '',
                isset($event['is_featured']) && $event['is_featured'] ? 1 : 0
            ]);
            $eventsCount++;
        }
        echo "Migrated $eventsCount events.\n";
    }

} catch (PDOException $e) {
    die("Migration failed: " . $e->getMessage() . "\n");
}
?>
