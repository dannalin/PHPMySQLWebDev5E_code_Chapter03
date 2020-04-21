<?php
    $tireqty = (int) $_POST['tireqty'];
    $oilqty = (int) $_POST['oilqty'];
    $sparkqty = (int) $_POST['sparkqty'];
    $address = preg_replace('/\t|\R/', ' ', $_POST['address']);
    $document_root = $_SERVER['DOCUMENT_ROOT'];
    $date = date('H:i, jS F Y');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bob's Auto Parts - Order Results</title>
    </head>
    <body>
    <h1>Bob's Auto Parts</h1>
    <h2>Order Results</h2>
    <?php
        echo "<p>Order processed at ".date('H:i, js F Y')."</p>";
        echo '<p>Your Order is as follows: </p>';
        $totalqty = 0;
        $totalamount = 0.00;

        define('TIREPRICE', 100);
        define('OILPRICE', 10);
        define('SPARKPRICE', 4);

        $totalqty = $tireqty + $oilqty + $sparkqty;
        echo "<p>Items ordered: ".$totalqty."<br />";

        if ($totalqty == 0) {
            echo "You did not order anything on the previous page!<br />";
        } else {
            if ($totalqty > 0) {
                echo htmlspecialchars($totalqty).' tires<br />';
            }
            if ($oilqty > 0) {
                echo htmlspecialchars($oilqty).' bootles of oil<br />';
            }
            if ($sparkqty > 0) {
                echo htmlspecialchars($sparkqty).' spark plugs<br />';
            }
        }

        $totalamount = $tireqty * TIREPRICE
                     + $oilqty * OILPRICE
                     + $sparkqty * SPARKPRICE;
        echo "Subtotal: $".number_format($totalamount, 2)."<br />";
        $taxrate = 0.10; // 地區銷售稅率為10%
        $totalamount = $totalamount * ( 1 + $taxrate);
        echo "Total including tax: $".number_format($totalamount, 2)."</p>";

        echo "<p>Address to ship to is ".htmlspecialchars($address)."</p>";

        $outputstring = $date."\t".$tireqty." tires \t".$oilqty." oil\t"
                        .$sparkqty." spark plugs\t\$".$totalamount
                        ."\t". $address."\n";


        
        // 開啟檔案來附加內容
        // @抑制這個函式呼叫式產生的任何錯誤
        // @$fp = fopen("$document_root/../orders/orders.txt", 'ab');
        @$fp = fopen("orders/orders.txt", 'ab');
        if (!$fp) {
            echo "<p><strong> Your order could not be processed at this time.
                  Please try again later.</strong></p>";
            exit;
        }

        flock($fp, LOCK_EX);
        // 寫入檔案
        fwrite($fp, $outputstring, strlen($outputstring));
        flock($fp, LOCK_UN);
        // 關閉檔案
        fclose($fp);

        echo "<p>Order written.</p>";
    ?>
    </body>
</html>