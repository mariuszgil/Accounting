<?php
declare(strict_types = 1);

namespace Accounting\Payments\PaymentHistory;

use Accounting\Payments\Model\Withdrawal;

interface Database
{
    /**
     * @param \Accounting\Payments\Model\Withdrawal $withdrawal
     *
     * @return bool
     */
    public function addNewWithdrawal(Withdrawal $withdrawal): bool;

    /**
     * @param int $creditCardId
     * @param int $numberOfPayments
     * @param int $page
     *
     * @return array<int,\Accounting\Payments\Model\Withdrawal>
     */
    public function getHistory(
        int $creditCardId,
        int $numberOfPayments,
        int $page
    ): array;
}
