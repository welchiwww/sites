<!DOCTYPE html>
<html>
<head>
    <title>Выбор режима</title>
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
<form action="data/temp_data.php" method="get">
    <button type="submit">Температура</button>
</form>
<form action="data/hum_data.php" method="get">
    <button type="submit">Влажность</button>
</form>
<form action="data/co2_data.php" method="get">
    <button type="submit">Уровень углекислого газа</button>
</form>
</div>

</body>
</html>
