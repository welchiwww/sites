<!DOCTYPE html>
<html>
<head>
    <title>Графики влажности</title>
    <style>
    .input_form {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class = "input_form">
<p>Период отображения:</p>
<form action="hum_data.php" method="post">
    <input type="submit" name="hour_humidity" value="Час">
    <input type="submit" name="day_humidity" value="День">
    <input type="submit" name="month_humidity" value="Месяц">
</form>
<form action="index.php" method="post">
    <input type="submit" name="back" value="Вернуться на главную">
</form>
</div>

<?php
include("./functions.php");
$host = 'postgres';
$dbname = 'sensors';
$username = 'postgres';
$password = 'postgres';

$db = connect_to_database($host, $dbname, $username, $password);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['hour_humidity'])) {
        create_graph('hour', 'humidity', $db);
    }
    elseif (isset($_POST['day_humidity'])) {
        create_graph('day', 'humidity', $db);
    }
    elseif (isset($_POST['month_humidity'])) {
        create_graph('month', 'humidity', $db);
    }
}

?>


</body>