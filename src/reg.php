<?php
require_once __DIR__ . ("/db.php");

$db = connect_to_database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = connect_to_database();
    $tableExists = $db->query("SELECT EXISTS (SELECT 1 FROM information_schema.tables WHERE table_name = 'sensor_data')")->fetchColumn();

    if (!$tableExists) {
        $sql = "CREATE TABLE users (
            id SERIAL PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            password_hash VARCHAR(255) NOT NULL
        );";
        $db->exec($sql);
        header("Location: register.php");
    }
    $username = $_POST["username"];
    $password = $_POST["password"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (username, password_hash) VALUES (:username, :password)");
    $stmt->execute(['username' => $username, 'password' => $hashed_password]);

    header("Location: ../login.php");
    exit();
}