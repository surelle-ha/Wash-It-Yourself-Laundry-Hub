<?php
    if(isset($_POST['login'])){
        // Verify reCAPTCHA response
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = '6Ldvky8lAAAAACRuWAssZCwQ6Cd5r4kwFVI9Qobj';
        $recaptcha_response = $_POST['g-recaptcha-response'];
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);
        if (!$recaptcha->success) {
            header('location: auth.php?err=333');
        } else {
            $sql = "SELECT * FROM users_tb WHERE email = '".$_POST['email']."';";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)) {
                    if($row['password'] == $_POST['password']){
                        if($row['status'] == 0){
                            header('location: auth.php?err=502');
                        }else if($row['status'] == 1){
                            session_start();
                            $ini = new INI('account_information/'.$row['id'].'/accountDetails.ini');

                            $_SESSION['logged_status'] = 1;
                            $_SESSION['logged_time'] = time();
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['fname'] = $row['fname'];
                            $_SESSION['lname'] = $row['lname'];
                            $_SESSION['birthday'] = $row['birthday'];
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['password'] = $row['password'];
                            $_SESSION['status'] = $row['status'];
                            $_SESSION['task'] = $row['task'];
                            $_SESSION['date_created'] = $row['date_created'];
                            $_SESSION['mname'] = $row['mname'];
                            $_SESSION['website'] = $row['website'];
                            $_SESSION['address_1'] = $row['address1'];
                            $_SESSION['address_2'] = $row['address2'];
                            $_SESSION['city'] = $row['city'];
                            $_SESSION['state'] = $row['state'];
                            $_SESSION['zip'] = $row['zipcode'];
                            $_SESSION['country'] = $row['country'];
                            $_SESSION['phone'] = $row['phone'];
                            $_SESSION['alt_email'] = $row['alt_email'];
                            header("location: index.php");
                        }else if($row['status'] == -1){
                            header('location: auth.php?err=404');
                        }
                    }else{
                        header('location: auth.php?err=403');
                    }
                }
            }else{
                header('location: auth.php?err=403');
            }
        }
    }

    if(isset($_POST['resetpassword'])){
        $sql = "SELECT * FROM users_tb WHERE email = '".$_POST['email']."';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            /* Confirmation Email Send */
            require_once 'vendor/autoload.php';
            $transport = (new Swift_SmtpTransport('smtp-relay.sendinblue.com', 587))
            ->setUsername('0110harold@gmail.com')
            ->setPassword('Q6rFpKD8nOAUGYJR')
            ;
            $mailer = new Swift_Mailer($transport);
            $message = (new Swift_Message('Reset Account Password'))
            ->setFrom(['WashitYourselfLaundryHub@gmail.com' => 'Wash It Yourself Laundry Hub'])
            ->setTo([$_POST['email'], $_POST['email'] => 'Reset Password Email'])
            ->setBody('Hi,
            <p>Click the One-Time Link (OTL) below to reset your password. <br>
            <p>'.$__domain.'/resetpassword.php?reset='.$_POST['email'].'</p>
            <p>Do not share this link with anyone. We take account security very seriously at WIYLH.<br>
            WIYLH Customer Care will never ask you for your account password, credit card, or banking account number.</p>
            <p>Kind regards,<br>
            <b>The WIYLH Team</b></p>')
            ;
            $result = $mailer->send($message);
        }
        header('location: resetpassword.php?resetPasswordSent=1');
    }

    if(isset($_POST['resetnow'])){
        $sql = "UPDATE users_tb SET password = '".$_POST['password']."' WHERE email = '".$_POST['email']."';";
        if ($conn->query($sql) === TRUE) {
            header('location: auth.php?passwordChanged=1');
        }
    }

    if(isset($_GET['signout']) && $_GET['signout'] == $_SESSION['id']){
        session_destroy();
        session_unset();
        header('location: index.php');
    }

    $currentTime = time();
    if (isset($_SESSION['logged_time']) && ($currentTime - $_SESSION['logged_time'] > 2000)) {
        session_destroy();
        session_unset();
        header('location: index.php');
    }else {
        $_SESSION['logged_time'] = time();
    }  
?>