<?php
require 'db.php';
require 'Logger.php';

$logger = new Logger();

$shift = $_GET['shift'] ?? 'First';

$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$logger->logRequest($requestPath, 'shift=' . $shift);

$database = new Database();
$pdo = $database->getConnection();

try {
    $stmt = $pdo->prepare("
        SELECT n.name AS nurse_name, w.name AS ward_name
        FROM nurse n
        JOIN nurse_ward nw ON n.id_nurse = nw.fid_nurse
        JOIN ward w ON nw.fid_ward = w.id_ward
        WHERE n.shift = :shift
    ");

    $stmt->execute(['shift' => $shift]);
    $results = $stmt->fetchAll();

    foreach ($results as $row) {
        echo "Медсестра: {$row['nurse_name']}, Палата: {$row['ward_name']}<br>";
    }
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
?>
