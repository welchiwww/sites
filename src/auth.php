<?php
require_once ("db.php");

$db = connect_to_database();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: ../data/main.php");
        exit();
    } else {
        session_start();
        $error_message = "Неправильное имя пользователя или пароль";
        $_SESSION['error_message'] = $error_message;
        header("Location: ../login.php");
        exit();
    }
}