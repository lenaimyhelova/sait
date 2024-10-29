<?php
require "db.php"; // подключаем файл для соединения с БД

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Загружаем пользователя по ID
    $user = R::load('users', $id);
    
    if ($user->id) { // Проверяем существует ли пользователь
        R::trash($user); // Удаляем пользователя
        header("Location: index.php"); // Перенаправление на главную страницу
        exit();
    } else {
        echo "Пользователь не найден.";
    }
} else {
    echo "ID не указан.";
}
?>
