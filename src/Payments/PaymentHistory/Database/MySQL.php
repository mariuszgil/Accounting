<?php
declare(strict_types = 1);

namespace Accounting\Payments\PaymentHistory\Database;

use Accounting\Payments\PaymentHistory\Database;
use Accounting\Payments\Model\Withdrawal;

class MySQL implements Database
{
    public function addNewWithdrawal(Withdrawal $withdrawal): bool
    {
        //...

        return true;
    }

    public function getHistory(
        int $creditCardId,
        int $numberOfPayments,
        int $page
    ): array {
        //...

        return [
            new Withdrawal($creditCardId, new \DateTime(), rand(10, 1000), 10),
            new Withdrawal($creditCardId, new \DateTime(), rand(10, 1500), 15),
            new Withdrawal($creditCardId, new \DateTime(), rand(10, 700), 7)
        ];
    }
}
