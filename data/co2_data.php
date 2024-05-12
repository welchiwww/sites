<!DOCTYPE html>
<html>

<head>
    <title>Графики содержания углекислого газа</title>
    <style>
        body {
            background-color: #dedede;
        }

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

        p {
            text-align: center;
            font-size: 20px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div>
        <p>Период отображения:</p>
        <form action="./co2_data.php" method="post" class="input_form">
            <input type="submit" name="hour_co2" value="Час">
            <input type="submit" name="day_co2" value="День">
            <input type="submit" name="month_co2" value="Месяц">
        </form>
        <form action="main.php" method="post" class="input_form">
            <input type="submit" name="back" value="Вернуться на главную">
        </form>
    </div>

    <?php
    include ("../src/draw.php");

    $db = connect_to_database();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['hour_co2'])) {
            create_graph('hour', 'co2_level', $db);
        } elseif (isset($_POST['day_co2'])) {
            create_graph('day', 'co2_level', $db);
        } elseif (isset($_POST['month_co2'])) {
            create_graph('month', 'co2_level', $db);
        }
    }

    ?>


</body>