<?php declare(strict_types=1);

namespace test;

use Fred\OrderBase;
use PHPUnit\Framework\TestCase;
use Fred\CalcInterface;
use Fred\OrderLine;
use Fred\OrderLineCurrencyDec;

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
                "price" => 201,
                "quantity" => 4
            );
    public $taxPercentage = 20; // suggest from config

    public function testCanBeCreatedWithTestData(): void
    {
        $orderLine = new OrderLine($this->testData);
        $this->assertInstanceOf(OrderLine::class, $orderLine);
        $this->assertInstanceOf(OrderBase::class, $orderLine);
    }

    public function testTotalsTax(): void
    {
        $price = $this->testData["price"];
        $quant = $this->testData["quantity"];
        $subTot = $price * $quant;
        $taxApp = (int)(round(($this->taxPercentage / 100) * $subTot));
        $grandTot = $taxApp + $subTot;
        $oL = new OrderLine($this->testData);
        $this->assertInternalType('int', $oL->getSubtotal());
        $this->assertInternalType('int', $oL->getSalesTaxApplied());
        $this->assertInternalType('int', $oL->getGrandTotal());
        $this->assertEquals($subTot, $oL->getSubtotal());
        $this->assertEquals($taxApp, $oL->getSalesTaxApplied());
        $this->assertEquals($grandTot, $oL->getGrandTotal());
        print_r("$price  $quant " . $oL->getSubtotal() . " ");
        print_r($oL->getSalesTaxApplied() . " ");
        print_r($oL->getGrandTotal() . "\n");
    }
    public function testCurrencyForItems(): void
    {
        $orderLine = new OrderLine($this->testData);
        $itemPrice = $orderLine->itemPriceCurrency();
        $this->assertInternalType('string', $itemPrice);
        print_r("\n$itemPrice\n");
    }
}
