<?php
declare(strict_types = 1);

namespace Accounting\Payments;

use Accounting\Model;

class PaymentHistory
{
    /**
     * @var \Accounting\Payments\PaymentHistory\Database
     */
    private $database;

    /**
     * @param \Accounting\Payments\PaymentHistory\Database $database
     */
    public function __construct(PaymentHistory\Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param \Accounting\Model\VirtualCreditCard $creditCard
     * @param float $money
     *
     * @return bool
     */
    public function addPayment(
        Model\VirtualCreditCard $creditCard,
        float $money
    ): bool {
        $commision = $creditCard->getCommission();

        if ($creditCard instanceof Model\CreditCardWithPercentileCommission) {
            $commision = \bcmul(
                (string) $creditCard->getCommission(),
                (string) $money,
                7
            );
            $commision = (float) \bcdiv($commision, '100', 2);
        }

        return $this->database->addPayment($creditCard, $money, $commision);
    }

    /**
     * @param \Accounting\Model\VirtualCreditCard $creditCard
     *
     * @return int
     */
    public function getNumberOfPaymentsInCycle(
        Model\VirtualCreditCard $creditCard
    ): int {
        return $this->database->getNumberOfPaymentsInCycle($creditCard);
    }

    /**
     * @param int $creditCardId
     * @param int $numberOfPayments
     * @param int $page
     *
     * @return array<int,\Accounting\Model\Transfer>
     */
    public function getHistory(
        int $creditCardId,
        int $numberOfPayments,
        int $page
    ): array {
        return $this->database->getHistory(
            $creditCardId,
            $numberOfPayments,
            $page
        );
    }
}
