<?php declare(strict_types=1);

namespace Fred;

/**
 * Class OrderLine
 * @package Fred
 */
class OrderLine extends OrderBase
{
    private $orderID = "";
    private $orderDate = "";
    private $itemID = "";
    private $title = "";
    private $description = "";
    private $itemPrice = 0;
    private $quantity = 0;
    /**
     * OrderLine constructor.
     * @param array $orderLine
     */
    public function __construct(array $orderLine)
    {

        $this->orderID = $orderLine['orderID'];
        $this->orderDate = $orderLine['orderDate'];
        $this->itemID = $orderLine['itemID'];
        $this->title = $orderLine['title'];
        $this->description = $orderLine['description'];
        $this->itemPrice = $orderLine['price'];
        $this->quantity = $orderLine['quantity'];

        $this->subtotal = $this->itemPrice * $this->quantity;
        parent::__construct();
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
