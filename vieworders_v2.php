<?php
    // 建立簡短的變數名稱
    $document_root = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bob's Auto Parts - Customer Orders</title>

        <style type="text/css">
            table, th, td {
                border-collapse: collapse;
                border:1px solid black;
                padding: 6px;
            }

            th {
                background: #ccccff;;
            }
        </style>
    </head>
    <body>
        <h1>Bob's Auto Parts</h1>
        <h2>Customer Orders</h2>
        <?php
            // 讀入整個檔案
            // 每一個訂單都會變成一個陣列元素
            $orders = file("orders/orders.txt");
            
            // 計算陣列中的訂單數量
            $number_of_orders = count($orders);

            if ($number_of_orders == 0) {
                echo "<p><strong>No orders pending.<br />
                Please try again later.</strong></p>";
            }

            echo "<table>\n";
            echo "<tr>
                    <th>Order Date</th>
                    <th>Tires</th>
                    <th>Oil</th>
                    <th>Spark Plugs</th>
                    <th>Total</th>
                    <th>Address</th>
                 <tr>";

            for ($i=0; $i < $number_of_orders; $i++) {
                // 拆解各行
                $line = explode("\t", $orders[$i]);

                // 只保留被訂購的物品數字
                $line[1] = intval($line[1]);
                $line[2] = intval($line[2]);
                $line[3] = intval($line[3]);

                // 輸出各個訂單
                echo "<tr>
                     <td>".$line[0]."</td>
                     <td style=\"text-align: right;\">".$line[1]."</td>
                     <td style=\"text-align: right;\">".$line[2]."</td>
                     <td style=\"text-align: right;\">".$line[3]."</td>
                     <td style=\"text-align: right;\">".$line[4]."</td>
                     <td>".$line[5]."</td>
                     </tr>";
            }
            echo "</table>";
        ?>
    </body>
</html>