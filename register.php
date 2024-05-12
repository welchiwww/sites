<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
        }
        
        #greeting {
            margin-bottom: 20px;
            font-size: 24px;
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
    </style>
</head>
<body>
    <h2>Регистрация нового пользователя</h2>
    <form action="src/reg.php" method="post">
        <label for="username">Имя пользователя</label>
        <input type="text" name="username" id="username" placeholder="Введите имя пользователя">
        <label for="password">Пароль</label> 
        <input type="password" name="password" id="password" placeholder="Введите пароль">
        <button type="submit">Зарегистрироваться</button>
    </form>
</body>
</html>
