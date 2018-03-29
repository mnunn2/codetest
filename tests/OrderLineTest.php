<?php declare(strict_types=1);

namespace test;

use PHPUnit\Framework\TestCase;
use Fred\OrderLine;

final class OrderLineTest extends TestCase
{
    public $testData = array("orderID" => "abc-12345",
                "itemID" => "12345",
                "orderDate" => "2018-03-15 10:20:00",
                "title" => "Cup",
                "description" => "White Cup",
                "price" => "350",
                "quantity" => "2"
            );

    public function testCanBeCreatedWithTestData(): void
    {
        $this->assertInstanceOf(
            OrderLine::class,
            (new OrderLine($this->testData))
        );
    }
    
    public function testSubTotal(): void
    {
        $testOrderLine = new OrderLine($this->testData);
        $this->assertInternalType('int', $testOrderLine->subtotal);
        var_dump($testOrderLine->subtotal);
    }
    
    public function testSalesTaxApplied(): void
    {
        $testOrderLine = new OrderLine($this->testData);
        $this->assertInternalType('int', $testOrderLine->salesTaxApplied);
        // add test to check tax calc
        var_dump($testOrderLine->salesTaxApplied);
        var_dump($testOrderLine->grandTotal);
    }
}
