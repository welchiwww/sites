<!DOCTYPE html>
<html>
<head>
    <style>
    .input_form {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    </style>
    <title>Графики температуры</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class = "input_form">
<p>Период отображения:</p>
<form action="temp_data.php" method="post">
    <input type="submit" name="hour_temperature" value="Час">
    <input type="submit" name="day_temperature" value="День">
    <input type="submit" name="month_temperature" value="Месяц">
</form>
<form action="index.php" method="post">
    <input type="submit" name="back" value="Вернуться на главную">
</form>
</div>
<?php
include("./functions.php");
$host = 'localhost';
$dbname = 'sensors';
$username = 'postgres';
$password = 'postgres';

$db = connect_to_database($host, $dbname, $username, $password);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['hour_temperature'])) {
        create_graph('hour', 'temperature', $db);
    }
    elseif (isset($_POST['day_temperature'])) {
        create_graph('day', 'temperature', $db);
    }
    elseif (isset($_POST['month_temperature'])) {
        create_graph('month', 'temperature', $db);
    }
}

?>


</body>