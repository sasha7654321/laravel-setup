<?php
$seconds = 86400;
$expiresTime = gmdate("D, d M Y H:i:s", time() + $seconds) . " GMT";

header("Cache-Control: public, max-age=" . $seconds);
header("Expires: " . $expiresTime);
header("Content-Type: text/html; charset=utf-8");


?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Клієнтське кешування</title>
</head>
<body>
    <h1>Клієнтське кешування через HTTP-заголовки</h1>
    <p>Поточний час на сервері: <strong><?= date('Y-m-d H:i:s') ?></strong></p>
    <p>Ця сторінка кешується браузером на 1 день (Cache-Control та Expires).</p>
    <p>Спробуйте перейти на сторінку повторно та перевірте вкладку <strong> Network </strong> (стовпчик Size покаже (disk cache))</p>
    <br>
    <a href="index.html">Назад до меню</a>
</body>
</html>