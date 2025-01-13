<?php
session_start();
if (isset($_SESSION['username'])) {
    if (isset($_POST['submit_feedback'])) {
        $message = $_POST['message'];
        // Здесь можно добавить код для обработки отзыва, например, отправка в базу данных или на email
        echo "Спасибо за ваш отзыв!";
    }
} else {
    echo "Пожалуйста, войдите, чтобы оставить отзыв.";
}
?>

<form action="feedback.php" method="POST">
    <textarea name="message" required></textarea><br>
    <button type="submit" name="submit_feedback">Отправить</button>
</form>