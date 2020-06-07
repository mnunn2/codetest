<?php declare(strict_types=1);

require 'vendor/autoload.php';

use Fred\Order;
use Fred\OrderCurrencyDec;
$orderNumber = 'fyi-12346'; // sourced from sanitized user input
try {
    $order = new Order($orderNumber);
    $lines = $order->getOrderLines();
    require 'view/order_view.php';
}
catch(Exception $e) { // added in b
  echo 'Messages: ' . $e->getMessage();
}
