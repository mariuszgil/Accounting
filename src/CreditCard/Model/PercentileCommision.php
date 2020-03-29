<?php
declare(strict_types = 1);

namespace Accounting\CreditCard\Model;

class PercentileCommision implements Commision
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
        $commision = \bcmul(
            (string) $this->cardCommision,
            (string) $money,
            7
        );

        return (float) \bcdiv($commision, '100', 2);
    }
}
