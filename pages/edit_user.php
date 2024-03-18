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

        <h1>Edit User</h1>

            <?php

                echo "<form action='../backend/process_edit_user.php?user_id=".$user."' method='POST'>";

                require '../config/db_connect.php';

                $user_id = $_GET['user_id'];
                $user = get_user($user_id, $conn);

                function get_user($user_id, $conn) {

                    $user_table = "Users";

                    $query = "SELECT * FROM ".$user_table."
                    WHERE UserID = ?";

                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('i', $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result()->fetch_assoc();

                    if ($result) {
                        $stmt->close();
                        return $result;
                    }

                    return array();
                }
            ?>

                <label for='user_name'>User Name</label><br>
                <input type='text' id='user_name' name='product_name' value='<?php echo $user['UserName']; ?>' disabled='disabled' required><br>


                <label for='role'>Select your role:</label><br>
                <select name='role' id='role' value='<?php echo $user['UserRole']; ?>'>
                    <option value='Administrator'>Administrator</option>
                    <option value='Sales Personnel'>Sales Personnel</option>
                    <option value='Inventory Manager'>Inventory Manager</option>
                </select><br>


            <input type="submit" value="Edit">
        </form>
    </body>
</html>