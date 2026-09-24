<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item'])) {
    $item = htmlspecialchars(trim($_POST['item']));
    if (!empty($item)) {
        $_SESSION['cart'][] = $item;

        $history = isset($_COOKIE['history_purchases']) ? json_decode($_COOKIE['history_purchases'], true) : [];
        if (!in_array($item, $history)) {
            $history[] = $item;
        }
        setcookie('history_purchases', json_encode($history), time() + (30 * 24 * 60 * 60), '/');
        
        header('Location: index.php');
        exit;
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'clear') {
    $_SESSION['cart'] = [];
    header('Location: index.php');
    exit;
}

$historyPurchases = isset($_COOKIE['history_purchases']) ? json_decode($_COOKIE['history_purchases'], true) : [];

?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 4 - Корзина</title>
</head>
<body>
    <h2>Завдання 4: Корзина покупок</h2>

    <h3>Додати товар:</h3>
    <form method="POST">
        <input type="text" name="item" placeholder="Назва товару" required>
        <button type="submit">Додати в корзину</button>
    </form>

    <h3>Товари в поточній корзині (Сесія):</h3>

    <?php if (!empty($_SESSION['cart'])): ?>
        <ul>
            <?php foreach ($_SESSION['cart'] as $cartItem): ?>
                <li><?= $cartItem ?></li>
            <?php endforeach; ?>
        </ul>
        
        <a href="index.php?action=clear"><button>Очистити корзину</button></a>

    <?php else: ?>
        <p>Корзина порожня.</p>
    <?php endif; ?>

    <hr>
    <h3>Попередні покупки (з Cookie минулих сеансів):</h3>

    <?php if (!empty($historyPurchases)): ?>
        <ul>
            <?php foreach ($historyPurchases as $historyItem): ?>
                <li><?= htmlspecialchars($historyItem) ?></li>
            <?php endforeach; ?>
        </ul>

    <?php else: ?>
        <p>Історія покупок порожня.</p>
    <?php endif; ?>

</body>
</html>