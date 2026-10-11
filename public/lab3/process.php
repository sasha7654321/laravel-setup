<?php
$uploadDir = __DIR__ . '/uploads/';

//uploads
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload_file'])) {
    $file = $_FILES['upload_file'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Помилка завантаження файлу. Код помилки: " . $file['error']);
    }

    if (!is_uploaded_file($file['tmp_name'])) {
        die("Помилка: Файл не був завантажений через форму.");
    }

    $fileName = basename($file['name']);
    $fileSize = $file['size'];
    $fileTmpPath = $file['tmp_name'];

    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExtensions = ['png', 'jpg', 'jpeg'];

    //розширення
    if (!in_array($fileExtension, $allowedExtensions)) {
        die("Помилка: Дозволено завантажувати лише зображення формату PNG, JPG або JPEG.");
    }

    //розмір
    $maxSize = 2 * 1024 * 1024;
    if ($fileSize > $maxSize) {
        die("Помилка: Розмір файлу перевищує 2 МБ.");
    }

    //унікальне ім'я
    $targetPath = $uploadDir . $fileName;
    $finalFileName = $fileName;

    if (file_exists($targetPath)) {
        $filenameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
        //суфікс
        $finalFileName = $filenameWithoutExt . '_' . time() . '.' . $fileExtension;
        $targetPath = $uploadDir . $finalFileName;
        echo "<p style='color: orange;'>Зауваження: Файл з такою назвою вже існував. Назву було змінено на: <strong>{$finalFileName}</strong></p>";
    }

    if (move_uploaded_file($fileTmpPath, $targetPath)) {
        $sizeInKB = round($fileSize / 1024, 2);

        echo "<h2>Файл успішно завантажено!</h2>";
        echo "<ul>";
        echo "<li><strong>Ім'я файлу:</strong> " . htmlspecialchars($finalFileName) . "</li>";
        echo "<li><strong>Тип файлу:</strong> " . htmlspecialchars($fileExtension) . "</li>";
        echo "<li><strong>Розмір файлу:</strong> " . $sizeInKB . " КБ</li>";
        echo "</ul>";

        $downloadUrl = 'uploads/' . urlencode($finalFileName);
        echo "<p><a href='{$downloadUrl}' download>Скачати завантажений файл</a></p>";
        echo "<br><a href='index.html'>Повернутися на головну</a>";
    } else {
        echo "Виникла помилка під час збереження файлу на сервері.";
    }
} else {
    echo "Форма не була відправлена.";
}