<?php declare(strict_types=1);

namespace Fred;


/**
 * Class OrderBase
 * @package Fred
 */
class OrderBase
{
    protected $subtotal= 0;
    protected $salesTaxApplied = 0;
    protected $grandTotal = 0;

    /**
     * OrderBase constructor.
     */
    public function __construct()
    {
        $this->salesTaxApplied = $this->calcTax($this->subtotal);
        $this->grandTotal = $this->subtotal + $this->salesTaxApplied;
    }

    protected function calcTax($subtotal)
    {
        $percentage = 20;
        $taxApplied = (int) (round(($percentage /100) * $subtotal));
        return $taxApplied;
    }

    /**
     * @param float $amount
     * @return string
     */
    protected function currencyFmt(int $amount): string
    {
        return "&pound;" . number_format((float)$amount / 100, 2);
    }

    /**
     * @return string
     */
    public function subtotalCurrency(): string
    {
        return $this->currencyFmt($this->subtotal);
    }

    /**
     * @return string
     */
    public function salesTaxAppliedCurrency(): string
    {
        return $this->currencyFmt($this->salesTaxApplied);
    }

    /**
     * @return string
     */
    public function grandTotalCurrency(): string
    {
        return $this->currencyFmt($this->grandTotal);
    }

    /**
     * @return int
     */
    public function getSubtotal(): int
    {
        return $this->subtotal;
    }

    /**
     * @return int
     */
    public function getSalesTaxApplied(): int
    {
        return $this->salesTaxApplied;
    }

    /**
     * @return int
     */
    public function getGrandTotal(): int
    {
        return $this->grandTotal;
    }


}
