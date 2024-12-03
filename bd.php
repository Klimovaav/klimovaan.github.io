<?php
// тут будем сохранять данные из формы в бд

// Проверяем наличие данных в сессии, достаём
session_start(); 
if (!isset($_SESSION['form_data'])) {
    echo "Нет данных для отображения.";
    exit();
}
$formData = $_SESSION['form_data'];

// данные для подключения к бд
$hostname = "localhost";
$username = "yautochkay";
$password = "E&LVd2ZNFBLDEW1P";
$database = "yautochkay";

// Подключаемся к бд
$mysqli = new mysqli($hostname, $username, $password, $database, null, '/var/run/mysqld/mysqld.sock');

// проверка подключения
if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}

// Подготавливаем данные для сохранения
$lastname = $mysql->real_escape_string($formData['lastname']);
$firstname = $mysql->real_escape_string($formData['firstname']);
$patronymic = $mysql->real_escape_string($formData['patronymic']);
$number = $mysql->real_escape_string($formData['number']);
$email = $mysql->real_escape_string($formData['email']);
$section = $mysql->real_escape_string($formData['section']);
$date = $mysql->real_escape_string($formData['date']);
$role = $mysql->real_escape_string($formData['role']);
$report = $mysql->real_escape_string($formData['report']);

// обрабатываем необязательные поля
if ($date == "0000-00-00") {
    $date = null;
}
if ($report == "") {
    $report = null;
}

// Создаем запрос и добавляем данные
$sql = "INSERT INTO confmembers (lastname, firstname, patronymic, phone, email, section, birthdate, role, report)
        VALUES ('$lastname', '$firstname', '$patronymic', '$number', '$email', '$section', '$date', '$role', '$report')";

if ($mysql->query($sql) === TRUE) {
    // Направляем на страницу со списком
    header('Location: memberlist.php');
    exit();
} else {
    echo "Ошибка: " . $mysql->error;
}

$mysql->close();

// Очищаем данные из сессии
unset($_SESSION['form_data']);
?>