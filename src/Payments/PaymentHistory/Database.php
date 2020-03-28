<?php
declare(strict_types = 1);

namespace Accounting\Payments\PaymentHistory;

use Accounting\Model\VirtualCreditCard;

interface Database
{
    /**
     * @param \Accounting\Model\VirtualCreditCard $creditCard
     * @param float $money
     * @param float $commision
     *
     * @return bool
     */
    public function addPayment(
        VirtualCreditCard $creditCard,
        float $money,
        float $commision
    ): bool;

    /**
     * @param \Accounting\Model\VirtualCreditCard $creditCard
     * @param int|null $cycle
     *
     * @return int
     */
    public function getNumberOfPaymentsInCycle(
        VirtualCreditCard $creditCard,
        int $cycle = null
    ): int;

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
    ): array;
}
