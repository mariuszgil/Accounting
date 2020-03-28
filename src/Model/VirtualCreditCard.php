<?php
declare(strict_types = 1);

namespace Accounting\Model;

abstract class VirtualCreditCard
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var float
     */
    private $accessibleLimit;

    /**
     * @var float
     */
    private $commission;

    /**
     * @var string
     */
    private $currency;

    /**
     * @param int $id
     * @param bool $active
     * @param float $accessibleLimit
     * @param float $commission
     * @param string $currency
     */
    public function __construct(
        int $id,
        bool $active,
        float $accessibleLimit,
        float $commission,
        string $currency
    ) {
        $this->id = $id;
        $this->active = $active;
        $this->accessibleLimit = $accessibleLimit;
        $this->commission = $commission;
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return float
     */
    public function getAccessibleLimit(): float
    {
        return $this->accessibleLimit;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function getCommission(): float
    {
        return $this->commission;
    }
}
