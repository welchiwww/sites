<!DOCTYPE html>
<html>

<head>
    <title>Выбор режима</title>
    <style>
        body {
            background-color: #dedede;
        }

        .container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .input_form {
            margin: 5px;
        }

        button {
            width: 200px;
            /* Ширина кнопок */
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
    <div class="container">
        <form action="./temp_data.php" method="get" class="input_form">
            <button type="submit">Температура</button>
        </form>
        <form action="./hum_data.php" method="get" class="input_form">
            <button type="submit">Влажность</button>
        </form>
        <form action="./co2_data.php" method="get" class="input_form">
            <button type="submit">Уровень углекислого газа</button>
        </form>
        <form action="./users.php" method="post" class="input_form">
            <button type="submit">Пользователи</button>
        </form>
        <form action="./logout.php" method="post" class="input_form">
            <button type="submit">Выход</button>
        </form>
    </div>
</body>
</html>
<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit();
}
;
?>