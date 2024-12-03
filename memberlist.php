<?php

// данные для подключения к бд
$hostname = "localhost"; 
$username = "root";      
$password = "";          
$database = "confpeople_db";

$mysql = new mysqli($hostname, $username, $password, $database);

if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}

// Получение данных из таблицы
$sql = "SELECT * FROM confmembers";
$result = $mysql->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<!-- страница со списком -->

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../css/style.css" />

        <!-- Подключаем шрифт --> 
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@100..900&display=swap" rel="stylesheet">
        <title>Список участников</title>
        <style>

        </style>

    </head>

    <body>
        <h1>Вы успешно зарегистрировались</h1>
        <p>Список участников</p>

        <table>
            <thead>
                <tr>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Секция</th>
                <th>Роль</th>
                <th>Тема доклада</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                            <td><?php echo htmlspecialchars($row['patronymic']); ?></td>
                            <td><?php echo htmlspecialchars($row['section']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                            <td><?php echo htmlspecialchars($row['report'] ?: ''); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Нет участников</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </body>
    
</html>

<?php
$mysql->close();
?>