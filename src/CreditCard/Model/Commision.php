<?php
declare(strict_types = 1);

namespace Accounting\CreditCard\Model;

interface Commision
{
    /**
     * @param float $money
     *
     * @return float
     */
    public function calculate(float $money): float;
}
