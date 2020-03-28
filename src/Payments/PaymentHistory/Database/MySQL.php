<?php
declare(strict_types = 1);

namespace Accounting\Payments\PaymentHistory\Database;

use Accounting\Model\Transfer;
use Accounting\Model\VirtualCreditCard;
use Accounting\Payments\PaymentHistory\Database;

class MySQL implements Database
{
    public function addPayment(
        VirtualCreditCard $creditCard,
        float $money,
        float $commision
    ): bool {
        //...
        return true;
    }

    public function getNumberOfPaymentsInCycle(
        VirtualCreditCard $creditCard,
        int $cycle = null
    ): int {
        //...

        return rand(0, 50);
    }

    public function getHistory(
        int $creditCardId,
        int $numberOfPayments,
        int $page
    ): array {
        //...

        return [
            new Transfer($creditCardId, new \DateTime(), rand(10, 1000), 10),
            new Transfer($creditCardId, new \DateTime(), rand(10, 1500), 15),
            new Transfer($creditCardId, new \DateTime(), rand(10, 700), 7)
        ];
    }
}
