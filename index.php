<?php declare(strict_types=1);

require 'vendor/autoload.php';

use Fred\Order;

setlocale(LC_MONETARY, 'en_UK');

$orderNumber = 'fyi-12346'; // sourced from sanitezed user input

$order = new Order($orderNumber);
$lines = $order->getOrderLines();

require 'view/order_view.php';
