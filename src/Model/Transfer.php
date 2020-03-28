<?php
declare(strict_types = 1);

namespace Accounting\Model;

class Transfer
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

    /**
     * @return int
     */
    public function getCardId(): int
    {
        return $this->cardId;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @return float
     */
    public function getMoney(): float
    {
        return $this->money;
    }

    /**
     * @return float
     */
    public function getCommission(): float
    {
        return $this->commission;
    }
}
