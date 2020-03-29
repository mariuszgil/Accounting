<?php
declare(strict_types = 1);

namespace Accounting\Payments;

use Accounting\CreditCard;

class MakeTransferService
{
    /**
     * @var \Accounting\Payments\PaymentHistory
     */
    private $paymentHistory;

    /**
     * @var \Accounting\CreditCard\Database
     */
    private $creditCardDatabase;

    /**
     * @param \Accounting\Payments\PaymentHistory $paymentHistory
     * @param \Accounting\CreditCard\Database $creditCardDatabase
     */
    public function __construct(
        PaymentHistory $paymentHistory,
        CreditCard\Database $creditCardDatabase
    ) {
        $this->creditCardDatabase = $creditCardDatabase;
        $this->paymentHistory = $paymentHistory;
    }

    /**
     * @param int $idCard
     * @param float $money
     */
    public function makeTransfer(int $idCard, float $money): void
    {
        $card = $this->creditCardDatabase->getCreditCard($idCard);
        $card->makeTransfer($money);
        $this->creditCardDatabase->saveCard($card);
        $this->paymentHistory->addNewWithdrawal(
            new Model\Withdrawal(
                $idCard,
                new \DateTime(),
                $money,
                $card->calculateCommision($money)
            )
        );
    }
}
