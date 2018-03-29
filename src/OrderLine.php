<?php declare(strict_types=1);

namespace Fred;

class OrderLine
{
    public $orderID = "";
    public $orderDate = "";
    public $itemID = "";
    public $title = "";
    public $description = "";
    public $itemPrice = 0;
    public $quantity = 0;
    public $subtotal = 0;
    public $salesTaxApplied = 0;
    public $grandTotal = 0;

    public function __construct(array $orderLine)
    {
        $salesTaxPercentage = 20; // sugest get from config

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
}
