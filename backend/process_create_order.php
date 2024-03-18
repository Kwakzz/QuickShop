<?php

    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        require '../config/db_connect.php';

        $product_name = $_POST['product_name'];
        $product_quantity = $_POST['product_quantity'];

        $product = get_product_details($product_name, $conn);

        if (empty($product)) {
            echo json_encode(array("message" => "Product not found"));
            return;
        }

        $order = create_order($product, $product_quantity, $conn);
        $order_id = get_most_recent_order_id($conn);

        if ($product && $order && $order_id) {
            create_order_details($product, $order_id, $product_quantity, $conn);
            echo "<br><p>Order created successfully<p>";
        } 
        else {
            echo "<br><p>Order creation failed<p>";            
        }

        echo "<br><a href='../pages/orders.php'>Go back to orders</a>";

 
    }

    function get_product_details ($product_name, $conn) {

        $products_table = "Products";

        $query = "SELECT * FROM ".$products_table."
        WHERE ProductName = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $product_name);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result) {
            $stmt->close();
            return $result;
        }

        return array();

    }

    function create_order($product, $quantity, $conn) {

        $order_table = "Orders";
        $current_date = date('Y-m-d');

        $query = "INSERT INTO ".$order_table." 
        (UserID, OrderDate, TotalAmount) 
        VALUES (?, ?, ?)";

        $stmt = $conn->prepare($query);
        $total_price = $product['Price']*$quantity;

        $stmt->bind_param(
            'isd', 
            $_SESSION['UserID'],
            $current_date,
            $total_price
        );

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;
    }

    function get_most_recent_order_id($conn) {

        $order_table = "Orders";

        $query = "SELECT OrderID FROM ".$order_table."
        ORDER BY OrderID DESC
        LIMIT 1";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result) {
            $stmt->close();
            return $result;
        }

        return array();

    }

    function create_order_details($product, $order, $order_quantity, $conn) {

        $order_details_table = "OrderDetails";

        $query = "INSERT INTO ".$order_details_table." 
        (OrderID, ProductID, Quantity, Price) 
        VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($query);

        $order_price = $product['Price']*$order_quantity;

        $stmt->bind_param(
            'iiid', 
            $order['OrderID'],
            $product['ProductID'],
            $order_quantity,
            $order_price
        );

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;

    }


?>
