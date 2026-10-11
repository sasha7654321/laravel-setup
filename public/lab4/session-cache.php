<?php
session_start();

$source = '';
$data = [];
$cacheLifetime = 600;

function generateData() {
    sleep(2);
    return ['usd' => rand(35, 40), 'eur' => rand(38, 43)];
}

if (isset($_SESSION['cached_data']) && isset($_SESSION['cached_time'])) {
    $age = time() - $_SESSION['cached_time'];
    if ($age < $cacheLifetime) {
        $data = $_SESSION['cached_data'];
        $source = "кешу сесії (миттєво)";
    } else {
        $data = generateData();
        $_SESSION['cached_data'] = $data;
        $_SESSION['cached_time'] = time();
        $source = "оновлено кеш (минуло більше 10 хвилин)";
    }
} else {
    $data = generateData();
    $_SESSION['cached_data'] = $data;
    $_SESSION['cached_time'] = time();
    $source = "створено новий кеш (перший запуск)";
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Кешування через сесію</title>
</head>
<body>
    <h1>Серверне кешування через PHP-сесію</h1>
    <p>Дані: <?= json_encode($data) ?></p>
    <p>Джерело: <?= $source ?></p>
    <br>
    <a href="index.html">Назад до меню</a>
</body>
</html>