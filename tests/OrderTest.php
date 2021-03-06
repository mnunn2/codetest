<?php declare(strict_types=1);

namespace test;

use Fred\OrderBase;
use PHPUnit\Framework\TestCase;
use Fred\CalcInterface;
use Fred\Order;
use Fred\OrderCurrencyDec;

final class OrderTest extends TestCase
{
    public function testCannotBeCreatedWithInvalidOrderID(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Invalid order number");
        (new Order("invalid"));
    }

    public function testCanBeCreatedFromValidOrderID(): void
    {
        $order = new Order('abc-12345');
        $this->assertInstanceOf(Order::class, $order);
        $this->assertInstanceOf(OrderBase::class, $order);
    }
    
    public function testGetOrderLines(): void
    {
        $testOrder = new Order('abc-12345');
        $orderLines = $testOrder->getOrderLines();
        $this->assertInternalType('array', $orderLines);
        $this->assertInstanceOf('Fred\OrderLine', $orderLines[0]);
    }

    public function testSumOfOrderLineGrandTotalsEqualsOrderGrandTotal(): void
    {
        $orderLineGrandTotals = [];
        $testOrder = new Order('abc-12345');
        $orderLines = $testOrder->getOrderLines();
        foreach ($orderLines as $line){
            $orderLineGrandTotals[] = $line->getGrandTotal();
        }
        $this->assertEquals(array_sum( $orderLineGrandTotals ), $testOrder->getGrandTotal());
    }
    
    public function testOrderDate(): void
    {
        $testOrder = new Order('abc-12345');
        $this->assertInternalType('string', $testOrder->getDateOrderPlaced());
        print_r($testOrder->getDateOrderPlaced());
    }
    
    public function testTotalsForItems(): void
    {
        $testOrder = new Order('abc-12345');
        $subtotals = $testOrder->getSubtotal();
        $tax = $testOrder->getSalesTaxApplied();
        $grandTotals = $testOrder->getGrandTotal();
        $this->assertInternalType('int', $subtotals);
        $this->assertInternalType('int', $tax);
        $this->assertInternalType('int', $grandTotals);
        print_r("\n$subtotals $tax $grandTotals\n");
    }

    public function testCurrencyForItems(): void
    {
        $testOrder = new Order('abc-12345');
        $subtotals = $testOrder->subtotalCurrency();
        $tax = $testOrder->salesTaxAppliedCurrency();
        $grandTotals = $testOrder->grandTotalCurrency();
        $this->assertInternalType('string', $subtotals);
        $this->assertInternalType('string', $tax);
        $this->assertInternalType('string', $grandTotals);
        print_r("\n$subtotals $tax $grandTotals\n");
    }
}
