<?php

require '../db.php';

$database = new Database();
$pdo = $database->getConnection();

$timestampRaw = $_POST['timestamp'] ?? null;
if ($timestampRaw) {
    $timestamp = date('Y-m-d H:i:s', strtotime($timestampRaw));
} else {
    $timestamp = date('Y-m-d H:i:s');
}

$browser = $_POST['browser'] ?? 'unknown';
$lat = $_POST['lat'] ?? null;
$lon = $_POST['lon'] ?? null;

$stmt = $pdo->prepare("INSERT INTO request_logs (timestamp, browser_info, latitude, longitude) VALUES (?, ?, ?, ?)");
$stmt->execute([$timestamp, $browser, $lat, $lon]);