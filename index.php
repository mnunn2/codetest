<?php declare(strict_types=1);

require 'vendor/autoload.php';

use Fred\Order;

setlocale(LC_MONETARY, 'en_UK');

$orderNumber = 'fyi-12346'; // sourced from sanitized user input
try {
    $order = new Order($orderNumber);
    $lines = $order->getOrderLines();
    require 'view/order_view.php';
}
catch(Exception $e) {
  echo 'Message: ' . $e->getMessage();
}

