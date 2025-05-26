<?php
require '../db.php';

$database = new Database();
$pdo = $database->getConnection();

header("Content-Type: application/xml; charset=utf-8");

$xml = new DOMDocument("1.0", "UTF-8");
$root = $xml->createElement("nurses");

$stmt = $pdo->query("SELECT name, date, department, shift FROM nurse");
while ($row = $stmt->fetch()) {
    $nurse = $xml->createElement("nurse");

    $nurse->appendChild($xml->createElement("name", htmlspecialchars($row['name'])));
    $nurse->appendChild($xml->createElement("date", $row['date']));
    $nurse->appendChild($xml->createElement("department", $row['department']));
    $nurse->appendChild($xml->createElement("shift", htmlspecialchars($row['shift'])));

    $root->appendChild($nurse);
}

$xml->appendChild($root);
echo $xml->saveXML();