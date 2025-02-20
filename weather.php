<?php
require 'config.php';

header("Content-Type: application/json");

if (!isset($_GET['city'])) {
    echo json_encode(["error" => "City parameter is required"]);
    exit;
}

$city = $_GET['city'];

$stmt = $pdo->prepare("SELECT city, temperature, humidity, description, created_at FROM weather_reports WHERE city = :city ORDER BY created_at DESC LIMIT 1");
$stmt->execute([':city' => $city]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($data) {
    echo json_encode($data);
} else {
    echo json_encode(["error" => "No weather data found for the specified city"]);
}
?>
