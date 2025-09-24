<?php
$events = include __DIR__ . '/../data/events.php';
$ids = array_map(function($e){ return $e['id'] ?? ''; }, $events);
$counts = array_count_values($ids);
$dups = array_filter($counts, function($c){ return $c > 1; });
if (!empty($dups)) {
    echo "Duplicate ids found:\n";
    foreach ($dups as $id => $count) {
        echo " - $id repeated $count times\n";
    }
    exit(1);
}
echo "No duplicate ids\n";
return 0;
