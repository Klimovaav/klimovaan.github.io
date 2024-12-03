<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}

// Подготавливаем данные для сохранения
$lastname = $mysqli->real_escape_string($formData['lastname']);
$firstname = $mysqli->real_escape_string($formData['firstname']);
$patronymic = $mysqli->real_escape_string($formData['patronymic']);
$number = $mysqli->real_escape_string($formData['number']);
$email = $mysqli->real_escape_string($formData['email']);
$section = $mysqli->real_escape_string($formData['section']);
$date = $mysqli->real_escape_string($formData['date']);
$role = $mysqli->real_escape_string($formData['role']);
$report = $mysqli->real_escape_string($formData['report']);

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

if ($mysqli->query($sql) === TRUE) {
    // Очищаем данные из сессии
    unset($_SESSION['form_data']);
    // Направляем на страницу со списком
    header('Location: memberlist.php');
    exit();
} else {
    echo "Ошибка: " . $mysqli->error;
}

$mysqli->close();
?>