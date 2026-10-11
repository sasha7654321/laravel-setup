<?php
class DataCache {
    private static ?array $cache = null;
    private static ?int $cacheTime = null;
    private static int $ttl = 30;

    public static function getData(): array {
        if (self::$cache !== null && self::$cacheTime !== null && (time() - self::$cacheTime < self::$ttl)) {
            return [
                'data' => self::$cache,
                'source' => 'Статична властивість класу (кеш)'
            ];
        }

        // Симуляція обчислень
        sleep(2);
        self::$cache = [
            'status' => 'успішно',
            'items' => ['Процесор', 'Відеокарта', 'Оперативна пам\'ять'],
            'timestamp' => date('H:i:s')
        ];
        self::$cacheTime = time();

        return [
            'data' => self::$cache,
            'source' => 'Згенеровано заново в класі (затримка 2 сек)'
        ];
    }
}

//1 виклик з затримкою
$start1 = microtime(true);
$first = DataCache::getData();
$time1 = round(microtime(true) - $start1, 3);

// 2 виклик з кешу
$start2 = microtime(true);
$second = DataCache::getData();
$time2 = round(microtime(true) - $start2, 3);


?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Кешування через клас</title>
</head>
<body>
    <h1>Серверне кешування через статичну властивість класу</h1>

    <h2>Перший виклик</h2>
    <p><strong>Джерело:</strong> <?= $first['source'] ?></p>
    <p><strong>Час виконання:</strong> <?= $time1 ?> с</p>
    <pre><?= print_r($first['data'], true) ?></pre>

    <h2>Другий виклик (у тому ж запиті)</h2>
    <p><strong>Джерело:</strong> <?= $second['source'] ?></p>
    <p><strong>Час виконання:</strong> <?= $time2 ?> с</p>
    <pre><?= print_r($second['data'], true) ?></pre>

    <br>
    <a href="index.html">Назад до меню</a>
</body>
</html>