<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $firstName = isset($_POST["first_name"]) ? trim($_POST["first_name"]) : "";
    $lastName = isset($_POST["last_name"]) ? trim($_POST["last_name"]) : "";

    if (empty($firstName) || empty($lastName)) {
        echo "Помилка: Усі поля повинні бути заповнені!";
    } elseif (is_numeric($firstName) || is_numeric($lastName)) {
        echo "Помилка: Ім'я та прізвище не повинні бути числами!";
    } else {
        $safeFirstName = htmlspecialchars($firstName);
        $safeLastName = htmlspecialchars($lastName);
        
        echo "<h1>Привітання!</h1>";
        echo "Ласкаво просимо, " . $safeFirstName . " " . $safeLastName . "!";
    }
} else {
    echo "Будь ласка, відправте форму з сторінки index.html";
}