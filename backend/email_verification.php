<?php

    require 'PHPMailerAutoload.php';
    

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
?>
