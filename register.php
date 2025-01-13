<?php
include('db.php');  // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];  // Логин из формы
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Хэшируем пароль
    $email = $_POST['email'];  // Email из формы

    // Запрос для добавления нового пользователя в таблицу users
    $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username, 'password' => $password, 'email' => $email]);

    // Сообщение об успешной регистрации
    echo "Вы успешно зарегистрировались! Теперь вы можете войти.";

    // Задержка на 3 секунды и редирект на страницу входа
    sleep(3);  // Задержка 3 секунды
    header("Location: login.php");  // Перенаправление на страницу входа
    exit;  // Останавливаем выполнение кода
}
?>
<form action="register.php" method="POST">
    <label for="username">Имя пользователя:</label>
    <input type="text" name="username" id="username" required><br>
    <label for="password">Пароль:</label>
    <input type="password" name="password" id="password" required><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email"><br>
    <button type="submit" name="register">Зарегистрироваться</button>
</form>