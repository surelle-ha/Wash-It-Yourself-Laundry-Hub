<?php

    if(isset($_GET['saveOrder'])){ // Save Order to Database [Working]
        $order_id = RAND(10000, 99999).RAND(10000, 99999);
        if($_GET['plan_price'] == '210'){
            $service = 'Full Service';
        }else{
            $service = 'Self Service';
        }
        if($_GET['payment'] == 'otc'){
            $sql = "INSERT INTO appointment_tb VALUES('".$order_id."','".$_SESSION['id']."','".$_SESSION['fname']." ".$_SESSION['lname']."','".$service."','".$_GET['date']."','".$_GET['payment']."','OTC','".$_GET['total']."','".date("Y-m-d")."', 2, '--');";
        }else{
            $sql = "INSERT INTO appointment_tb VALUES('".$order_id."','".$_SESSION['id']."','".$_SESSION['fname']." ".$_SESSION['lname']."','".$service."','".$_GET['date']."','".$_GET['payment']."','OTC','".$_GET['total']."','".date("Y-m-d")."', 1, '--');";
        }
        if ($conn->query($sql) === TRUE) {
            if($_GET['payment'] == 'otc'){
                header('location: index.php');
                // Add Display Notif here
            }else{
                header('location: checkout.php?transaction='.$order_id);
                // Add Display Notif here
            }
        }
    }

    if(isset($_POST['paynow'])){ // [Working]
        require_once 'vendor/autoload.php';
        $transport = (new Swift_SmtpTransport('smtp-relay.sendinblue.com', 587))
        ->setUsername('0110harold@gmail.com')
        ->setPassword('Q6rFpKD8nOAUGYJR')
        ;
        $mailer = new Swift_Mailer($transport);
        if($_POST['paymentVendor'] == 'Maya' || $_POST['paymentVendor'] == 'GCash'){
            $message = (new Swift_Message('Appointment Payment Email'))
            ->setFrom(['WashitYourselfLaundryHub@gmail.com' => 'Wash It Yourself Laundry Hub'])
            ->setTo([$_SESSION['email'], $_SESSION['email'] => $_SESSION['fname']." ".$_SESSION['lname']])
            ->setBody('Hi <b>'.$_SESSION['fname'].'</b>,
            <p>To pay your appointment, please send your payment on this number and allow few hours for your payment to reflect on your account. <br>
            Due Amount: '.$_POST['total'].' <br>
            <p>Gcash/Maya Number: 09221155332</p>
            <p>A friendly reminder, do not share this link with anyone. We take account security very seriously at WIYLH.<br>
            WIYLH Customer Care will never ask you for your account password, credit card, or banking account number.</p>
            <p>Kind regards,<br>
            <b>The WIYLH Team</b></p>')
            ;
        }else{
            $message = (new Swift_Message('Appointment Payment Email'))
            ->setFrom(['WashitYourselfLaundryHub@gmail.com' => 'Wash It Yourself Laundry Hub'])
            ->setTo([$_SESSION['email'], $_SESSION['email'] => $_SESSION['fname']." ".$_SESSION['lname']])
            ->setBody('Hi <b>'.$_SESSION['fname'].'</b>,
            <p>To pay your appointment, please send your payment on this account number and allow few hours for your payment to reflect on your account.<br>
            Due Amount: '.$_POST['total'].' <br>
            <p>Bank Account 1: 9100829323</p>
            <p>Bank Account 1: 9100231113</p>
            <p>A friendly reminder, do not share this link with anyone. We take account security very seriously at WIYLH.<br>
            WIYLH Customer Care will never ask you for your account password, credit card, or banking account number.</p>
            <p>Kind regards,<br>
            <b>The WIYLH Team</b></p>')
            ;
        }
        $result = $mailer->send($message);
        header('location: index.php?appointmentsave=1');
    }

    if(isset($_GET['cancelAppointment'])){ // Send Email and delete order to Database [Working]
        require_once 'vendor/autoload.php';
        $transport = (new Swift_SmtpTransport('smtp-relay.sendinblue.com', 587))
        ->setUsername('0110harold@gmail.com')
        ->setPassword('Q6rFpKD8nOAUGYJR')
        ;
        $mailer = new Swift_Mailer($transport);
        $message = (new Swift_Message('Appointment Cancellation Email'))
        ->setFrom(['WashitYourselfLaundryHub@gmail.com' => 'Wash It Yourself Laundry Hub'])
        ->setTo([$_SESSION['email'], $_SESSION['email'] => $_SESSION['fname']." ".$_SESSION['lname']])
        ->setBody('Hi <b>'.$_SESSION['fname'].'</b>,
        <p>To cancel your appointment, please click the click below. <br>
        <p>'.$__domain.'/index.php?cancelAppointmentConfirmed='.$_GET['cancelAppointment'].'&canConf=JasLLAksAAS1'.RAND(111,999).'0aAPosA@'.$_GET['cancelAppointment'].'</p>
        <p>A friendly reminder, do not share this link with anyone. We take account security very seriously at WIYLH.<br>
        WIYLH Customer Care will never ask you for your account password, credit card, or banking account number.</p>
        <p>Kind regards,<br>
        <b>The WIYLH Team</b></p>')
        ;
        $result = $mailer->send($message);
        notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "Cancellation confirmation email sent.");
    }

    if(isset($_GET['cancelAppointmentConfirmed'])){ // [Working]
        $sql = "DELETE FROM appointment_tb WHERE order_id = '".$_GET['cancelAppointmentConfirmed']."';";
        if ($conn->query($sql) === TRUE) {
            notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "Appointment is now cancelled.");
        }
    }

    if(isset($_GET['getinvoice']) && isset($_GET['getqrcode'])){
        require_once('tcpdf/tcpdf.php');
        $name = $_SESSION['fname']."".$_SESSION['lname'];
        $transactionid = $_GET['getinvoice'];
        $email = $_SESSION['email'];
        $amount = $_GET['total'];
        $date = $_GET['date'];
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('Wash It Yourself Laundry Hub');
        $pdf->SetAuthor('Wash It Yourself Laundry Hub');
        $pdf->SetTitle('Wash It Yourself Laundry Hub Transaction Invoice');
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'Wash It Yourself Laundry Hub | Transaction Invoice', 0, 1, 'C');
        $pdf->Cell(0, 10, '', 0, 1);
        $pdf->Cell(40, 10, 'Transaction ID:', 0);
        $pdf->Cell(0, 10, $transactionid, 0, 1);
        $pdf->Cell(40, 10, 'Name:', 0);
        $pdf->Cell(0, 10, $name, 0, 1);
        $pdf->Cell(40, 10, 'Email:', 0);
        $pdf->Cell(0, 10, $email, 0, 1);
        $pdf->Cell(40, 10, 'Amount:', 0);
        $pdf->Cell(0, 10, $amount, 0, 1);
        $pdf->Cell(40, 10, 'Date:', 0);
        $pdf->Cell(0, 10, $date, 0, 1);
        include 'phpqrcode/qrlib.php';
        $text = $__domain."/employee-qr.php?viewQR=".$_GET['getqrcode'];
        $temp_file = tempnam(sys_get_temp_dir(), 'qrcode_');
        QRcode::png($text, $temp_file);
        $pdf->Image($temp_file, 150, 50, 40, 40, 'PNG');
        $pdf->Output('WIYLH-Invoice'.$_GET['getinvoice'].'.pdf', 'D');
        unlink($temp_file);
    }

    if(isset($_GET['getinvoiceonly'])){
        require_once('tcpdf/tcpdf.php');
        $name = $_SESSION['fname']."".$_SESSION['lname'];
        $transactionid = $_GET['getinvoice'];
        $email = $_SESSION['email'];
        $amount = $_GET['total'];
        $date = $_GET['date'];
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('Wash It Yourself Laundry Hub');
        $pdf->SetAuthor('Wash It Yourself Laundry Hub');
        $pdf->SetTitle('Wash It Yourself Laundry Hub Transaction Invoice');
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'Wash It Yourself Laundry Hub | Transaction Invoice', 0, 1, 'C');
        $pdf->Cell(0, 10, '', 0, 1);
        $pdf->Cell(40, 10, 'Transaction ID:', 0);
        $pdf->Cell(0, 10, $transactionid, 0, 1);
        $pdf->Cell(40, 10, 'Name:', 0);
        $pdf->Cell(0, 10, $name, 0, 1);
        $pdf->Cell(40, 10, 'Email:', 0);
        $pdf->Cell(0, 10, $email, 0, 1);
        $pdf->Cell(40, 10, 'Amount:', 0);
        $pdf->Cell(0, 10, $amount, 0, 1);
        $pdf->Cell(40, 10, 'Date:', 0);
        $pdf->Cell(0, 10, $date, 0, 1);
        $pdf->Output('WIYLH-Invoice'.$_GET['getinvoiceonly'].'.pdf', 'D');
    }

    if(isset($_GET['getqrcode'])){
        require_once('phpqrcode/qrlib.php');
        $text = $__domain."/employee-qr.php?viewQR=".$_GET['getqrcode'];
        QRcode::png($text);
        header("Content-Type: image/png");
        header("Content-Disposition: attachment; filename=WIYLHQRCode".$_GET['getqrcode'].".png");
    }

