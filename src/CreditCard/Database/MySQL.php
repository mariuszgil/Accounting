<?php
declare(strict_types = 1);

namespace Accounting\CreditCard\Database;

use Accounting\CreditCard\Database;
use Accounting\CreditCard\Model;

class MySQL implements Database
{
    public function getCreditCard(int $id): Model\VirtualCreditCard
    {
        // ...

        return new Model\VirtualCreditCard(
            123,
            true,
            12345.50,
            12,
            new Model\ConstantCommision(5)
        );
    }

    public function saveCard(Model\VirtualCreditCard $creditCard): bool
    {
        // ....

        return true;
    }
}
