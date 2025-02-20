<?php
require 'config.php';

$apiKey = "";//Api key
$cities = ["London", "New York", "Mumbai", "Tokyo"];

foreach ($cities as $city) {
    $url = "http://api.weatherstack.com/current?access_key=" . $apiKey . "&query=" . urlencode($city);
    $response = file_get_contents($url);

    if ($response === false) {
        echo "Error: Failed to fetch data for $city\n";
        continue;
    }

    $data = json_decode($response, true);

   
    if ($data && isset($data['current'])) {
        $temperature = $data['current']['temperature']; // Correct extraction
        $humidity = $data['current']['humidity'];
        $description = $data['current']['weather_descriptions'][0] ?? 'Unknown'; // Handle missing description

        $stmt = $pdo->prepare("INSERT INTO weather_reports (city, temperature, humidity, description, created_at) 
                               VALUES (:city, :temperature, :humidity, :description, NOW())
                               ON CONFLICT (city) DO UPDATE 
                               SET temperature = EXCLUDED.temperature, 
                                   humidity = EXCLUDED.humidity, 
                                   description = EXCLUDED.description, 
                                   created_at = NOW()");
        $stmt->execute([
            ':city' => $city,
            ':temperature' => $temperature,
            ':humidity' => $humidity,
            ':description' => $description
        ]);

        echo "Updated weather data for $city\n";
    } else {
        echo "Failed to fetch valid data for $city. Response: $response\n";
    }
}
?>
