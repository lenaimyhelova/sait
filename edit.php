<?php
require "db.php"; // подключаем файл для соединения с БД

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $login = $_POST['login'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Получаем объект пользователя по ID
    $user = R::load('users', $id);
    
    // Обновляем данные пользователя
    $user->login = $login;
    $user->name = $name;
    $user->password = password_hash($password, PASSWORD_DEFAULT); // Хешируем пароль
    R::store($user); // Сохраняем изменения

    header("Location: index.php"); // Перенаправление на главную страницу
    exit();
}

// Получаем ID из GET-запроса
$id = $_GET['id'];
$user = R::load('users', $id); // Загружаем пользователя по ID

?>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($user->id); ?>">
    Логин: <input type="text" name="login" value="<?php echo htmlspecialchars($user->login); ?>"><br>
    Имя: <input type="text" name="name" value="<?php echo htmlspecialchars($user->name); ?>"><br>
    Пароль: <input type="password" name="password" value=""><br> <!-- Оставляем поле пароля пустым -->
    <button type="submit">Сохранить</button>
</form>
