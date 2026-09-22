<?php

// Завдання 1. Створення базового PHP-скрипта
echo "Hello, World!<br><br>";

// Завдання 2. Змінні та типи даних
$stringVar = "Привіт, світ!";
$intVar = 42;
$floatVar = 3.14;
$boolVar = true;

echo "Рядок: " . $stringVar . "<br>";
echo "Ціле число: " . $intVar . "<br>";
echo "Дійсне число: " . $floatVar . "<br>";
echo "Булеве значення: " . ($boolVar ? 'true' : 'false') . "<br><br>";

// Виводимо типи змінних за допомогою var_dump
echo "Дані про типи змінних (var_dump):<br>";
var_dump($stringVar);
echo "<br>";
var_dump($intVar);
echo "<br>";
var_dump($floatVar);
echo "<br>";
var_dump($boolVar);
echo "<br><br>";

// Завдання 3. Конкатенація рядків
$firstName = "Олександр";
$lastName = "Ігнатьєв";

$fullName = $firstName . " " . $lastName;
echo "Результат конкатенації: " . $fullName . "<br><br>";

// Завдання 4. Умовні конструкції
$number = 15;

if ($number % 2 === 0) {
    echo "Число $number є парним.<br><br>";
} else {
    echo "Число $number є непарним.<br><br>";
}

// Завдання 5. Цикли
echo "Числа від 1 до 10 (цикл for): ";
for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}
echo "<br>";

echo "Числа від 10 до 1 (цикл while): ";
$j = 10;
while ($j >= 1) {
    echo $j . " ";
    $j--;
}
echo "<br><br>";

// Завдання 6. Масиви
$student = [
    "first_name" => "Олександр",
    "last_name" => "Ігнатьєв",
    "age" => 19,
    "specialty" => "Комп'ютерні науки"
];

echo "Інформація про студента:<br>";
echo "Ім'я: " . $student["first_name"] . "<br>";
echo "Прізвище: " . $student["last_name"] . "<br>";
echo "Вік: " . $student["age"] . "<br>";
echo "Спеціальність: " . $student["specialty"] . "<br>";

$student["average_grade"] = 4.8;

echo "<br>Оновлений масив студента:<br><pre>";
print_r($student);
echo "</pre>";