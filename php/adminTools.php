<?php
    if(isset($_SESSION['task']) == 'ADMIN'){

        if(isset($_GET['verifyAccount'])){ /* ACTIVATE USER */
            $sql = "UPDATE users_tb SET status = 1 WHERE id = '".$_GET['verifyAccount']."';";
            if ($conn->query($sql) === TRUE) {
                notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "Account Verified.");
            }
        }

        if(isset($_GET['blockAccount'])){ /* DEACTIVATE USER */
            $sql = "UPDATE users_tb SET status = -1 WHERE id = '".$_GET['blockAccount']."';";
            if ($conn->query($sql) === TRUE) {
                notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "Account Blocked.");
            }
        }

        if(isset($_GET['unblockAccount'])){ /* DEACTIVATE USER */
            $sql = "UPDATE users_tb SET status = 1 WHERE id = '".$_GET['unblockAccount']."';";
            if ($conn->query($sql) === TRUE) {
                notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "Account Unblocked.");
            }
        }

        if(isset($_GET['removeAccount'])){ /* DEACTIVATE USER */
            $sql = "DELETE FROM users_tb WHERE id = '".$_GET['removeAccount']."';";
            if ($conn->query($sql) === TRUE) {
                notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "Account Deleted.");
            }
        }

        if(isset($_GET['makeUser'])){ 
            $sql = "UPDATE users_tb SET task = 'USER' WHERE id = '".$_GET['makeUser']."';";
            if ($conn->query($sql) === TRUE) {
                notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "User set as USER.");
            }
        }

        if(isset($_GET['makeAdmin'])){ 
            $sql = "UPDATE users_tb SET task = 'ADMIN' WHERE id = '".$_GET['makeAdmin']."';";
            if ($conn->query($sql) === TRUE) {
                notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "User set as ADMIN.");
            }
        }

        if(isset($_GET['makeEmployee'])){ 
            $sql = "UPDATE users_tb SET task = 'EMPLOYEE' WHERE id = '".$_GET['makeEmployee']."';";
            if ($conn->query($sql) === TRUE) {
                notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "User set as EMPLOYEE.");
            }
        }

        // NOT USED FUNCTION BELOW //

        if(isset($_GET['adminResetOrders'])){
            $sql = "TRUNCATE orders_tb;";
            if ($conn->query($sql) === TRUE) {
                /* SEND NOTIF EMAIL */
                $adminResetOrders = 1;
            }
        }
        if(isset($_GET['adminResetUsers'])){
            $sql = "TRUNCATE users_tb;";
            if ($conn->query($sql) === TRUE) {
                /* SEND NOTIF EMAIL */
                $adminResetUsers = 1;
            }
        }

    }
?>



