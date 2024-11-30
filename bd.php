<?php
// тут будем сохранять данные из формы в бд и перенаправлять пользователя на страницу подтверждения регистрации

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
// тут может возникнуть ошибка, если такая таблица уже существует
$createTableQuery = "
    CREATE TABLE confmembers (
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
$mysql->query("INSERT INTO confmembers (lastname, firstname, patronymic, phone, email, section, birthdate, role, report) VALUES('$lastname', '$firstname', '$patronymic', '$number', '$email', '$section', '$date', 'role', '$report')");

$mysql->close();

header('Location: /html/info.php');