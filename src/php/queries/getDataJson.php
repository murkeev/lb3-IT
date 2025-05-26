<?php
require '../db.php';

$database = new Database();
$pdo = $database->getConnection();

header("Content-Type: application/json; charset=utf-8");


$stmt = $pdo->query("SELECT name, date, department, shift FROM nurse");
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);