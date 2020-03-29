<?php
declare(strict_types = 1);

namespace Accounting\CreditCard\Model;

class ConstantCommision implements Commision
{
    /**
     * @var float
     */
    private $cardCommision;

    /**
     * @param float $cardCommision
     */
    public function __construct(float $cardCommision)
    {
        $this->cardCommision = $cardCommision;
    }

    /**
     * @param float $money
     *
     * @return float
     */
    public function calculate(float $money): float
    {
        return $this->cardCommision;
    }
}
