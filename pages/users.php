<?php
    session_start();
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Users</title>
        <link rel="stylesheet" href="../css/general.css">
        <link rel="stylesheet" href="../css/table.css">
        <link rel="stylesheet" href="../css/header.css">
    </head>

    <body>
        <header>
            QuickShop
            <div class="subtitle">Your one-stop shop for quick and easy shopping</div>
        </header>

        <h1>Users</h1>

        <?php

            if ($_SESSION['UserRole'] == 'Administrator') {
                echo "<a href='register_employee.php'>Add Employee</a><br>";
            }

            require '../config/db_connect.php';

            $users = get_users($conn);

            function get_users($conn) {

                $user_table = "Users";

                $query = "SELECT * FROM ".$user_table;
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

                if ($result) {
                    $stmt->close();
                    return $result;
                }

                return array();
            }

            if (empty($users)) {
                echo "<tr><td colspan='4'>No users available</td></tr>";
            }

            else {

                echo "<table>";

                echo "<tr>";
                echo "<th>User ID</th>";
                echo "<th>Name</th>";
                echo "<th>Email</th>";
                echo "<th>Role</th>";
                echo "</tr>";


                foreach ($users as $user) {
                    echo "<tr>";

                    echo "<td align=center>".$user['UserID']."</td>";
                    echo "<td align=center>".$user['UserName']."</td>";
                    echo "<td align=center>".$user['Email']."</td>";
                    echo "<td align=center>".$user['UserRole']."</td>";

                    if ($_SESSION['UserRole'] == 'Administrator') {
                        echo "<td><a href='edit_user.php?user_id=".$user['UserID']."'>Edit</a></td>";
                        echo "<td><a href='delete_user.php?user_id=".$user['UserID']."'>Delete</a></td>";
                    }

                    echo "</tr>";
                }

            }

        ?>

        </table>

        <a href="../index.php">Homepage</a>
        
    </body>

</html>