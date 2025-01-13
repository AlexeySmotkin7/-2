<?php
session_start();
include('db.php');

// Проверка авторизации
if (!isset($_SESSION['user'])) {
    echo "Пожалуйста, авторизуйтесь, чтобы просматривать список покупок.";
    echo '<br><a href="login.php">Перейти на страницу авторизации</a>';
    exit;
}

$user_id = $_SESSION['user']['id'];

// Удаление покупки
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_purchase'])) {
    $purchase_id = $_POST['purchase_id'];

    $sql = "DELETE FROM purchases WHERE id = :purchase_id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'purchase_id' => $purchase_id,
        'user_id' => $user_id
    ]);

    header('Location: purchases.php');
    exit;
}

// Добавление товара из списка продуктов в покупки
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_from_products'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Получаем информацию о продукте
    $sql = "SELECT * FROM products WHERE id = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['product_id' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $sql = "INSERT INTO purchases (user_id, product_name, quantity, price) VALUES (:user_id, :product_name, :quantity, :price)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $user_id,
            'product_name' => $product['name'],
            'quantity' => $quantity,
            'price' => $product['price'] * $quantity
        ]);
        header('Location: purchases.php');
        exit;
    }
}

// Просмотр списка покупок
$sql = "SELECT * FROM purchases WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$purchases = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Получение списка продуктов
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Список покупок</title>
</head>
<body>
<header>
    <nav>
        <ul class="navbar">
            <li><a href="index.php">Главная</a></li>
            <li><a href="shop.php">Магазин</a></li>
            <li><a href="about.php">О нас</a></li>
            <li><a href="purchases.php">Покупки</a></li>
            <li><a href="logout.php">Выйти</a></li>
        </ul>
    </nav>
</header>

<h2>Ваши покупки:</h2>

<?php if (!empty($purchases)): ?>
    <ul>
        <?php foreach ($purchases as $purchase): ?>
            <li>
                <?= htmlspecialchars($purchase['product_name']) ?> - <?= $purchase['quantity'] ?> шт. - <?= $purchase['price'] ?>₽
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="purchase_id" value="<?= $purchase['id'] ?>">
                    <button type="submit" name="delete_purchase">Удалить</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Ваш список покупок пуст.</p>
<?php endif; ?>

<!-- Форма добавления товара из списка продуктов -->
<h3>Добавить товар из списка продуктов</h3>
<form method="POST">
    <select name="product_id" required>
        <option value="" disabled selected>Выберите товар</option>
        <?php foreach ($products as $product): ?>
            <option value="<?= $product['id'] ?>"><?= htmlspecialchars($product['name']) ?> - <?= $product['price'] ?>₽</option>
        <?php endforeach; ?>
    </select><br>
    <input type="number" name="quantity" placeholder="Количество" required><br>
    <button type="submit" name="add_from_products">Добавить</button>
</form>

</body>
</html>

<!-- Форма обратной связи -->
<h3>Форма обратной связи</h3>
<form method="POST">
    <textarea name="message" placeholder="Ваше сообщение" required></textarea><br>
    <button type="submit" name="send_message">Отправить</button>
</form>

<?php
// Отправка сообщения
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (user_id, message) VALUES (:user_id, :message)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'user_id' => $user_id,
        'message' => $message
    ]);

    echo "Ваше сообщение отправлено!";
    header('Location: purchases.php');
    exit;
}
?>
</body>
</html>