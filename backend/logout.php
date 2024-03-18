<?php

    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['UserID'])) {
        session_unset();
        session_destroy();
        header("Location: ../pages/login.php");
        exit();
    }
    else {
        header("Location: ../pages/login.php");
        exit();
    }
