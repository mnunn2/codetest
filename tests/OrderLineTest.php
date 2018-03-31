<?php declare(strict_types=1);

namespace test;

use PHPUnit\Framework\TestCase;
use Fred\OrderLine;

/**
 * Class OrderLineTest
 * @package test
 */
final class OrderLineTest extends TestCase
{
    public $testData = array("orderID" => "abc-12345",
                "itemID" => "12345",
                "orderDate" => "2018-03-15 10:20:00",
                "title" => "Cup",
                "description" => "White Cup",
                "price" => 353,
                "quantity" => 2
            );
    public $taxPercentage = 20; // suggest from config

    public function testCanBeCreatedWithTestData(): void
    {
        $this->assertInstanceOf(
            OrderLine::class,
            (new OrderLine($this->testData))
        );
    }

    public function testItemPrice(): void
    {
        $oL = new OrderLine($this->testData);
        $this->assertInternalType('int', $oL->getItemPrice());
        $this->assertEquals($this->testData["price"], $oL->getItemPrice());
        print_r($oL->getItemPrice() . " ");
    }

    public function testSubTotal(): void
    {
        $oL = new OrderLine($this->testData);
        $price = $this->testData["price"];
        $quant = $this->testData["quantity"];
        $subTot = $quant * $price;
        $this->assertInternalType('int', $oL->getSubtotal());
        $this->assertEquals($subTot, $oL->getSubtotal());
        print_r($oL->getSubtotal() . " ");
    }

    public function testSalesTaxApplied(): void
    {
        $price = $this->testData["price"];
        $quant = $this->testData["quantity"];
        $taxApp = (int)(($this->taxPercentage / 100) * ($price * $quant));
        $oL = new OrderLine($this->testData);
        $this->assertInternalType('int', $oL->getSalesTaxApplied());
        $this->assertEquals($taxApp, $oL->getSalesTaxApplied());
        print_r($oL->getSalesTaxApplied() . " ");
    }

    public function testGrandTotal(): void
    {
        $price = $this->testData["price"];
        $quant = $this->testData["quantity"];
        $subTot = $price * $quant;
        $grandTot = ((int)(($this->taxPercentage / 100) * $subTot)) + $subTot;
        $oL = new OrderLine($this->testData);
        $this->assertInternalType('int', $oL->getGrandTotal());
        $this->assertEquals($grandTot, $oL->getGrandTotal());
        print_r($oL->getGrandTotal() . " ");
    }
}
