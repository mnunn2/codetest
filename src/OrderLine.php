<?php declare(strict_types=1);

namespace Fred;

/**
 * Class OrderLine
 * @package Fred
 */
class OrderLine
{
    private $orderID = "";
    private $orderDate = "";
    private $itemID = "";
    private $title = "";
    private $description = "";
    private $itemPrice = 0;
    private $quantity = 0;
    private $subtotal = 0;
    private $salesTaxApplied = 0;
    private $grandTotal = 0;

    /**
     * OrderLine constructor.
     * @param array $orderLine
     */
    public function __construct(array $orderLine)
    {
        $salesTaxPercentage = 20; // suggest get from config

        $this->orderID = $orderLine['orderID'];
        $this->orderDate = $orderLine['orderDate'];
        $this->itemID = $orderLine['itemID'];
        $this->title = $orderLine['title'];
        $this->description = $orderLine['description'];
        $this->itemPrice = $orderLine['price'];
        $this->quantity = $orderLine['quantity'];

        $this->subtotal = $this->itemPrice * $this->quantity;
        $this->salesTaxApplied = (int) (($salesTaxPercentage /100) * $this->subtotal);
        $this->grandTotal = $this->subtotal + $this->salesTaxApplied;
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

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return string
     */
    public function getOrderID(): string
    {
        return $this->orderID;
    }

    /**
     * @return string
     */
    public function getOrderDate(): string
    {
        return $this->orderDate;
    }

    /**
     * @return string
     */
    public function getItemID(): string
    {
        return $this->itemID;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getItemPrice(): int
    {
        return $this->itemPrice;
    }
}
