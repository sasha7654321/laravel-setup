<?php
$logFile = __DIR__ . '/log.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['log_text'])) {
    $text = trim($_POST['log_text']);

    if (!empty($text)) {
        //дата час 
        $entry = "[" . date('Y-m-d H:i:s') . "] " . $text . PHP_EOL;
        
        file_put_contents($logFile, $entry, FILE_APPEND);
        echo "<p style='color: green;'>Текст успішно записано у log.txt!</p>";
    }
}

//читання
$logContent = file_exists($logFile) ? file_get_contents($logFile) : "Файл log.txt поки порожній або ще не створений.";
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Вміст log.txt</title>
</head>
<body>
    <h2>Вміст файлу log.txt:</h2>
    <pre style="background: #f4f4f4; padding: 10px; border: 1px solid #ccc;"><?= htmlspecialchars($logContent) ?></pre>

    <br>
    <a href="index.html">Повернутися до форм</a>
</body>
</html>