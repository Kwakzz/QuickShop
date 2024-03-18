<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
        <link rel="stylesheet" href="../css/general.css">
        <link rel="stylesheet" href="../css/table.css">
        <link rel="stylesheet" href="../css/header.css">
    </head>
    <body>

        <header>
            QuickShop
            <div class="subtitle">Your one-stop shop for quick and easy shopping</div>
        </header>

        <h1>Products</h1>

        <?php

            if ($_SESSION['UserRole'] == 'Administrator') {
                echo "<a href='add_product.php'>Add Product</a><br>";
            }

            require '../config/db_connect.php';

            $products = get_products($conn);

            function get_products ($conn) {

                $product_table = "Products";
                $query = "SELECT * FROM ".$product_table;
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                if ($result) {
                    $stmt->close();
                    return $result;
                }

                return array();
            }

            if (empty($products)) {
                echo "<tr><td colspan='4'>No products available</td></tr>";
            }
    
            else {

                echo "<table>";

                echo "<tr>";
                echo "<th>Product ID</th>";
                echo "<th>Product Name</th>";
                echo "<th>Price</th>";
                echo "<th>Quantity</th>";
                echo "<tr>";

                foreach ($products as $product) {
                    echo "<tr>";

                    echo "<td align=center>".$product['ProductID']."</td>";
                    echo "<td align=center>".$product['ProductName']."</td>";
                    echo "<td align=center>".$product['Price']."</td>";
                    echo "<td align=center>".$product['StockQuantity']."</td>";

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