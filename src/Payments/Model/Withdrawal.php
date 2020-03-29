<?php
declare(strict_types = 1);

namespace Accounting\Payments\Model;

class Withdrawal
{
    /**
     * @var int
     */
    private $cardId;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var float
     */
    private $money;

    /**
     * @var float
     */
    private $commission;

    /**
     * @param int $cardId
     * @param \DateTime $date
     * @param float $money
     * @param float $commission
     */
    public function __construct(
        int $cardId,
        \DateTime $date,
        float $money,
        float $commission
    ) {
        $this->cardId = $cardId;
        $this->date = $date;
        $this->money = $money;
        $this->commission = $commission;
    }
}
