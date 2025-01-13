
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Шапка -->
    <header>
        <nav>
            <!-- Логотип -->
        <a href="index.php" class="logo">
            <img src="images/logo.jpeg" alt="Логотип" height="50">
        </a>
            <ul>
                <li><a href="index.php">Главная</a></li>
            <li><a href="shop.php">Магазин</a></li>
            <li><a href="about.php">О нас</a></li>
            
            <?php if ($isLoggedIn): ?>
                <!-- Если пользователь авторизован, показываем кнопку Выйти -->
                <li><a href="logout.php">Выйти</a></li>
            <?php else: ?>
                <!-- Если пользователь не авторизован, показываем кнопку Войти -->
                <li><a href="login.php">Войти</a></li>
                <li><a href="register.php">Регистрация</a></li>
            <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- Основная часть -->
    <main>
        <section id="home">
            <h1>Добро пожаловать в наш магазин</h1>
            <p>Здесь вы найдете лучшие товары для дома.</p>
            <h2>Обзор продукции</h2>
            <p>Мы предлагаем разнообразные товары для улучшения вашего комфорта.</p>
        </section>

        <!-- Слайд-шоу -->
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/slide1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/slide2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/slide3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <section id="shop">
            <h2>Наши товары</h2>
            <div class="products">
                <?php include 'products.php'; ?>
                <?php foreach ($products as $product): ?>
                    <div class="product">
                        <h3><?php echo $product['name']; ?></h3>
                        <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <p><?php echo $product['description']; ?></p>
                        <p>Цена: <?php echo $product['price']; ?> руб.</p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <!-- Футер -->
    <footer>
        <p>Контакты: +7 (123) 456-78-90</p>
        <p>&copy; 2025 Магазин. Все права защищены.</p>
    </footer>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>