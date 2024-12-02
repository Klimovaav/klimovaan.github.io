<?php
// тут будем сохранять данные из формы в бд

// Проверяем наличие данных в сессии, достаём
session_start(); 
if (!isset($_SESSION['form_data'])) {
    echo "Нет данных для отображения.";
    exit();
}
$formData = $_SESSION['form_data'];

// обрабатываем необязательные поля
if ($date == "0000-00-00") {
    $date = null;
}
if ($report == "") {
    $report = null;
}

// данные для подключения к бд
// я понимаю, что доступ к этой бд возможен только через мой пк, 
// но веб-серверы предлагают бесплатное хранение только первый месяц, а я не знаю, когда будет проверено задание
// в данном случае бд для примера организована на локальном сервере через XAMPP
$hostname = "localhost"; 
$username = "root";      
$password = "";          
$database = "conference_db";

// подключаемся к бд
$mysql = new mysqli($hostname, $username, $password, $database);

// проверка подключения
if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}

// Подготавливаем данные для сохранения
$lastname = $mysql->real_escape_string($formData['lastname']);
$firstname = $mysql->real_escape_string($formData['firstname']);
$patronymic = $mysql->real_escape_string($formData['patronymic']);
$phone = $mysql->real_escape_string($formData['phone']);
$email = $mysql->real_escape_string($formData['email']);
$section = $mysql->real_escape_string($formData['section']);
$date = $mysql->real_escape_string($formData['date']);
$role = $mysql->real_escape_string($formData['role']);
$report = $mysql->real_escape_string($formData['report']);

// Создаем запрос и добавляем данные
$sql = "INSERT INTO confmembers (lastname, firstname, patronymic, phone, email, section, date, role, report)
        VALUES ('$lastname', '$firstname', '$patronymic', '$phone', '$email', '$section', '$date', '$role', '$report')";

if ($mysql->query($sql) === TRUE) {
    echo "Вы успешно зарегистрировались!";
} else {
    echo "Ошибка: " . $mysql->error;
}

$mysql->close();

// Очищаем данные из сессии
unset($_SESSION['form_data']);
?>