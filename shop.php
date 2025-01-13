<?php
// Подключение к базе данных и извлечение товаров
include 'db.php';

$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин</title>
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
        <section id="shop">
            <h2>Наши товары</h2>
            <!-- Таблица товаров -->
            <table>
                <thead>
                    <tr>
                        <th>Изображение</th>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Описание</th>
                        <th>Подробнее</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="100"></td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['price']; ?> руб.</td>
                            <td><?php echo substr($product['description'], 0, 50); ?>...</td>
                            <td><a href="product.php?id=<?php echo $product['id']; ?>" class="btn-details">Подробнее</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <!-- Футер -->
    <footer>
        <p>Контакты: +7 (123) 456-78-90</p>
        <p>&copy; 2025 Магазин. Все права защищены.</p>
    </footer>
</body>
</html>