// ==============================================================================================================================================

    if(isset($_GET['statusUpdate'])){
        if($_GET['statusUpdate'] == 1){ // payment received
            $sql = "SELECT * FROM users_tb JOIN appointment_tb ON users_tb.id = appointment_tb.cust_id WHERE order_id = '".$_GET['order']."';";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) { 
                while($row = mysqli_fetch_array($result)) {
                    require_once 'vendor/autoload.php';
                    $transport = (new Swift_SmtpTransport('smtp-relay.sendinblue.com', 587))
                    ->setUsername('0110harold@gmail.com')
                    ->setPassword('Q6rFpKD8nOAUGYJR')
                    ;
                    $mailer = new Swift_Mailer($transport);
                    $message = (new Swift_Message('Order Payment Received'))
                    ->setFrom(['cjdconlineshop@gmail.com' => 'WIYLH Online Shop'])
                    ->setTo([$row['email'], $row['email'] => $row['fname']." ".$row['lname']])
                    ->setBody('Hi <b>'.$row['fname'].'</b>,
                    <p>We are delighted to inform you that we have received the payment for your recent order '.$row['order_id'].'. Thank you for choosing our products and services, and for entrusting us with your business.</p>
                    <p>We confirm that the payment has been successfully processed and received by our payment gateway. You will receive a confirmation email from our payment gateway as well.</p>
                    <p>Your order is now being processed and will be dispatched shortly. We will notify you once your order has been shipped, along with the tracking details.</p>
                    <p>If you have any questions or concerns regarding your order, please do not hesitate to reach out to our customer support team. We are always ready to assist you in any way we can.</p>
                    <p>Thank you once again for choosing our company for your needs. We look forward to serving you again in the future.</p>
                    <p>A friendly reminder, do not share this link with anyone. We take account security very seriously at WIYLH.<br>
                    WIYLH Customer Care will never ask you for your account password, credit card, or banking account number.</p>
                    <p>Kind regards,<br>
                    <b>The WIYLH Team</b></p>')
                    ;
                    $result = $mailer->send($message);
                }
            }
        }else if($_GET['statusUpdate'] == 2){ // order otw
            $sql = "SELECT * FROM users_tb JOIN appointment_tb ON users_tb.id = appointment_tb.cust_id WHERE order_id = '".$_GET['order']."';";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) { 
                while($row = mysqli_fetch_array($result)) {
                    require_once 'vendor/autoload.php';
                    $transport = (new Swift_SmtpTransport('smtp-relay.sendinblue.com', 587))
                    ->setUsername('0110harold@gmail.com')
                    ->setPassword('Q6rFpKD8nOAUGYJR')
                    ;
                    $mailer = new Swift_Mailer($transport);
                    $message = (new Swift_Message('Order Out for Delivery'))
                    ->setFrom(['cjdconlineshop@gmail.com' => 'WIYLH Online Shop'])
                    ->setTo([$row['email'], $row['email'] => $row['fname']." ".$row['lname']])
                    ->setBody('Hi <b>'.$row['fname'].'</b>,
                    <p>We are pleased to inform you that your order '.$row['order_id'].' is now out for delivery. Our team has carefully prepared and packed your order, and it will be arriving at your doorstep soon.</p>
                    <p>Please note that your order will be delivered to the shipping address you provided during checkout. If you need to make any changes to the delivery address or have any special delivery instructions, please contact our customer support team as soon as possible.</p>
                    <p>We would like to remind you to keep your phone nearby and to check for updates on the delivery status of your order. You may also track the delivery status of your order using the tracking information provided in the confirmation email.</p>
                    <p>If you have any questions or concerns about your order, please do not hesitate to contact us. We will do our best to assist you in any way we can.</p>
                    <p>Thank you for choosing our company for your needs. We hope you enjoy your order and look forward to serving you again in the future.
                    <p>A friendly reminder, do not share this link with anyone. We take account security very seriously at WIYLH.<br>
                    WIYLH Customer Care will never ask you for your account password, credit card, or banking account number.</p>
                    <p>Kind regards,<br>
                    <b>The WIYLH Team</b></p>')
                    ;
                    $result = $mailer->send($message);
                }
            }
        }else if($_GET['statusUpdate'] == 3){ // order complete
            $sql = "SELECT * FROM users_tb JOIN appointment_tb ON users_tb.id = appointment_tb.cust_id WHERE order_id = '".$_GET['order']."';";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) { 
                while($row = mysqli_fetch_array($result)) {
                    require_once 'vendor/autoload.php';
                    $transport = (new Swift_SmtpTransport('smtp-relay.sendinblue.com', 587))
                    ->setUsername('0110harold@gmail.com')
                    ->setPassword('Q6rFpKD8nOAUGYJR')
                    ;
                    $mailer = new Swift_Mailer($transport);
                    $message = (new Swift_Message('Order Complete'))
                    ->setFrom(['cjdconlineshop@gmail.com' => 'WIYLH Online Shop'])
                    ->setTo([$row['email'], $row['email'] => $row['fname']." ".$row['lname']])
                    ->setBody('Hi <b>'.$row['fname'].'</b>,
                    <p>We would like to thank you for your recent order '.$row['order_id'].'. We hope that you have received your package in good condition and are happy with your purchase.</p>
                    <p>We would love to hear your feedback regarding our products and services. If you have any comments or suggestions, please do not hesitate to let us know.</p>
                    <p>Thank you for choosing our company for your needs. We look forward to serving you again in the future.</p>
                    <p>A friendly reminder, do not share this link with anyone. We take account security very seriously at WIYLH.<br>
                    WIYLH Customer Care will never ask you for your account password, credit card, or banking account number.</p>
                    <p>Kind regards,<br>
                    <b>The WIYLH Team</b></p>')
                    ;
                    $result = $mailer->send($message);
                }
            }
        }
        $sql = "UPDATE appointment_tb SET status = ".$_GET['statusUpdate']." WHERE order_id = '".$_GET['order']."';";
        if ($conn->query($sql) === TRUE) {
            $orderUpdate = 1;
        }
    }
?>