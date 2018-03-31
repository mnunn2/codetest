<?php declare(strict_types=1);

namespace test;

use PHPUnit\Framework\TestCase;
use Fred\Order;

final class OrderTest extends TestCase
{
    public function testCannotBeCreatedWithInvalidOrderID(): void
    {
        $this->expectException(\Exception::class);
        (new Order("invalid"));
    }

    public function testCanBeCreatedFromValidOrderID(): void
    {
        $this->assertInstanceOf(
            Order::class,
            (new Order('abc-12345'))
        );
    }
    
    public function testGetOrderLines(): void
    {
        $testOrder = new Order('abc-12345');
        $orderLines = $testOrder->getOrderLines();
        $this->assertInternalType('array', $orderLines);
        $this->assertInstanceOf('Fred\OrderLine', $orderLines[0]);
        print_r($orderLines[0]);
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
        $subtotals = $testOrder->getSubtotalForItems();
        $tax = $testOrder->getSalesTaxForItems();
        $grandTotals = $testOrder->getGrandTotalForItems();
        $this->assertInternalType('int', $subtotals);
        $this->assertInternalType('int', $tax);
        $this->assertInternalType('int', $grandTotals);
        print_r("\n$subtotals $tax $grandTotals");
    }
}
