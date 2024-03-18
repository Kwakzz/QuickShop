<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require '../config/db_connect.php';

        $product_description = $_POST['product_description'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity']; 

        if (edit_product($product_description, $product_price, $product_quantity, $conn)) {
            echo "Product edited successfully";
            echo "<br><a href='../pages/products.php'>Products</a>";
        } 
        else {
            echo "Failed to edit product";
            echo "<br><a href='../pages/edit_product.php'>Try again</a>";
        }

    }


    function edit_product ($product_description, $product_price, $product_quantity, $conn) {

        $product_table = "Products";

        $query = "UPDATE ".$product_table." 
        SET 
        ProductDescription = ?,
        Price = ?,
        StockQuantity = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('sdi', $product_description, $product_price, $product_quantity);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } 
        
        $stmt->close();
        return false;

    }

?>