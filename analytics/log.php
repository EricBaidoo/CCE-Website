<?php
// Simple analytics logger for local testing only.
// Accepts JSON POSTs and appends to analytics/analytics.log with timestamp.

// Basic CORS allowance for local testing
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

$input = file_get_contents('php://input');
if (!$input) {
    echo json_encode(['ok' => false, 'error' => 'no payload']);
    http_response_code(400);
    exit;
}

$decoded = json_decode($input, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['ok' => false, 'error' => 'invalid json']);
    http_response_code(400);
    exit;
}

$logDir = __DIR__;
$logFile = $logDir . '/analytics.log';
$entry = json_encode(['ts' => date('c'), 'payload' => $decoded], JSON_UNESCAPED_SLASHES) . PHP_EOL;
file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);

echo json_encode(['ok' => true]);
