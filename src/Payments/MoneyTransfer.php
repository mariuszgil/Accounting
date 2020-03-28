<?php
declare(strict_types = 1);

namespace Accounting\Payments;

use Accounting\Model;

class MoneyTransfer
{
    /**
     * @var \Accounting\Model\VirtualCreditCard
     */
    private $creditCard;

    /**
     * @var \Accounting\Payments\PaymentHistory
     */
    private $paymentHistory;

    /**
     * @param \Accounting\Model\VirtualCreditCard $creditCard
     * @param \Accounting\Payments\PaymentHistory $paymentHistory
     */
    public function __construct(
        Model\VirtualCreditCard $creditCard,
        PaymentHistory $paymentHistory
    ) {
        $this->creditCard = $creditCard;
        $this->paymentHistory = $paymentHistory;
    }

    /**
     * @param float $money
     *
     * @return bool
     */
    public function makeTransfer(float $money): bool
    {
        $this->checkIfCreditCardIsActive();
        $this->checkAccessibleMoneyLimit($money);
        $this->checkNumberOfPaymentsInCycle();
        $this->paymentHistory->addPayment($this->creditCard, $money);

        return true;
    }

    private function checkIfCreditCardIsActive(): void
    {
        if (!$this->creditCard->isActive()) {
            throw new \Exception("Credit card is unactive");
        }
    }

    private function checkAccessibleMoneyLimit(float $money): void
    {
        $substractResult = \bcsub(
            (string) $this->creditCard->getAccessibleLimit(),
            (string) $money,
            2
        );

        if (\bccomp($substractResult, '0') == -1) {
            throw new \Exception("You do not have enough money");
        }
    }

    private function checkNumberOfPaymentsInCycle(): void
    {
        $numberOfPayments = $this->paymentHistory->getNumberOfPaymentsInCycle(
            $this->creditCard
        );

        if ($numberOfPayments >= 45) {
            throw new \Exception("You have reached the limit of number of payments");
        }
    }
}
