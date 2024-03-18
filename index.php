<!DOCTYPE html>
<html>
    <head>
        <title>QuickShop</title>
        <link rel="stylesheet" href="css/general.css">
        <link rel="stylesheet" href="css/header.css">
    <head>
    <body>
        <header>
            QuickShop
            <div class="subtitle">Your one-stop shop for quick and easy shopping</div>
        </header>
        
        <?php
            session_start();
            if (isset($_SESSION['UserID'])) {

                if ($_SESSION['UserRole'] == 'Administrator') {
                    echo "<a href='pages/users.php'>Users</a><br>";
                    echo "<a href='pages/products.php'>Products</a><br>";
                    echo "<a href='pages/orders.php'>Orders</a><br>";
                }

                if ($_SESSION['UserRole'] == 'Sales Personnel' || $_SESSION['UserRole'] == 'Inventory Manager') {
                    echo "<a href='pages/products.php'>Products</a><br>";
                    echo "<a href='pages/orders.php'>Orders</a><br>";
                }

                if ($_SESSION['UserRole'] == 'Customer') {
                    echo "<a href='pages/products.php'>Products</a><br>";
                    echo "<a href='pages/orders.php'>My Orders</a><br>";
                }          

                echo "<form action='backend/logout.php' method='POST'>"; 
                echo "<input type='submit' name='logout' value='Logout'>";

            }

            else {
                session_destroy();
                echo "<p>Please login or register to continue</p>";
                echo "<a href='pages/login.php'>Login</a><br>";
                echo "<a href='pages/register_customer.php'>Register</a>";
            }
        ?>

    </body>
</html>