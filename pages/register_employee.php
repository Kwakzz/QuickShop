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

        <h1>Register Employee</h1>
        
        <form action="../backend/process_registration.php" method="POST">

            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" required><br>

            <label for="email">Email</label><br>
            <input type="email" id="email" name="email"required><br>

            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required><br>

            <label for="role">Select your role:</label><br>
            <select name="role" id="role">
                <option value="Administrator">Administrator</option>
                <option value="Sales Personnel">Sales Personnel</option>
                <option value="Inventory Manager">Inventory Manager</option>
            </select><br>

            <input type="submit" value="Register">
        </form>

        <script src = "../js/validate_password.js"></script>
    </body>
</html>