<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 01/04/18
 * Time: 18:17
 */

namespace Fred;


/**
 * Class OrderLineCurrencyDec
 * @package Fred
 * $this refers to the orderLine assigned in parent constructor
 * Only orderLine requires getItemPrice
 */
class OrderLineCurrencyDec extends OrderCurrencyDec
{

    /**
     * @return string
     * Passed through parent __call to parent method
     */
    public function itemPriceCurrency(): string
    {
        return $this->currencyFmt((float) $this->orderObj->getItemPrice());
    }
}