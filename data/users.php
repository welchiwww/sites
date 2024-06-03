<!DOCTYPE html>
<html lang="ru">

<?php
include_once "../src/db.php";
$db = connect_to_database();

// Получение списка пользователей
$sql = 'SELECT id, username FROM users';
$stmt = $db->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список пользователей</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя пользователя</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td>
                            <form action="../src/delete_user.php" method="post">
                                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                <input type="submit" name="delete_user" value="Удалить">
                            </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="button-container">
            <button onclick="openModal()">Добавить пользователя</button>
            <form action="./main.php" method="get">
                <input type="submit" name="back" value="Назад">
            </form>
        </div>


        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Добавить пользователя</h2>
                <form action="../src/add_user.php" method="post">
                    <label for="username">Имя пользователя:</label>
                    <input type="text" id="username" name="username">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password">
                    <input type="submit" name="add_user" value="Добавить пользователя">
                </form>
            </div>
        </div>
    </div>

    <script>
        var modal = document.getElementById("myModal");

        function openModal() {
            modal.style.display = "block";
        }

        function closeModal() {
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>

</html>