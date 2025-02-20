<?php
$host = "localhost";
$dbname = "weather";
$user = "postgres";
$password = "postgres@321";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "Database connection successfull";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
