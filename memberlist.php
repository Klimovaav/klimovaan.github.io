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

            /* Снимаем предзаданные отступы у всех объектов */
            * {
                background-color: white;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Geologica', sans-serif;
            }
            
            /* Заголовок и описание */
            .description {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 40px;
                max-width: 800px;
                margin: 60px auto 20px auto;
            }
            h1 {
                grid-column: span 2; 
                font-size: 36px;
                font-weight: 500;
            }
            p {
                font-size: 20px;
                font-weight: 300;
                opacity: 0.8;
            }
            
            /* Таблица */
            table {
                border-collapse: collapse;
                width: 100%;
                max-width: 800px;
                margin: 0 auto;
            }
            th {  /* header */
                border-bottom: 1px solid #ddd;
                opacity: 0.6;
                font-size: 16px;
                font-weight: 300;
                text-align: left;
                padding: 10px;
            }
            td { /* data */
                border-bottom: 1px solid #ddd;
                font-size: 18px;
                font-weight: 300;
                padding: 10px;
            }


        </style>

    </head>

    <body>
        <div class="description"> 
            <h1>Вы зарегистрированы на конференцию</h1>
            <p>Список участников:</p>
        </div>

        <table>
            <thead>
                <tr>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Секция</th>
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