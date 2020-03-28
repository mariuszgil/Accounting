<?php
declare(strict_types = 1);

namespace Accounting\Tests\Payments;

use Accounting\Enum;
use Accounting\Model;
use Accounting\Payments\PaymentHistory;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Accounting\Payments\PaymentHistory
 */
class PaymentHistoryTest extends TestCase
{
    public function setUp(): void
    {
        $this->database = $this->createMock(
            PaymentHistory\Database::class
        );
        $this->paymentHistory = new PaymentHistory($this->database);
    }

    public function testAddingPaymentToHistoryWithConstantCommission(): void
    {
        $creditCard = new Model\CreditCardWithConstantCommission(
            123,
            true,
            7,
            7,
            Enum\Currency::PLN
        );
        $this->database
            ->expects($this->once())
            ->method('addPayment')
            ->with($creditCard, 1000, 7);
        $this->paymentHistory->addPayment($creditCard, 1000);
    }

    public function testAddingPaymentToHistoryWithPercentileCommission(): void
    {
        $creditCard = new Model\CreditCardWithPercentileCommission(
            123,
            true,
            7,
            7,
            Enum\Currency::PLN
        );
        $this->database
            ->expects($this->once())
            ->method('addPayment')
            ->with($creditCard, 1000, 70);
        $this->paymentHistory->addPayment($creditCard, 1000);
    }
}
