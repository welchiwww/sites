<?php
include_once "../src/db.php";
$db = connect_to_database();
// Проверка, был ли отправлен запрос на удаление пользователя и существует ли id пользователя для удаления
if(isset($_POST['delete_user']) && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Получение количества пользователей в системе
    $sql_count_users = 'SELECT COUNT(*) AS count FROM users';
    $stmt_count_users = $db->query($sql_count_users);
    $count_users = $stmt_count_users->fetch(PDO::FETCH_ASSOC)['count'];

    // Проверка, что пользователь не "admin" (id=1), и что он не является последним пользователем
    if($user_id != 1 || $count_users > 1) {
        // Удаление пользователя из базы данных
        $sql = "DELETE FROM users WHERE id = :user_id";
        $stmt = $db->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
    }
}

// Перенаправление на страницу со списком пользователей после удаления
header("Location: ../data/users.php");
exit();
?>
