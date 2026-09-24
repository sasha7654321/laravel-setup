<?php
session_start();

$timeout = 300;
$message = '';

if (isset($_GET['simulate_timeout'])) {
    $_SESSION['last_activity'] = time() - 301;
}

if (isset($_SESSION['last_activity'])) {
    $inactiveTime = time() - $_SESSION['last_activity'];

    if ($inactiveTime > $timeout) {
        session_unset();
        session_destroy();
        $message = "Ваша сесія була автоматично завершена через неактивність понад 5 хвилин.";
    } else {
        $message = "Сесія активна. Останній візит був " . $inactiveTime . " сек. тому.";
    }
} else {
    $message = "Сесію розпочато.";
}

if (session_status() === PHP_SESSION_ACTIVE && empty($_GET['simulate_timeout'])) {
    $_SESSION['last_activity'] = time();
}

?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 5 - Час активності сесії</title>
</head>
<body>
    <h2>Завдання 5: Автоматичне завершення сесії</h2>

    <p><strong>Статус:</strong> <?= $message ?></p>

    <a href="index.php"><button>Оновити сторінку</button></a>
    <br><br>
    
    <a href="index.php?simulate_timeout=1"><button style="color: red;">Симулювати неактивність 5 хвилин</button></a>
</body>
</html>