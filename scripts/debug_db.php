<?php
require_once __DIR__ . '/config/database.php';

echo "<pre>";
echo "EVENTS:\n";
$events = $pdo->query("SELECT id, title, start_date, faculty_id FROM events")->fetchAll();
print_r($events);

echo "\nPEOPLE:\n";
$people = $pdo->query("SELECT id, name, role, faculty_id FROM people")->fetchAll();
print_r($people);
echo "</pre>";
?>
