<?php
// Получаем ID товара из URL
$productId = $_GET['id'];

// Подключение к базе данных и извлечение данных о товаре
include 'db.php';

$sql = "SELECT * FROM products WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Если товар не найден
if (!$product) {
    die('Товар не найден');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Шапка -->
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="shop.php">Магазин</a></li>
                <li><a href="about.php">О нас</a></li>
            </ul>
        </nav>
    </header>

    <!-- Основная часть -->
    <main>
        <section id="product-detail">
            <h2><?php echo $product['name']; ?></h2>
            <div class="product-detail">
                <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="400">
                <div class="product-info">
                    <p><strong>Цена:</strong> <?php echo $product['price']; ?> руб.</p>
                    <p><strong>Описание:</strong> <?php echo $product['description']; ?></p>
                    <p><strong>Характеристики:</strong> <?php echo $product['features']; ?></p>
                    <p><strong>Количество в наличии:</strong> <?php echo $product['stock']; ?></p>
                </div>
            </div>
            <a href="shop.php" class="btn-back">Вернуться в магазин</a>
        </section>
    </main>

    <!-- Футер -->
    <footer>
        <p>Контакты: +7 (123) 456-78-90</p>
        <p>&copy; 2025 Магазин. Все права защищены.</p>
    </footer>
</body>
</html>