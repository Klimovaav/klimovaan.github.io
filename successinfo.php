<?php
session_start(); // Инициализация сессии

// Получение данных из сессии
if (!isset($_SESSION['form_data'])) {
    echo "Нет данных для отображения.";
    exit();
}

$formData = $_SESSION['form_data'];
?>

<!DOCTYPE html>
<html lang="en">
<!-- страница успешной регистрации -->

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />  <!-- можно и удалить, это только для правильного считывания на старых барузерах -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../css/style.css" />
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300&display=swap" rel="stylesheet" />
        <title>Форма регистрации</title>
    </head>

    <body>

        <h1>Вы успешно зарегистрировались</h1>
        <p><strong>Фамилия:</strong> <?php echo htmlspecialchars($formData['lastname']); ?></p>
        <p><strong>Имя:</strong> <?php echo htmlspecialchars($formData['firstname']); ?></p>
        <p><strong>Отчество:</strong> <?php echo htmlspecialchars($formData['patronymic']); ?></p>
        <p><strong>Телефон:</strong> <?php echo htmlspecialchars($formData['phone']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($formData['email']); ?></p>
        <p><strong>Секция:</strong> <?php echo htmlspecialchars($formData['section']); ?></p>
        <p><strong>Дата рождения:</strong> <?php echo htmlspecialchars($formData['birthdate'] ?: 'Не указана'); ?></p>
        <p><strong>Роль:</strong> <?php echo htmlspecialchars($formData['role']); ?></p>

        <?php if ($formData['role'] == "Буду докладчиком"): ?>
            <p><strong>Доклад:</strong> <?php echo htmlspecialchars($formData['report']); ?></p>
        <?php endif; ?>

    </body>

</html>