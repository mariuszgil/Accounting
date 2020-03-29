<?php
declare(strict_types = 1);

namespace Accounting\Tests\Payments;

use Accounting\CreditCard;
use Accounting\Payments\MakeTransferService;
use Accounting\Payments\PaymentHistory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Accounting\Payments\MakeTransferService
 */
class MakeTransferServiceTest extends TestCase
{
    public function testMakeTransfer(): void
    {
        $creditCardDatabase = $this->createMock(CreditCard\Database::class);
        $paymentHistory = $this->createMock(PaymentHistory::class);
        $card = $this->createMock(CreditCard\Model\VirtualCreditCard::class);
        $creditCardDatabase
            ->expects($this->once())
            ->method('getCreditCard')
            ->willReturn($card);
        $card
            ->expects($this->once())
            ->method('makeTransfer');
        $creditCardDatabase
            ->expects($this->once())
            ->method('saveCard');
        $paymentHistory
            ->expects($this->once())
            ->method('addNewWithdrawal');
        $service = new MakeTransferService(
            $paymentHistory,
            $creditCardDatabase
        );
        $service->makeTransfer(123, 5.50);
    }
}
