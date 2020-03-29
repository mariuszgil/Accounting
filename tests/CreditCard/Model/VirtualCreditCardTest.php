<?php
declare(strict_types = 1);

namespace Accounting\Tests\CreditCard\Model;

use Accounting\CreditCard\Model;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Accounting\CreditCard\Model\VirtualCreditCard
 */
class VirtualCreditCardTest extends TestCase
{
    public function testCorrectTransation(): void
    {
        $virtualCard = new Model\VirtualCreditCard(
            123,
            true,
            50,
            2,
            new Model\ConstantCommision(5)
        );
        $virtualCard->makeTransfer(5.50);

        $this->assertSame(44.50, $virtualCard->availableLimit());
    }

    public function testTransactionFailedBecauseOfUnactivePaymentCard(): void
    {
        $this->expectException(\Exception::class);
        $virtualCard = new Model\VirtualCreditCard(
            123,
            false,
            50,
            2,
            new Model\ConstantCommision(5)
        );
        $virtualCard->makeTransfer(5.50);
    }

    public function testTransactionFailedBecauseOfLowAccessibleLimit(): void
    {
        $this->expectException(\Exception::class);
        $virtualCard = new Model\VirtualCreditCard(
            123,
            true,
            2,
            2,
            new Model\ConstantCommision(5)
        );
        $virtualCard->makeTransfer(5.50);
    }

    public function testTransactionFailedBecauseOfHighNumberOfPayouts(): void
    {
        $this->expectException(\Exception::class);
        $virtualCard = new Model\VirtualCreditCard(
            123,
            true,
            2,
            50,
            new Model\ConstantCommision(5)
        );
        $virtualCard->makeTransfer(5.50);
    }

    public function testCalculateConstantCommission(): void
    {
        $virtualCard = new Model\VirtualCreditCard(
            123,
            true,
            7,
            7,
            new Model\ConstantCommision(4)
        );
        $this->assertSame(
            4.0,
            $virtualCard->calculateCommision(74)
        );
    }

    public function testCalculatePercentileCommission(): void
    {
        $virtualCard = new Model\VirtualCreditCard(
            123,
            true,
            7,
            7,
            new Model\PercentileCommision(4)
        );
        $this->assertSame(
            2.96,
            $virtualCard->calculateCommision(74)
        );
    }
}
