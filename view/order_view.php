<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Order</title>
        <link rel="stylesheet" href="/css/order.css">
    </head>
    <body>
        <div class="grid-container">
            <div class="grid-item grid-background"></div>
            <div class="grid-item" id="orderHeader">
                <h2><?php echo "Order Number: " . $order->getOrderID(); ?></h2>
                <p><?php echo "Order date: " . $order->getDateOrderPlaced(); ?></p>
            </div>
            <div class="grid-item grid-background"></div>  
            <div class="grid-item grid-background"></div>
            <div class="grid-item"><h3>Customer Details:</h3></div>
            <div class="grid-item grid-background"></div>  
            <div class="grid-item grid-background"></div>
            <div class="grid-item" id=lineItems>
                <h3>Order details:</h3>
                <table>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Item Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Sales Tax</th>
                        <th>Total</th>
                    </tr>
                    <?php foreach ($lines as $line) :
                        /* @var $line \Fred\OrderLine */ ?>
                    <tr>
                        <td><?php echo $line->getTitle(); ?></td>
                        <td><?php echo $line->getDescription(); ?></td>
                        <td><?php echo "£" . money_format('%i', $line->getItemPrice()/100); ?></td>
                        <td><?php echo $line->getQuantity(); ?></td>
                        <td><?php echo "£" . money_format('%i', $line->getSubtotal()/100); ?></td>
                        <td><?php echo "£" . money_format('%i', $line->getSalesTaxApplied()/100); ?></td>
                        <td><?php echo "£" . money_format('%i', $line->getGrandTotal()/100); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Totals:</th>
                        <th><?php echo "£" . money_format('%i', $order->getSubtotal()/100); ?></th>
                        <th><?php echo "£" . money_format('%i', $order->getSalesTaxApplied()/100); ?></th>
                        <th><?php echo "£" . money_format('%i', $order->getGrandTotal()/100); ?></th>
                    </tr>

                </table>
            </div>
            <div class="grid-item grid-background"></div>
            <div class="grid-item grid-background"></div>
            <div class="grid-item"><h3>Delivery Details:</h3></div>
            <div class="grid-item grid-background"></div> 
        </div>

    </body>
</html>
