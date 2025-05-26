<?php

try {
    $database = new Database();
    $pdo = $database->getConnection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $param = $_GET['param1'] ?? null;

    $requestTime = date('Y-m-d H:i:s');

    $stmt = $pdo->prepare("INSERT INTO request_logs (request_path, param, request_time) VALUES (:path, :p1, :time)");
    $stmt->execute([
        ':path' => $requestPath,
        ':p1' => $param,
        ':time' => $requestTime
    ]);
} catch (PDOException $e) {
    error_log("Помилка логування запиту: " . $e->getMessage());
}
