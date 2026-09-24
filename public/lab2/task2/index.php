<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($login === 'admin' && $password === '12345') {
        $_SESSION['user'] = $login;
        header('Location: index.php');
        exit;
    } else {
        $error = 'Невірний логін або пароль! (Спробуйте admin / 12345)';
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 2 - Session</title>
</head>
<body>
    <h2>Завдання 2: $_SESSION</h2>

    <?php if (isset($_SESSION['user'])): ?>
        <h3>Вітаємо, <?= htmlspecialchars($_SESSION['user']) ?>! Ви успішно увійшли.</h3>
        <a href="index.php?action=logout"><button>Вихід</button></a>

    <?php else: ?>
        <?php if ($error): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>Логін:</label><br>
            <input type="text" name="login" required><br><br>
            <label>Пароль:</label><br>
            <input type="password" name="password" required><br><br>
            <button type="submit">Увійти</button>
        </form>

    <?php endif; ?>
</body>
</html>