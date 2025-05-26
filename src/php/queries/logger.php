<?php

try {
    $database = new Database();
    $pdo = $database->getConnection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $param1 = $_GET['param1'] ?? null;
    $param2 = $_GET['param2'] ?? null;

    $requestTime = date('Y-m-d H:i:s');

    $stmt = $pdo->prepare("INSERT INTO request_logs (request_path, param1, param2, request_time) VALUES (:path, :p1, :p2, :time)");
    $stmt->execute([
        ':path' => $requestPath,
        ':p1' => $param1,
        ':p2' => $param2,
        ':time' => $requestTime
    ]);
} catch (PDOException $e) {
    error_log("Помилка логування запиту: " . $e->getMessage());
}
