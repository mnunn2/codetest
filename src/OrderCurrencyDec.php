<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 01/04/18
 * Time: 14:33
 */

namespace Fred;


/**
 * Class OrderCurrencyDec
 *
 * Decorator to abstract formatting currency for Order & OrderLine
 * See currencyFmt()
 *
 * @package Fred
 */
class OrderCurrencyDec
{
    protected $orderObj;

    /**
     * OrderCurrencyDec constructor.
     * @param Order
     */
    public function __construct($order)
    {
        $this->orderObj = $order;
    }

    /**
     * @return string
     */
    public function subtotalCurrency(): string
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->currencyFmt((float)$this->orderObj->getSubtotal());
    }

    /**
     * @return string
     */
    public function salesTaxAppliedCurrency(): string
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->currencyFmt((float) $this->orderObj->getSalesTaxApplied());
    }

    /**
     * @return string
     */
    public function grandTotalCurrency(): string
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->currencyFmt((float) $this->orderObj->getGrandTotal());
    }

    /**
     * @param float $amount
     * @return string
     */
    protected function currencyFmt(float $amount): string
    {
        return "&pound;" . number_format($amount / 100, 2);
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     * Magic method to allow method calls to inner class
     */
    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->orderObj, $method], $arguments);
    }


}