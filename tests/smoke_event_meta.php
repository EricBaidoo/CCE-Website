<?php
// Simple smoke test: request an event page and assert JSON-LD and OG meta tags exist.
// Usage: php tests/smoke_event_meta.php <event_id>

if ($argc < 2) {
    echo "Usage: php tests/smoke_event_meta.php <event_id>\n";
    exit(2);
}
$eventId = $argv[1];
$base = 'http://localhost/CCE'; // adjust if your local path differs
$url = rtrim($base, '/') . '/event.php?id=' . urlencode($eventId);

$options = [
    'http' => [
        'method' => 'GET',
        'header' => "User-Agent: SmokeTest/1.0\r\n"
    ]
];
$context = stream_context_create($options);
$contents = @file_get_contents($url, false, $context);
if ($contents === false) {
    echo "ERROR: Could not fetch $url\n";
    exit(3);
}

$hasOg = preg_match('/<meta\s+property=["\']og:title["\']/i', $contents);
$hasJsonLd = preg_match('/<script\s+type=["\']application\/ld\+json["\']>/', $contents);

echo "Smoke test for $url\n";
echo " - og:title present: " . ($hasOg ? 'YES' : 'NO') . "\n";
echo " - JSON-LD present: " . ($hasJsonLd ? 'YES' : 'NO') . "\n";

if (!$hasOg || !$hasJsonLd) exit(4);

echo "OK\n";
