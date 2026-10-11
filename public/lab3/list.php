<?php
$uploadDir = __DIR__ . '/uploads/';
$files = [];

if (file_exists($uploadDir) && is_dir($uploadDir)) {
    $scannedFiles = scandir($uploadDir);
    $files = array_diff($scannedFiles, ['.', '..']);
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Список файлів у uploads</title>
</head>
<body>
    <h2>Список завантажених файлів (папка uploads)</h2>

    <?php if (!empty($files)): ?>
        <ul>
            <?php foreach ($files as $file): ?>
                <li>
                    <?= htmlspecialchars($file) ?> 
                    — <a href="uploads/<?= urlencode($file) ?>" download>Завантажити</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Папка uploads порожня.</p>
    <?php endif; ?>

    <br>
    <a href="index.html">Повернутися на головну</a>
</body>
</html>