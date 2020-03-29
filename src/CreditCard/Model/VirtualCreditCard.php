<?php
declare(strict_types = 1);

namespace Accounting\CreditCard\Model;

class VirtualCreditCard
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var float
     */
    private $availableLimit;

    /**
     * @var int
     */
    private $transfersInCycle;

    /**
     * @var \Accounting\CreditCard\Model\Commision
     */
    private $commision;

    /**
     * @param int $id
     * @param bool $active
     * @param float $availableLimit
     * @param int $transfersInCycle
     * @param \Accounting\CreditCard\Model\Commision $commision
     */
    public function __construct(
        int $id,
        bool $active,
        float $availableLimit,
        int $transfersInCycle,
        Commision $commision
    ) {
        $this->id = $id;
        $this->active = $active;
        $this->availableLimit = $availableLimit;
        $this->transfersInCycle = $transfersInCycle;
        $this->commision = $commision;
    }

    /**
     * @param float $money
     *
     * @return float
     */
    public function calculateCommision(float $money): float
    {
        return $this->commision->calculate($money);
    }

    /**
     * @param float $money
     *
     * @throws \Exception
     */
    public function makeTransfer(float $money)
    {
        $this->checkIfCreditCardIsActive();
        $this->checkAvailableMoneyLimit($money);
        $this->checkNumberOfTransfersInCycle();
        $this->availableLimit = (float) $this->substractFromAvailableLimit(
            $money
        );
        $this->transfersInCycle++;
    }

    /**
     * @return float
     */
    public function availableLimit(): float
    {
        return $this->availableLimit;
    }

    private function checkIfCreditCardIsActive(): void
    {
        if (!$this->active) {
            throw new \Exception("Credit card is unactive");
        }
    }

    private function checkAvailableMoneyLimit(float $money): void
    {
        $substractResult = $this->substractFromAvailableLimit($money);

        if (\bccomp($substractResult, '0') == -1) {
            throw new \Exception("You do not have enough money");
        }
    }

    private function substractFromAvailableLimit(float $money): string
    {
        return \bcsub(
            (string) $this->availableLimit,
            (string) $money,
            2
        );
    }

    private function checkNumberOfTransfersInCycle(): void
    {
        if ($this->transfersInCycle >= 45) {
            throw new \Exception("You have reached the limit of number of payments");
        }
    }
}
