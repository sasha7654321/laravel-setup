<?php
require_once 'AccountInterface.php';

class BankAccount implements AccountInterface {
    // мінімальний баланс
    const MIN_BALANCE = 0;

    protected $balance;
    protected $currency;

    public function __construct($balance, $currency) {
        $this->balance = $balance;
        $this->currency = $currency;
    }

    // поповнення
    public function deposit($amount) {
        if ($amount <= 0) {
            throw new Exception("Сума поповнення має бути більше нуля");
        }
        $this->balance = $this->balance + $amount;
    }

    // зняття
    public function withdraw($amount) {
        if ($amount <= 0) {
            throw new Exception("Сума зняття має бути більше нуля");
        }
        if ($amount > $this->balance - self::MIN_BALANCE) {
            throw new Exception("Недостатньо коштів");
        }
        $this->balance = $this->balance - $amount;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getCurrency() {
        return $this->currency;
    }
}
