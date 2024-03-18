<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require '../config/db_connect.php';

        $user_name = $_POST['user_id'];

        if (edit_user($user_name, $user_role, $conn)) {
            echo "User deleted successfully";
            echo "<br><a href='../pages/users.php'>Users</a>";
        } 
        else {
            echo "Failed to delete user";
        }

    }


    function delete_user ($user_name, $conn) {

        $user_table = "Users";

        $query = "DELETE FROM ".$user_table." 
        WHERE 
        UserID = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_name);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } 
        
        $stmt->close();
        return false;

    }

?>