<?php declare(strict_types=1);

namespace Fred;

class Order
{
    public $orderID;
    public $customerID;
    public $dateOrderPlaced;
    public $subtotalForItems;
    public $salesTaxForItems;
    public $grandTotalForItems;
    private $orderLines = []; //array of order line objects

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

    public function getOrderLines()
    {
        return $this->orderLines;
    }

    private function setOrderLines()
    {
        $orderLineDataArray = $this->getOrderLineDataFromDataSource();
        foreach ($orderLineDataArray as $line) {
            $this->orderLines[] = new OrderLine($line);
        }
    }

    private function setSubtotalForItems()
    {
        foreach ($this->orderLines as $line) {
            $itemsSubtotals[] = $line->subtotal;
            $this->subtotalForItems = array_sum($itemsSubtotals);
        }
    }

    private function setOrderDate()
    {
        foreach ($this->orderLines as $line) {
            $orderDates[] = $line->orderDate;
            // suggest sort $orderDates to get most recent
            $date = new \DateTime($orderDates[0]);
            $this->dateOrderPlaced = $date->format('l d M Y');
        }
    }

    private function getOrderLineDataFromDataSource() : array
    {
        $orderLineData = array
            (
            array("orderID" => "abc-12345",
                "itemID" => "12345",
                "orderDate" => "2018-03-15 10:20:00",
                "title" => "Cup",
                "description" => "White Cup",
                "price" => "350",
                "quantity" => "2"
            ),
            array("orderID" => "abc-12345",
                "itemID" => "12448",
                "orderDate" => "2018-03-15 10:22:00",
                "title" => "Pen",
                "description" => "Red fountain pen",
                "price" => "1350",
                "quantity" => "1"
            ),
            array("orderID" => "abc-12345",
                "itemID" => "52349",
                "orderDate" => "2018-03-15 10:23:00",
                "title" => "Drawing pad",
                "description" => "A4 ruled",
                "price" => "210",
                "quantity" => "4"
            )
        );
        return $orderLineData;
    }
}
