<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 02/04/18
 * Time: 08:39
 */

namespace Fred;


class taxCalc
{
    private static $percentage = 20;

    public static function calcTax(int $subtotal): int
    {
        $taxApplied = (int) (round((self::$percentage /100) * $subtotal));
        return $taxApplied;
    }

}