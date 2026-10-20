<?php
require_once 'BankAccount.php';
require_once 'SavingsAccount.php';
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Лабораторна робота №5</title>
</head>
<body>
    <h1>Лабораторна робота №5: Банківські рахунки</h1>

<?php

// рахунок
echo "<h2>Звичайний рахунок (BankAccount)</h2>";
$account = new BankAccount(1000, "USD");
echo "Початковий баланс: " . $account->getBalance() . " " . $account->getCurrency() . "<br>";

// поповнення
try {
    $account->deposit(500);
    echo "Поповнили на 500. Баланс: " . $account->getBalance() . "<br>";
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "<br>";
}

// зняття
try {
    $account->withdraw(300);
    echo "Зняли 300. Баланс: " . $account->getBalance() . "<br>";
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "<br>";
}

// зняття більше ніж є
try {
    $account->withdraw(5000);
    echo "Зняли 5000. Баланс: " . $account->getBalance() . "<br>";
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "<br>";
}

// від'ємна сума при поповненні
try {
    $account->deposit(-100);
    echo "Поповнили на -100<br>";
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "<br>";
}

// від'ємна сума при знятті
try {
    $account->withdraw(-50);
    echo "Зняли -50<br>";
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "<br>";
}

echo "Кінцевий баланс: " . $account->getBalance() . " " . $account->getCurrency() . "<br>";

// Накопичувальний рахунок 
echo "<h2>Накопичувальний рахунок (SavingsAccount)</h2>";
$savings = new SavingsAccount(2000, "EUR");
echo "Початковий баланс: " . $savings->getBalance() . " " . $savings->getCurrency() . "<br>";
echo "Відсоткова ставка: " . SavingsAccount::$interestRate . "%<br>";

try {
    $savings->deposit(1000);
    echo "Поповнили на 1000. Баланс: " . $savings->getBalance() . "<br>";

    $savings->applyInterest();
    echo "Нарахували відсотки. Баланс: " . $savings->getBalance() . "<br>";

    $savings->withdraw(500);
    echo "Зняли 500. Баланс: " . $savings->getBalance() . "<br>";

    // помилка
    $savings->withdraw(10000);
    echo "Зняли 10000. Баланс: " . $savings->getBalance() . "<br>";
} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "<br>";
}

// змінюємо ставку (статична властивість) і нараховуємо ще раз
SavingsAccount::$interestRate = 10;
echo "Нова відсоткова ставка: " . SavingsAccount::$interestRate . "%<br>";
$savings->applyInterest();
echo "Нарахували відсотки. Баланс: " . $savings->getBalance() . " " . $savings->getCurrency() . "<br>";

// мінімальний баланс
echo "<br>Мінімальний баланс рахунку: " . BankAccount::MIN_BALANCE;
?>

</body>
</html>
