<!-- header.php -->
<header>
    <nav>
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="shop.php">Магазин</a></li>
            <li><a href="about.php">О нас</a></li>

            <?php if (isset($_SESSION['username'])): ?>
                <li>Привет, <?= $_SESSION['username']; ?></li>
                <li><a href="logout.php">Выйти</a></li>
            <?php else: ?>
                <li><a href="login.php">Войти</a></li>
                <li><a href="register.php">Регистрация</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>