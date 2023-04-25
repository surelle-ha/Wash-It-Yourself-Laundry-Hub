<?php
    if(isset($_SESSION['task']) == 'EMPLOYEE' || $_SESSION['id'] == 'SUPERADMIN1030'){

        if(isset($_GET['complete'])){ // Complete Function // Change Email Content
            notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "Transaction Complete notification has been sent.");
            $sql = "UPDATE appointment_tb SET status = 3, date_complete = '".date('Y-m-d')."' WHERE order_id = '".$_GET['complete']."';";
            if ($conn->query($sql) === TRUE) {
                
            }
            
        }

        if(isset($_GET['remindpayment'])){ // Remind Payment Function
            notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "Reminder has been sent.");
            $sql = "SELECT * FROM users_tb WHERE id = '".$_GET['custid']."' LIMIT 1;";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)) {
                    require_once 'vendor/autoload.php';
                    $transport = (new Swift_SmtpTransport('smtp-relay.sendinblue.com', 587))
                    ->setUsername('0110harold@gmail.com')
                    ->setPassword('Q6rFpKD8nOAUGYJR')
                    ;
                    $mailer = new Swift_Mailer($transport);
                    $message = (new Swift_Message('WIYLH Payment Reminder'))
                    ->setFrom(['WashitYourselfLaundryHub@gmail.com' => 'Wash It Yourself Laundry Hub'])
                    ->setTo([$row['email'], $row['email'] => $row['fname']." ".$row['lname']])
                    ->setBody('Hi <b>'.$row['fname'].'</b>,
                    <p>I hope this email finds you well. I am writing to remind you about your payment for '.$_GET['remindpayment'].'.</p>
                    <p>We understand that sometimes unexpected circumstances can arise, and we are happy to work with you to find a solution. If there is a reason why you are unable to make the payment at this time, please do not hesitate to reach out to us so we can discuss alternative payment arrangements.</p>
                    <p>However, if there is no issue with the payment and it has simply slipped your mind, we kindly request that you take care of this matter as soon as possible. Late payments can negatively impact both of us, and we value your continued business and timely payments.</p>
                    <p>If you have already made the payment, please disregard this email. Otherwise, please take action as soon as possible to avoid any further complications. Thank you for your attention to this matter.</p>
                    <p>A friendly reminder, do not share this link with anyone. We take account security very seriously at WIYLH.<br>
                    WIYLH Customer Care will never ask you for your account password, credit card, or banking account number.</p>
                    <p>Kind regards,<br>
                    <b>The WIYLH Team</b></p>')
                    ;
                    $result = $mailer->send($message);
                }
            }
        }

        if(isset($_GET['markaspaid'])){ // Mark as Paid Function
            notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "Mark as Paid. Notification sent.");
            $sql = "UPDATE appointment_tb SET status = 2 WHERE order_id = '".$_GET['markaspaid']."';";
            if ($conn->query($sql) === TRUE) {
                $sql = "SELECT * FROM users_tb WHERE id = '".$_GET['custid']."' LIMIT 1;";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_array($result)) {

                    }
                }
            }
        }

        if(isset($_GET['markasunpaid'])){ // Mark as Unpaid Function
            notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "Mark as Unpaid.");
            $sql = "UPDATE appointment_tb SET status = 1 WHERE order_id = '".$_GET['markasunpaid']."';";
            if ($conn->query($sql) === TRUE) {
                // Email here
            }
        }

        if(isset($_GET['refund'])){ // Refund Function
            notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "Refund Email has been sent.");
            
        }

        if(isset($_GET['reschedule'])){ // Reschedule Function
            notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "Reschedule Email has been sent.");
            $sql = "UPDATE appointment_tb SET appointment = '".date('Y-m-d', strtotime('+5 day'))."' WHERE order_id = '".$_GET['reschedule']."';";
            if ($conn->query($sql) === TRUE) {
                // Email here
            }
        }

        if(isset($_GET['forcecancel'])){ // Force Cancel Function
            notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "Cancellation Email has been sent.");
            $sql = "DELETE FROM appointment_tb WHERE order_id = '".$_GET['forcecancel']."';";
            if ($conn->query($sql) === TRUE) {
                $sql = "SELECT * FROM users_tb WHERE id = '".$_GET['custid']."' LIMIT 1;";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_array($result)) {
                        
                    }
                }
            }
        }


    }
?>