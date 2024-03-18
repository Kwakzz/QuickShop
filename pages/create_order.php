<!DOCTYPE html>
<html>
    <head>
        <title>Create Order</title>
        <link rel="stylesheet" href="../css/general.css">
        <link rel="stylesheet" href="../css/form.css">
        <link rel="stylesheet" href="../css/button.css">
        <link rel="stylesheet" href="../css/header.css">
    </head>
    <body>
        
        <header>
            QuickShop
            <div class="subtitle">Your one-stop shop for quick and easy shopping</div>
        </header>

        <h1>Create Order</h1>
        
        <form action="../backend/process_create_order.php" method="POST">

            <label for="product_name">Choose a product:</label><br>
            <select name="product_name" id="product_name">
                <?php
                    require '../config/db_connect.php';
                    require 'products.php';

                    $products = get_products($conn);

                    foreach ($products as $product) {
                        echo "<option value=".$product['ProductName'].">".$product['ProductName']."</option>";
                    }

                ?>
            </select><br>

            <label for="product_quantity">Quantity</label><br>
            <input type="number" id="product_quantity" name="product_quantity" required><br>

            <input type="submit" value="Add">
        </form>
    </body>
</html>