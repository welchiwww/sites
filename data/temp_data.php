<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            background-color: #dedede;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
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

        #chartContainer {
            width: 90%;
            height: 50vh;
            position: relative;
        }

        #myChart {
            width: 100% !important;
            height: 100% !important;
        }
    </style>
    <title>Графики температуры</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div>
        <p>Период отображения:</p>
        <form action="./temp_data.php" method="post" class="input_form">
            <input type="submit" name="hour_temperature" value="Час">
            <input type="submit" name="day_temperature" value="День">
            <input type="submit" name="month_temperature" value="Месяц">
        </form>
        <form action="main.php" method="post" class="input_form">
            <input type="submit" name="back" value="Вернуться на главную">
        </form>
    </div>
    <?php
    include ("../src/draw.php");

    $db = connect_to_database();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['hour_temperature'])) {
            create_graph('hour', 'temperature', $db);
        } elseif (isset($_POST['day_temperature'])) {
            create_graph('day', 'temperature', $db);
        } elseif (isset($_POST['month_temperature'])) {
            create_graph('month', 'temperature', $db);
        }
    }
    ?>
</body>
</html>
