<?php declare(strict_types=1);
// i was changed in b

require 'vendor/autoload.php';

use Fred\Order;
use Fred\OrderCurrencyDec;
// i was added in a
$orderNumber = 'fyi-12346'; // sourced from sanitized user input
try {
    $order = new Order($orderNumber);
    $lines = $order->getOrderLines();
    require 'view/order_view.php';
}
catch(Exception $e) { // added in b
  echo 'Message: ' . $e->getMessage();
}
// i was later added in b

