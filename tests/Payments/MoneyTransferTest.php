<?php
declare(strict_types = 1);

namespace Accounting\Tests\Payments;

use Accounting\Enum;
use Accounting\Model;
use Accounting\Payments\MoneyTransfer;
use Accounting\Payments\PaymentHistory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Accounting\Payments\MoneyTransfer
 */
class MoneyTransferTest extends TestCase
{
    public function setUp(): void
    {
        $this->paymentHistory = $this->createMock(
            PaymentHistory::class
        );
    }

    public function testCorrectTransation(): void
    {
        $card = new Model\CreditCardWithConstantCommission(123, true, 7, 10, Enum\Currency::PLN);
        $paymentHistory = new MoneyTransfer($card, $this->paymentHistory);
        $this->paymentHistory
            ->method('getNumberOfPaymentsInCycle')
            ->willReturn(20);
        $this->paymentHistory
            ->expects($this->once())
            ->method('addPayment');
        $this->assertTrue($paymentHistory->makeTransfer(5.50));
    }

    public function testTransactionFailedBecauseOfUnactivePaymentCard(): void
    {
        $card = new Model\CreditCardWithConstantCommission(123, false, 7, 10, Enum\Currency::PLN);
        $paymentHistory = new MoneyTransfer($card, $this->paymentHistory);
        $this->expectException(\Exception::class);
        $this->paymentHistory
            ->expects($this->never())
            ->method('addPayment');
        $paymentHistory->makeTransfer(5.50);
    }

    public function testTransactionFailedBecauseOfLowAccessibleLimit(): void
    {
        $card = new Model\CreditCardWithConstantCommission(123, true, 2.00, 10, Enum\Currency::PLN);
        $paymentHistory = new MoneyTransfer($card, $this->paymentHistory);
        $this->expectException(\Exception::class);
        $this->paymentHistory
            ->expects($this->never())
            ->method('addPayment');
        $paymentHistory->makeTransfer(5.50);
    }

    public function testTransactionFailedBecauseOfHighNumberOfPayouts(): void
    {
        $card = new Model\CreditCardWithConstantCommission(123, true, 22.00, 10, Enum\Currency::PLN);
        $paymentHistory = new MoneyTransfer($card, $this->paymentHistory);
        $this->expectException(\Exception::class);
        $this->paymentHistory
            ->expects($this->never())
            ->method('addPayment');
        $this->paymentHistory
            ->method('getNumberOfPaymentsInCycle')
            ->willReturn(50);
        $paymentHistory->makeTransfer(5.50);
    }
}
