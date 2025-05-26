<?php
require '../db.php';

$database = new Database();
$pdo = $database->getConnection();

header("Content-Type: text/html; charset=UTF-8");

$stmt = $pdo->query("SELECT name, date, department, shift FROM nurse");
while ($row = $stmt->fetch()) {
    echo "<p><strong>{$row['name']}</strong> — {$row['date']}, відділення {$row['department']}, зміна {$row['shift']}</p>";
}