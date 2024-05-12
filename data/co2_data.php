<!DOCTYPE html>
<html>
<head>
    <title>Графики содержания углекислого газа</title>
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
<form action="./co2_data.php" method="post">
    <input type="submit" name="hour_co2" value="Час">
    <input type="submit" name="day_co2" value="День">
    <input type="submit" name="month_co2" value="Месяц">
</form>
<form action="../index.php" method="post">
    <input type="submit" name="back" value="Вернуться на главную">
</form>
</div>

<?php
include("../src/draw.php");

$db = connect_to_database();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['hour_co2'])) {
        create_graph('hour', 'co2_level', $db);
    }
    elseif (isset($_POST['day_co2'])) {
        create_graph('day', 'co2_level', $db);
    }
    elseif (isset($_POST['month_co2'])) {
        create_graph('month', 'co2_level', $db);
    }
}

?>


</body>