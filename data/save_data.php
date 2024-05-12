<?php

include ("../src/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$db = connect_to_database();
$tableExists = $db->query("SELECT EXISTS (SELECT 1 FROM information_schema.tables WHERE table_name = 'sensor_data')")->fetchColumn();

if (!$tableExists) {
    $sql = "CREATE TABLE sensor_data (
                id serial PRIMARY KEY,
                temperature FLOAT NOT NULL,
                humidity FLOAT NOT NULL,
                co2_level FLOAT NOT NULL,
                reading_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
    $db->exec($sql);
    echo "Таблица sensor_data создана успешно.";
} else {
    echo "Таблица sensor_data уже существует.";
}

$temperature = $_POST['temp'];
$humidity = $_POST['hum'];
$co2_level = $_POST['co2'];

$sql = "INSERT INTO sensor_data (temperature, humidity, co2_level) VALUES (?, ?, ?)";
$stmt = $db->prepare($sql);
try {
    $stmt->execute([$temperature, $humidity, $co2_level]);
} catch (PDOException $e) {
    die($e->getMessage());
}

echo "Данные добавлены успешно!";
}
else header("Location: main.php");
