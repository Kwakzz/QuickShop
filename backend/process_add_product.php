<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require '../config/db_connect.php';

        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity']; 

        if (add_product($product_name, $product_description, $product_price, $product_quantity, $conn)) {
            echo "Product added successfully";
            echo "<br><a href='../pages/products.php'>Products</a>";
        } 
        else {
            echo "Failed to add product";
            echo "<br><a href='../pages/add_product.php'>Try again</a>";
        }

    }


    function add_product ($product_name, $product_description, $product_price, $product_quantity, $conn) {

        $product_table = "Products";

        $query = "INSERT INTO ".$product_table." 
        (ProductName, ProductDescription, Price, StockQuantity) 
        VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($query);

        $stmt->bind_param('ssdd', $product_name, $product_description, $product_price, $product_quantity);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } 
        
        $stmt->close();
        return false;

    }

?>