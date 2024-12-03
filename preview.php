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

        <!-- Подключаем шрифт --> 
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@100..900&display=swap" rel="stylesheet">
        <title>Подтверждение данных</title>
        <style>

            /* Снимаем предзаданные отступы у всех объектов */
            * {
                background-color: white;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Geologica', sans-serif;
            }

            /* Grid-разметка элементов */
            .contanier, .btncont {
                display: grid;
                grid-template-columns: 1fr 1fr; 
            }

            /* Общий контейнер */
            .contanier {
                gap: 20px;
                max-width: 600px;
                margin: 60px auto; /* Центрируем форму */
                padding: 40px;
            }

            /* Контейнер с кнопками */
            .btncont {
                grid-column: span 2;
                gap: 10px;
                margin: 30px 0px 0px 0px;
            }

            /* Заголовок */
            h1 {
                grid-column: span 2;
                margin: 0px 0px 30px 0px;
                font-size: 36px;
                font-weight: 500;
            }

            /* Кнопки */
            .mainbtn, .secondbtn {
                padding: 12px 20px;
                border-radius: 10px;
                cursor: pointer;
                font-size: 18px;
                width: 100%;
            }

            /* Акцентная кнопка */
            .mainbtn {
                background-color: red;
                color: white;
                border: none;
            }
            .mainbtn:hover {
                background-color: rgba(234, 7, 7, 1);
            }

            /* Второстепенная кнопка */
            .secondbtn {
                background-color: white;
                color: red;
                border: 1px solid red;
            }
            .secondbtn:hover {
                border: 1px solid rgba(229, 5, 5, 0.4);
            }

            /* Наименования строк */
            .strname {
                opacity: 0.7;
                font-size: 16px;
                font-weight: 300;
            }

            /*  */
            .perinfo {
                font-size: 18;
                font-weight: 300;
            }

        </style>
    </head>

    <body>

        <div class="contanier"> 
            <h1>Проверьте данные:</h1>

            <p class="strname">Фамилия:</p> <p class="perinfo"><?php echo $lastname; ?></p>
            <p class="strname">Имя:</p> <p class="perinfo"><?php echo $firstname; ?></p>
            <p class="strname">Отчество:</p> <p class="perinfo"><?php echo $patronymic; ?></p>
            <p class="strname">Телефон:</p> <p class="perinfo"><?php echo $number; ?></p>
            <p class="strname">Email:</p> <p class="perinfo"><?php echo $email; ?></p>
            <p class="strname">Секция:</p> <p class="perinfo"><?php echo $section; ?></p>
            <p class="strname">Дата рождения:</p> <p class="perinfo"><?php echo $date ?: 'Не указана'; ?></p>
            <p class="strname">Роль:</p> <p class="perinfo"><?php echo $role; ?></p>

            <?php if ($role == "Докладчик"): ?>
                <p class="strname">Доклад:</p> <p class="perinfo"><?php echo $report; ?></p>
            <?php endif; ?>

            <div class="btncont">
                <form action="index.html" method="GET">
                    <button class="secondbtn" type="submit">Ввести другие данные</button>
                </form>

                <form action="bd.php" method="POST">
                    <button class="mainbtn" type="submit">Подтвердить данные</button>
                </form>
            </div>
        </div>

    </body>

</html>