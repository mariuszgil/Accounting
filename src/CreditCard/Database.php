<?php
declare(strict_types = 1);

namespace Accounting\CreditCard;

use Accounting\CreditCard\Model\VirtualCreditCard;

interface Database
{
    /**
     * @param int $id
     *
     * @return \Accounting\CreditCard\Model\VirtualCreditCard
     */
    public function getCreditCard(int $id): VirtualCreditCard;

    /**
     * @param \Accounting\CreditCard\Model\VirtualCreditCard $creditCard
     *
     * @return bool
     */
    public function saveCard(VirtualCreditCard $creditCard): bool;
}
