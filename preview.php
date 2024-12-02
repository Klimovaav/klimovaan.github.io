<?php
// Принимаем данные из формы
$lastname = htmlspecialchars($_POST['last_name']);
$firstname = htmlspecialchars($_POST['first_name']);
$patronymic = htmlspecialchars($_POST['patronymic']);
$number = htmlspecialchars($_POST['phone']);
$email = htmlspecialchars($_POST['email']);
$section = htmlspecialchars($_POST['section']);
$date = htmlspecialchars($_POST['birthdate']);
$role = htmlspecialchars($_POST['role']);
$report = htmlspecialchars($_POST['report']);

// Сохраняем данные в сессии для передачи в следующий файл
session_start();
$_SESSION['form_data'] = [
    'lastname' => $lastname,
    'firstname' => $firstname,
    'patronymic' => $patronymic,
    'number' => $number,
    'email' => $email,
    'section' => $section,
    'date' => $date,
    'role' => $role,
    'report' => $report
];
?>

<!DOCTYPE html>
<html lang="en">
<!-- страница подтверждения данных -->

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />  <!-- можно и удалить, это только для правильного считывания на старых барузерах -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../css/style.css" />
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300&display=swap" rel="stylesheet" />
        <title>Подтверждение данных</title>
    </head>

    <body>

        <h1>Проверьте данные перед отправкой</h1>
        <p><strong>Фамилия:</strong> <?php echo $lastname; ?></p>
        <p><strong>Имя:</strong> <?php echo $firstname; ?></p>
        <p><strong>Отчество:</strong> <?php echo $patronymic; ?></p>
        <p><strong>Телефон:</strong> <?php echo $number; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Секция:</strong> <?php echo $section; ?></p>
        <p><strong>Дата рождения:</strong> <?php echo $date ?: 'Не указана'; ?></p>
        <p><strong>Роль:</strong> <?php echo $role; ?></p>

        <?php if ($role == "Докладчик"): ?>
            <p><strong>Доклад:</strong> <?php echo $report; ?></p>
        <?php endif; ?>

        <form action="bd.php" method="POST">
            <button type="submit">Подтвердить данные</button>
        </form>

        <form action="index.html" method="GET">
            <button type="submit">Ввести другие данные</button>
        </form>

    </body>

</html>