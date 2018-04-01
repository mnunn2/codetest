<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 01/04/18
 * Time: 10:01
 */
namespace Fred;

/**
 * Interface calcTotalsTax
 * @package Fred
 */
interface CalcTotalsTax
{
    /**
     * @return int
     */
    public function getSubtotal(): int;

    /**
     * @return int
     */
    public function getSalesTaxApplied(): int;

    /**
     * @return int
     */
    public function getGrandTotal(): int;
}