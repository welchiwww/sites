<!DOCTYPE html>
<html>
<head>
    <title>Графики влажности</title>
    <style>
    .input_form {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    input {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 2px;
    }
    p{
        text-align: center;
        font-size: 20px;
    }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div>
<p>Период отображения:</p>
<form action="./hum_data.php" method="post" class = "input_form">
    <input type="submit" name="hour_humidity" value="Час">
    <input type="submit" name="day_humidity" value="День">
    <input type="submit" name="month_humidity" value="Месяц">
</form>
<form action="../index.php" method="post" class = "input_form">
    <input type="submit" name="back" value="Вернуться на главную">
</form>
</div>

<?php
include ("../src/draw.php");

$db = connect_to_database();
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