<?php
require_once 'config/database.php';

echo "<h1>CCE Database Seeder</h1>";

function seedTable($pdo, $tableName, $dataArray, $insertQuery, $bindCallback) {
    if (empty($dataArray)) {
        echo "<p>No data found for <strong>$tableName</strong>.</p>";
        return;
    }
    
    $stmt = $pdo->prepare($insertQuery);
    $count = 0;
    
    foreach ($dataArray as $item) {
        try {
            $stmt->execute($bindCallback($item));
            $count++;
        } catch (PDOException $e) {
            echo "<p style='color:red'>Error inserting into $tableName: " . $e->getMessage() . "</p>";
        }
    }
    echo "<p style='color:green'>Successfully inserted $count records into <strong>$tableName</strong>.</p>";
}

// 1. Seed News
$news = include 'data/news.php';
$newsQuery = "INSERT IGNORE INTO news (id, title, published_at, author, excerpt, featured_image, content) VALUES (?, ?, ?, ?, ?, ?, ?)";
seedTable($pdo, 'news', $news, $newsQuery, function($item) {
    return [
        $item['id'],
        $item['title'],
        $item['published_at'] ?? null,
        $item['author'] ?? null,
        $item['excerpt'] ?? null,
        $item['featured_image'] ?? null,
        $item['content'] ?? null
    ];
});

// 2. Seed Events
$events = include 'data/events.php';
$eventsQuery = "INSERT IGNORE INTO events (id, title, date_display, start_date, end_date, start_datetime, end_datetime, timezone, location, image, excerpt, registration_url, is_featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
seedTable($pdo, 'events', $events, $eventsQuery, function($item) {
    return [
        $item['id'],
        $item['title'],
        $item['date'] ?? null,
        $item['start_date'] ?? null,
        $item['end_date'] ?? null,
        $item['start_datetime'] ?? null,
        $item['end_datetime'] ?? null,
        $item['timezone'] ?? 'Africa/Accra',
        $item['location'] ?? null,
        $item['image'] ?? null,
        $item['excerpt'] ?? null,
        $item['registration_url'] ?? null,
        isset($item['is_featured']) && $item['is_featured'] ? 1 : 0
    ];
});

// 3. Seed People
$people = include 'data/people.php';
$peopleQuery = "INSERT IGNORE INTO people (id, name, role, bio_short, email, linkedin, photo) VALUES (?, ?, ?, ?, ?, ?, ?)";
seedTable($pdo, 'people', $people, $peopleQuery, function($item) {
    return [
        $item['id'],
        $item['name'],
        $item['role'] ?? null,
        $item['bio_short'] ?? null,
        $item['email'] ?? null,
        $item['linkedin'] ?? null,
        $item['photo'] ?? null
    ];
});

// 4. Seed Companies
$companies = include 'data/companies.php';
$companiesQuery = "INSERT IGNORE INTO companies (id, name, logo) VALUES (?, ?, ?)";
seedTable($pdo, 'companies', $companies, $companiesQuery, function($item) {
    return [
        $item['id'],
        $item['name'],
        $item['logo'] ?? null
    ];
});

echo "<h3>Seeding complete! You can safely delete this file.</h3>";
?>
