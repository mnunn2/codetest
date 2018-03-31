<?php declare(strict_types=1);

namespace Fred;

/**
 * Class Order
 * @package Fred
 */
class Order
{
    private $orderID = "";
    private $customerID = "";
    private $dateOrderPlaced = "";
    private $subtotalForItems = 0;
    private $salesTaxForItems = 0;
    private $grandTotalForItems = 0;
    private $orderLines = []; //array of order line objects

    /**
     * Order constructor.
     * @param string $orderID
     * @throws \Exception
     */
    public function __construct(string $orderID)
    {
        $orderIDMatchPattern = '/^[a-zA-Z]{3}-[0-9]{5}$/';
        $salesTaxPercentage = 20; // suggest get from config

        if (preg_match($orderIDMatchPattern, $orderID)) {
            $this->orderID = $orderID;
            $this->setOrderLines();
        } else {
            // suggest could be custom Exception matched in tests
            throw new \Exception("Invalid order number");
        }

        $this->setOrderDate();
        $this->setSubtotalForItems();
        $this->salesTaxForItems = (int) (($salesTaxPercentage /100) * $this->subtotalForItems);
        $this->grandTotalForItems = $this->subtotalForItems + $this->salesTaxForItems;
    }

    /**
     * @return array
     */
    public function getOrderLines(): array
    {
        return $this->orderLines;
    }

    private function setOrderLines(): void
    {
        $orderLineDataArray = $this->getOrderLineDataFromDataSource();
        foreach ($orderLineDataArray as $line) {
            $this->orderLines[] = new OrderLine($line);
        }
    }

    private function setSubtotalForItems(): void
    {
        foreach ($this->orderLines as $line) {
            $itemsSubtotals[] = $line->getSubtotal();
            $this->subtotalForItems = array_sum($itemsSubtotals);
        }
    }

    private function setOrderDate(): void
    {
        foreach ($this->orderLines as $line) {
            $orderDates[] = $line->getOrderDate();
            // suggest sort $orderDates to get most recent
            $date = new \DateTime($orderDates[0]);
            $this->dateOrderPlaced = $date->format('l d M Y');
        }
    }

    /**
     * @return array
     */
    private function getOrderLineDataFromDataSource() : array
    {
        $orderLineData = array
            (
            array("orderID" => "abc-12345",
                "itemID" => "12345",
                "orderDate" => "2018-03-15 10:20:00",
                "title" => "Cup",
                "description" => "White Cup",
                "price" => 353,
                "quantity" => 2
            ),
            array("orderID" => "abc-12345",
                "itemID" => "12448",
                "orderDate" => "2018-03-15 10:22:00",
                "title" => "Pen",
                "description" => "Red fountain pen",
                "price" => 1351,
                "quantity" => 1
            ),
            array("orderID" => "abc-12345",
                "itemID" => "52349",
                "orderDate" => "2018-03-15 10:23:00",
                "title" => "Drawing pad",
                "description" => "A4 ruled",
                "price" => 210,
                "quantity" => 4
            )
        );
        return $orderLineData;
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
    public function getCustomerID(): string
    {
        return $this->customerID;
    }

    /**
     * @return string
     */
    public function getDateOrderPlaced(): string
    {
        return $this->dateOrderPlaced;
    }

    /**
     * @return int
     */
    public function getSubtotalForItems(): int
    {
        return $this->subtotalForItems;
    }

    /**
     * @return int
     */
    public function getSalesTaxForItems(): int
    {
        return $this->salesTaxForItems;
    }

    /**
     * @return int
     */
    public function getGrandTotalForItems(): int
    {
        return $this->grandTotalForItems;
    }


}
