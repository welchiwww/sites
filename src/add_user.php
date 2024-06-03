<?php
include_once "../src/db.php";
$db = connect_to_database();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['add_user'])) {
        $username = $_POST['username'];
        $password = $_POST['password']; // Не забудьте хешировать пароль перед сохранением в базу данных

        // Проверка наличия имени пользователя и пароля
        if (!empty($username) && !empty($password)) {
            // Дополнительная проверка на уникальность имени пользователя (если требуется)

            // Хеширование пароля
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Добавление нового пользователя в базу данных
            $sql = "INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)";
            $stmt = $db->prepare($sql);
            $stmt->execute(['username' => $username, 'password_hash' => $hashed_password]);

            // Перенаправление на страницу со списком пользователей после добавления пользователя
            header("Location: ../data/users.php");
            exit();
        } else {
            // Обработка ошибки, если не заполнены обязательные поля
            echo "Имя пользователя и пароль обязательны для заполнения.";
        }
    }
}
?>
