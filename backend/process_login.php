<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        require '../config/db_connect.php';

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (login($email, $password, $conn)) {
            echo "User logged in successfully";
            echo "<br><a href='../index.php'>Homepage</a>";
        }

        else {
            echo "User login failed";
            echo "<br><a href='../pages/login.php'>Try again</a>";
        }

    }

    function login($email, $password, $conn) {

        $user_table = "Users";

        $query = "SELECT * FROM ". $user_table ."
                    WHERE 
                    Email = ?";     

        $stmt = $conn->prepare($query);

        $stmt->bind_param('s', $email);

        $stmt->execute();

        $dataRow = $stmt->get_result()->fetch_assoc();

        if ($dataRow && password_verify($password, $dataRow['Passwd'])) {

            $_SESSION['UserID'] = $dataRow['UserID'];
            $_SESSION['UserRole'] = $dataRow['UserRole'];
            $_SESSION['UserName'] = $dataRow['UserName'];
            $_SESSION['Email'] = $dataRow['Email'];

            
            $to = "kwakuosafo20@example.com";
            $subject = "Test Email";
            $message = "This is a test email.";
            $headers = "From: kwakuosafo20@example.com\r\n";
            $headers .= "Reply-To: kwakuosafo20@example.com\r\n";
            $headers .= "Content-type: text/html\r\n";

            if(mail($to, $subject, $message, $headers)) {
                echo "Email sent successfully.";
            } else {
                echo "Email sending failed.";
            }


            return true;
        } 
        
        return false;
    }
