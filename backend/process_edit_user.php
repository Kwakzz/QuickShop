<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require '../config/db_connect.php';

        $user_name = $_POST['user_name'];
        $user_role = $_POST['user_role'];

        if (edit_user($user_name, $user_role, $conn)) {
            echo "User edited successfully";
            echo "<br><a href='../pages/users.php'>Products</a>";
        } 
        else {
            echo "Failed to edit user";
            echo "<br><a href='../pages/edit_user.php'>Try again</a>";
        }

    }


    function edit_user ($user_name, $user_role, $conn) {

        $user_table = "Users";

        $query = "UPDATE ".$user_table." 
        SET 
        UserName = ?,
        UserRole = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $user_name, $user_role);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } 
        
        $stmt->close();
        return false;

    }

?>