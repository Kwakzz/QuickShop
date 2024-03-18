<!DOCTYPE html>
<html>
    <head>
        <title>Edit Product</title>
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

        <h1>Edit Product</h1>

            <?php
            
                echo "<form action='../backend/process_edit_product.php?product_id=".$product_id."' method='POST'>";

                require '../config/db_connect.php';

                $product_id = $_GET['product_id'];
                $product = get_product($product_id, $conn);

                function get_product($product_id, $conn) {

                    $product_table = "Products";

                    $query = "SELECT * FROM ".$product_table."
                    WHERE ProductID = ?";

                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('i', $product_id);
                    $stmt->execute();
                    $result = $stmt->get_result()->fetch_assoc();

                    if ($result) {
                        $stmt->close();
                        return $result;
                    }

                    return array();
                }
            ?>

                <label for='product_name'>Product Name</label><br>
                <input type='text' id='product_name' name='product_name' value='<?php echo $product['ProductName'];?>' disabled='disabled' required><br>

                <label for='product_description'>Product Description</label><br>
                <input type='text' id='product_description' name='product_description' value='<?php echo $product['ProductDescription'];?>'required><br>

                <label for='product_price'>Price</label><br>
                <input type='number' id='product_price' name='product_price' value='<?php echo $product['Price'];?>' required><br>

                <label for='product_quantity'>Quantity</label><br>
                <input type='number' id='product_quantity' name='product_quantity' value='<?php echo $product['StockQuantity'];?>' required><br>



            <input type="submit" value="Edit">
        </form>
    </body>
</html>