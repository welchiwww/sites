<?php

include ("./functions.php");
$host = 'localhost';
$dbname = 'sensors';
$username = 'postgres';
$password = 'postgres';

$db = connect_to_database($host, $dbname, $username, $password);

$temperature = $_POST['temp'];
$humidity = $_POST['hum'];
$co2_level = $_POST['co2'];

$sql = "INSERT INTO sensor_data (temperature, humidity, co2_level) VALUES (?, ?, ?)";
$stmt = $db->prepare($sql);
try{
    $stmt->execute([$temperature, $humidity, $co2_level, $reading_time]);
}
catch(PDOException $e) {
    echo "". $e->getMessage() ."";
}

echo "Data inserted successfully.";

?>
