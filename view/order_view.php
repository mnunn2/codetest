<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Order</title>
        <link rel="stylesheet" href="css/order.css">
    </head>
    <body>
        <div class="grid-container">
            <div class="grid-item grid-background"></div>
            <div class="grid-item" id="orderHeader">
                <h2><?php echo "Order Number: $order->orderID"; ?></h2>
                <p><?php echo "Order date: $order->dateOrderPlaced"; ?></p>
            </div>
            <div class="grid-item grid-background"></div>  
            <div class="grid-item grid-background"></div>
            <div class="grid-item"><h3>Customer Details:</h3></div>
            <div class="grid-item grid-background"></div>  
            <div class="grid-item grid-background"></div>
            <div class="grid-item" id=lineItems>
                <p><h3>Order details:</h3></p>
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
                    <?php foreach ($lines as $line) :  ?>
                    <tr>
                        <td><?php echo $line->title; ?></td>
                        <td><?php echo $line->description; ?></td>
                        <td><?php echo "£" . money_format('%i', $line->itemPrice/100); ?></td>
                        <td><?php echo $line->quantity; ?></td>
                        <td><?php echo "£" . money_format('%i', $line->subtotal/100); ?></td>
                        <td><?php echo "£" . money_format('%i', $line->salesTaxApplied/100); ?></td>
                        <td><?php echo "£" . money_format('%i', $line->grandTotal/100); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Totals:</th>
                        <th><?php echo "£" . money_format('%i', $order->subtotalForItems/100); ?></th>
                        <th><?php echo "£" . money_format('%i', $order->salesTaxForItems/100); ?></th>
                        <th><?php echo "£" . money_format('%i', $order->grandTotalForItems/100); ?></th>
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
