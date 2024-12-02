<?php
// тут будем сохранять данные из формы в бд и перенаправлять пользователя на страницу подтверждения регистрации

// Начинаем сессию для передачи данных на следующую страницу
session_start(); 

//передаём поля переменным
$lastname = trim($_POST['last_name']);
$firstname = trim($_POST['first_name']);
$patronymic = trim($_POST['patronymic']);
$number = trim($_POST['phone']);
$email = trim($_POST['email']);
$section = trim($_POST['section']);
$date = trim($_POST['birthdate']);
$role = trim($_POST['role']);
$report = trim($_POST['report']);

$_SESSION['form_data'] = [
    'lastname' => $lastname,
    'firstname' => $firstname,
    'patronymic' => $patronymic,
    'phone' => $number,
    'email' => $email,
    'section' => $section,
    'birthdate' => $date,
    'role' => $role,
    'report' => $report
];

//данные для подключения к бд
$hostname = "mysql.j46555212.myjino.ru";
$username = "j46555212";
$password = "WvsLR-JaDS3n";
$database = "j46555212";

// обрабатываем необязательные поля
if ($date == "0000-00-00") {
    $date = null;
}
if ($report == "") {
    $report = null;
}

// подключаемся к бд, создаем таблицу и передаём туда данные
$mysql = new mysqli($hostname, $username, $password, $database);

// проверка подключения
if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}

$createTableQuery = "
    CREATE TABLE IF NOT EXISTS confmembers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        lastname VARCHAR(100) NOT NULL,
        firstname VARCHAR(100) NOT NULL,
        patronymic VARCHAR(100) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        email VARCHAR(100) NOT NULL,
        section VARCHAR(50) NOT NULL,
        birthdate DATE DEFAULT NULL,
        role VARCHAR(50) NOT NULL,
        report TEXT DEFAULT '0' 
    )
";
$mysql->query($createTableQuery);
$mysql->query("INSERT INTO confmembers (lastname, firstname, patronymic, phone, email, section, birthdate, role, report) VALUES('$lastname', '$firstname', '$patronymic', '$number', '$email', '$section', '$date', '$role', '$report')");

// флажки ошибок
if (!$mysql->query($createTableQuery)) {
    die("Ошибка создания таблицы: " . $mysql->error);
}

if (!$stmt->execute()) {
    die("Ошибка вставки данных: " . $stmt->error);
}

$mysql->close();

header('Location: successinfo.php');  // вставить правильный адрес
exit();