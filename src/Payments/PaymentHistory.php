<?php
declare(strict_types = 1);

namespace Accounting\Payments;

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
     * @param \Accounting\Payments\Model\Withdrawal $withdrawal
     *
     * @return bool
     */
    public function addNewWithdrawal(Model\Withdrawal $withdrawal): bool
    {
        return $this->database->addNewWithdrawal($withdrawal);
    }

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
    ): array {
        return $this->database->getHistory(
            $creditCardId,
            $numberOfPayments,
            $page
        );
    }
}
