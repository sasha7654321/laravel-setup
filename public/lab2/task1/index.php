<?php

if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    setcookie('user_name', '', time() - 3600, '/');
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['username'])) {
    $name = htmlspecialchars(trim($_POST['username']));
    setcookie('user_name', $name, time() + (7 * 24 * 60 * 60), '/');
    header('Location: index.php');
    exit;
}

$savedName = $_COOKIE['user_name'] ?? null;
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 1 - Cookie</title>
</head>
<body>
    <h2>Завдання 1: $_COOKIE</h2>

    <?php if ($savedName): ?>
        <h3>Ласкаво просимо назад, <?= $savedName ?>!</h3>
        <form method="POST">
            <input type="hidden" name="action" value="delete">
            <button type="submit">Видалити cookie</button>
        </form>

    <?php else: ?>
        <form method="POST">
            <label for="username">Введіть ваше ім'я:</label><br>
            <input type="text" id="username" name="username" required>
            <button type="submit">Зберегти</button>
        </form>

    <?php endif; ?>

</body>
</html>