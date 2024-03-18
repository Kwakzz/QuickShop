<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require '../config/db_connect.php';

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role']; 

        if (register($username, $email, $password, $role, $conn)) {
            echo "User registered successfully";
            echo "<br><a href='../pages/login.php'>Login</a>";
        } 
        else {
            echo "User registration failed";
            echo "<br><a href='../pages/register.php'>Try again</a>";
        }

    }

    function register ($username, $email, $password, $role, $conn) {

        $user_table = "Users";

        $password = encrypt_password($password);

        $query = "INSERT INTO ".$user_table." 
        (UserName, Email, Passwd, UserRole) 
        VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($query);

        $stmt->bind_param('ssss', $username, $email, $password, $role);
        
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } 

        $stmt->close();
        return false;

    }

    function encrypt_password ($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

?>