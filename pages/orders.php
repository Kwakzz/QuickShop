<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Orders</title>
        <link rel="stylesheet" href="../css/general.css">
        <link rel="stylesheet" href="../css/table.css">
        <link rel="stylesheet" href="../css/header.css">
    </head>
    <body>

        <header>
            QuickShop
            <div class="subtitle">Your one-stop shop for quick and easy shopping</div>
        </header>

        <?php
  
            if ($_SESSION['UserRole'] == 'Customer') {
                echo "<h1>My Orders</h1>";
                echo "<a href='create_order.php'>Create Order</a><br>";
            }
            else {
                echo "<h1>Orders</h1>";
            }  

            require '../config/db_connect.php';

            if ($_SESSION['UserRole'] == 'Customer') {
                $orders = get_customer_orders($_SESSION['UserID'], $conn);
            }

            else {
                $orders = get_all_orders($conn);
            }

            function get_all_orders ($conn) {

                $order_table = "Orders";
                $order_details_table = "OrderDetails";
                $product_table = "Products";
                $user_table = "Users";

                $query = "SELECT * FROM ".$order_table." 
                INNER JOIN " .$order_details_table. " ON " .$order_details_table.".OrderID = ".$order_table.".OrderID
                INNER JOIN " .$product_table. " ON ".$order_details_table.".ProductID = ".$product_table.".ProductID
                INNER JOIN " .$user_table. " ON " .$order_table.".UserID = ".$user_table.".UserID";

                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                if ($result) {
                    $stmt->close();
                    return $result;
                }

                return array();
            }

            function get_customer_orders ($customer_id, $conn) {

                $order_table = "Orders";
                $order_details_table = "OrderDetails";
                $product_table = "Products";
                $user_table = "Users";

                $query = "SELECT * FROM ".$order_table." 
                INNER JOIN " .$order_details_table. " ON " .$order_details_table.".OrderID = ".$order_table.".OrderID
                INNER JOIN " .$product_table. " ON ".$order_details_table.".ProductID = ".$product_table.".ProductID
                INNER JOIN " .$user_table. " ON " .$order_table.".UserID = ".$user_table.".UserID
                WHERE ".$user_table.".UserID = ?";

                $stmt = $conn->prepare($query);
                $stmt->bind_param('i', $customer_id);
                $stmt->execute();
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                if ($result) {
                    $stmt->close();
                    return $result;
                }

                return array();
            }

            if (empty($orders)) {
                echo "<tr><td colspan='4'>No orders found</td></tr>";
            }


        ?>

        <table>

            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>User Name</th>
                <th>Date</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>

            <?php
                if (!empty($orders)){

                    foreach ($orders as $order) {
                        echo "<tr>";

                        echo "<td align=center>".$order['OrderID']."</td>";
                        echo "<td align=center>".$order['UserID']."</td>";
                        echo "<td align=center>".$order['UserName']."</td>";
                        echo "<td align=center>".$order['OrderDate']."</td>";
                        echo "<td align=center>".$order['ProductID']."</td>";
                        echo "<td align=center>".$order['ProductName']."</td>";
                        echo "<td align=center>".$order['Price']."</td>";
                        echo "<td align=center>".$order['Quantity']."</td>";

                        if ($_SESSION['UserRole'] == 'Administrator') {
                            echo "<td><a href='edit_product.php?product_id=".$product['ProductID']."'>Edit</a></td>";
                            echo "<td><a href='delete_product.php?product_id=".$product['ProductID']."'>Delete</a></td>";
                        }

                        echo "</tr>";
                    } 
                    
                }

                   
            ?>

        </table>

        <a href="../index.php">Homepage</a>

    </body>
</html>