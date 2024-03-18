<!DOCTYPE html>

<html>
    <head>
        <title>Login</title>
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

        <h1>Login</h1>

        <?php
            session_start();
            if ($_SESSION['UserID']) {
                header('Location: ../index.php');
            }
        ?>
        
        <form action="../backend/process_login.php" method="POST">

            <label for="email">Email</label><br>
            <input type="email" id="email" name="email"required><br>

            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required><br>


            <input type="submit" value="Login">

        </form>

        <p>Don't have an account? <a href="register_customer.php">Register</a></p>

    </body>