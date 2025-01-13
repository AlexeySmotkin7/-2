<?php
session_start();
include('db.php');

// Проверка формы авторизации
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Поиск пользователя в базе данных
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Если пользователь найден и пароли совпадают
    if ($user && password_verify($password, $user['password'])) {
        // Сохраняем данные пользователя в сессию
        $_SESSION['user'] = $user;

        // Перенаправляем на страницу покупок после успешной авторизации
        header('Location: purchases.php');
        exit;
    } else {
        echo "Неверный логин или пароль!";
    }
}
?>

<!-- Форма входа -->
<form method="POST">
    <input type="text" name="username" placeholder="Логин" required><br>
    <input type="password" name="password" placeholder="Пароль" required><br>
    <button type="submit" name="login">Войти</button>
</form>

