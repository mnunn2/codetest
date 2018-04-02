<?php declare(strict_types=1);

namespace test;

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
        $this->assertInstanceOf(CalcInterface::class, $order);
    }
    
    public function testGetOrderLines(): void
    {
        $testOrder = new Order('abc-12345');
        $orderLines = $testOrder->getOrderLines();
        $this->assertInternalType('array', $orderLines);
        $this->assertInstanceOf('Fred\OrderLineCurrencyDec', $orderLines[0]);
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
        $subtotals = $testOrder->getSubtotal();
        $tax = $testOrder->getSalesTaxApplied();
        $grandTotals = $testOrder->getGrandTotal();
        $this->assertInternalType('int', $subtotals);
        $this->assertInternalType('int', $tax);
        $this->assertInternalType('int', $grandTotals);
        print_r("\n$subtotals $tax $grandTotals\n");
    }

    public function testDecoratorCanBeCreatedWithTestData(): void
    {
        $order = new OrderCurrencyDec(new Order("abc-12345"));
        $this->assertInstanceOf(OrderCurrencyDec::class, $order);
        print_r($order->subtotalCurrency() . " ");
        print_r($order->getGrandTotal() . " ");
    }

}
