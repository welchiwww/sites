<?php
session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Авторизация</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #dedede;
        }

        #auth {
            margin-bottom: 20px;
            font-family: cursive;
            font-size: 24px;
            padding: 10px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: white;
            background-color: #ff6666;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div id="auth">Авторизация</div>
    <form action="/src/auth.php" method="post">
        <label for="username">Имя пользователя</label>
        <input type="text" name="username" id="username" placeholder="Введите имя пользователя">
        <label for="password">Пароль</label>
        <input type="password" name="password" id="password" placeholder="Введите пароль">
        <button type="submit">Войти</button>
    </form>
    <?php if (isset($_SESSION['error_message'])) { ?>
        <div class="error-message"><?php echo $_SESSION['error_message']; ?></div>
        <?php unset($_SESSION['error_message']); ?>
    <?php } ?>

    <?php
    if (isset($_SESSION['user_id'])) {
        header("Location: /data/main.php");
    }
    ?>
</body>

</html>
