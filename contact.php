<?php
session_start();
include('db.php');

// Проверка авторизации
if (!isset($_SESSION['user'])) {
    echo "Пожалуйста, авторизуйтесь, чтобы отправить сообщение.";
    echo '<br><a href="login.php">Перейти на страницу авторизации</a>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_message'])) {
    $user_id = $_SESSION['user']['id'];
    $message = $_POST['message'];

    // Сохранение сообщения в базе данных 
    $sql = "INSERT INTO messages (user_id, message) VALUES (:user_id, :message)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id, 'message' => $message]);

    echo "Ваше сообщение отправлено!";
    header('Location: contact.php'); // Перезагрузка страницы
    exit;
}
?>

<h2>Форма обратной связи</h2>
<form method="POST">
    <textarea name="message" placeholder="Ваше сообщение" required></textarea><br>
    <button type="submit" name="send_message">Отправить</button>
</form>
