<?php
require 'db.php';
require 'Logger.php';

$logger = new Logger();

$department = $_GET['department'] ?? '1';

$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$logger->logRequest($requestPath, 'department=' . $department);


$database = new Database();
$pdo = $database->getConnection();

try {
    $stmt = $pdo->prepare("
        SELECT name, shift
        FROM nurse
        WHERE department = :department
    ");

    $stmt->execute(['department' => $department]);
    $results = $stmt->fetchAll();

    foreach ($results as $row) {
        echo "Ім'я: {$row['name']}, Зміна: {$row['shift']}<br>";
    }
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
?>

