<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
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

        <h1>Register as a Customer</h1>

        <form action="../backend/process_registration.php" method="POST" onsubmit="return validatePassword()">

            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" required><br>

            <label for="email">Email</label><br>
            <input type="email" id="email" name="email"required><br>

            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required><br>

            <input type="text" id="role" name="role" value="Customer" hidden>

            <input type="submit" value="Register">
        </form>

        <p>Already have an account? <a href="login.php">Login</a></p>

        <script src = "../js/validate_password.js"></script>

    </body>

    <!--Boatemaa's password: BoatemaaAmankwah1!-->

    
</html>