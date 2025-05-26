<?php
class Logger {
    private $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function logRequest($path, $param1 = null) {
        $sql = "INSERT INTO server_logs (request_path, param, request_time)
                VALUES (:path, :param, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'path' => $path,
            'param' => $param1
        ]);
    }
}
