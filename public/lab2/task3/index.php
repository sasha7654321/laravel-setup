<?php

if (isset($_GET['check_redirect']) && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: https://google.com');
    exit;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 3 - Server</title>
</head>
<body>
    <h2>Завдання 3: $_SERVER</h2>

    <ul>
        <li><strong>IP-адреса клієнта:</strong> <?= $_SERVER['REMOTE_ADDR'] ?? 'Невизначено' ?></li>
        <li><strong>Назва та версія браузера (User-Agent):</strong> <?= $_SERVER['HTTP_USER_AGENT'] ?? 'Невизначено' ?></li>
        <li><strong>Назва скрипта (PHP_SELF):</strong> <?= $_SERVER['PHP_SELF'] ?></li>
        <li><strong>Метод запиту:</strong> <?= $_SERVER['REQUEST_METHOD'] ?></li>
        <li><strong>Шлях до файлу на сервері:</strong> <?= $_SERVER['SCRIPT_FILENAME'] ?></li>
    </ul>

    <hr>
    <h3>Перевірка перенаправлення:</h3>
    <p>Поточний метод: <strong><?= $_SERVER['REQUEST_METHOD'] ?></strong></p>

    <form method="POST" action="index.php">
        <button type="submit">Надіслати POST-запит (перенаправлення НЕ буде)</button>
    </form>
    <br>

    <a href="index.php?check_redirect=1">Симулювати GET-запит із перевіркою (перенаправить на Google)</a>
</body>
</html>