<?php
require 'db.php';
require 'Logger.php';

$logger = new Logger();

$nurseName = isset($_GET['nurse_name']) ? $_GET['nurse_name'] : 'ivanova';

$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$logger->logRequest($requestPath, 'nurse_name=' . $nurseName);

$database = new Database();
$pdo = $database->getConnection();

try {
    $stmt = $pdo->prepare("
        SELECT w.name AS ward_name
        FROM nurse n
        JOIN nurse_ward nw ON n.id_nurse = nw.fid_nurse
        JOIN ward w ON nw.fid_ward = w.id_ward
        WHERE n.name = :nurse_name
    ");

    $stmt->execute(['nurse_name' => $nurseName]);
    $results = $stmt->fetchAll();

    foreach ($results as $row) {
        echo "Палата: {$row['ward_name']}<br>";
    }
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
?>
