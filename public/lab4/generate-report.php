<?php
$cacheFile = __DIR__ . '/cache/report.html';
$cacheTime = 10 * 60;

$source = '';

if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheTime)) {
    $htmlContent = file_get_contents($cacheFile);
    $source = "Взято з файлового кешу (без затримки)";
} else {
    sleep(3); 

    ob_start();

    ?>
    <!DOCTYPE html>
    <html lang="uk">
    <head>
        <meta charset="UTF-8">
        <title>Великий звіт</title>
        <style>
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #ccc; padding: 5px; text-align: left; }
        </style>
    </head>
    <body>
        <h1>Згенерований звіт (1000 рядків)</h1>
        <table>
            <tr><th>ID</th><th>Ім'я</th><th>Сума</th><th>Дата</th></tr>
            <?php for ($i = 1; $i <= 1000; $i++): ?>
                <tr>
                    <td><?= $i ?></td>
                    <td>Користувач <?= $i ?></td>
                    <td><?= rand(100, 5000) ?> грн</td>
                    <td><?= date('Y-m-d', time() - rand(0, 1000000)) ?></td>
                </tr>
            <?php endfor; ?>
        </table>
    </body>
    </html>
    <?php
    $htmlContent = ob_get_clean();

    //папкa cache
    if (!file_exists(__DIR__ . '/cache')) {
        mkdir(__DIR__ . '/cache', 0777, true);
    }

    //файл-кеш
    file_put_contents($cacheFile, $htmlContent);
    $source = "Згенеровано заново (з затримкою 3 сек) та записано у файл кешу";
}


?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Серверне кешування у файл</title>
</head>
<body>
    <p><strong>Джерело даних:</strong> <?= $source ?></p>
    <hr>
    <?= $htmlContent ?>
    <br><br>
    <a href="index.html">Назад до меню</a>
</body>
</html>