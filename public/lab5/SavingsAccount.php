<?php
require_once 'BankAccount.php';

class SavingsAccount extends BankAccount {
    // відсоткова ставка (у %)
    public static $interestRate = 5;

    // нарахування відсотків
    public function applyInterest() {
        $interest = $this->balance * self::$interestRate / 100;
        $this->balance = $this->balance + $interest;
    }
}
