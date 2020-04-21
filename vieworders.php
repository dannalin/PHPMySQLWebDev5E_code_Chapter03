<?php
    // 建立簡短的變數名稱
    $document_root = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bob's Auto Parts - Order Results</title>
    </head>
    <body>
        <h1>Bob's Auto Parts</h1>
        <h2>Customer Orders</h2>
        <?php
            $orders = file("orders/orders.txt");

            $number_of_orders = count($orders);
            if ($number_of_orders == 0) {
                echo "<p><strong>No orders pending.<br />
                Please try again later.</strong></p>";
            }

            for ($i=0; $i < $number_of_orders; $i++) {
                echo $orders[$i]."<br />";
            }
        ?>
    </body>
</html>