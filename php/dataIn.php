<?php

    if(isset($_POST['manualAddAccount'])){
        $sql = "SELECT * FROM users_tb WHERE email = '".$_POST['email']."';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) <= 0) {
            $id = 'WIYLH'.rand(1000,9999).'N'.rand(10000,99999).'BSK';
            $sql1 = "INSERT INTO users_tb VALUES('".$id."','".$_POST['fname']."', '--','".$_POST['lname']."', '--', '', '', '', '', '', '', '".$_POST['contact']."', '--','".$_POST['birthday']."','".$_POST['email']."','".$id."', 1,'ADMIN','".date("Y/m/d")."');";
            if ($conn->query($sql1) === TRUE) {

                /* Confirmation Email Send */
                require_once 'vendor/autoload.php';
                $transport = (new Swift_SmtpTransport('smtp-relay.sendinblue.com', 587))
                ->setUsername('0110harold@gmail.com')
                ->setPassword('Q6rFpKD8nOAUGYJR')
                ;
                $mailer = new Swift_Mailer($transport);
                $message = (new Swift_Message('Manual Add Account'))
                ->setFrom(['WashitYourselfLaundryHub@gmail.com' => 'Wash It Yourself Laundry Hub'])
                ->setTo([$_POST['email'], $_POST['email'] => $_POST['fname']." ".$_POST['lname']])
                ->setBody('Hi <b>'.$_POST['fname'].'</b>,
                <p>Your account has been created by the Administrator <br>
                <p>Email: '.$_POST['email'].'</p>
                <p>Password: '.$id.'</p>
                WIYLH Customer Care will never ask you for your account password, credit card, or banking account number.</p>
                <p>Kind regards,<br>
                <b>The WIYLH Team</b></p>')
                ;
                $result = $mailer->send($message);
                
                /* Account File Create */
                if (!file_exists('account_information/'.$id)) {
                    mkdir('account_information/'.$id, 0777, true);
                    $file = 'account_information/'.$id.'/accountDetails.ini';
                    if(!is_file($file)){
                        $contents = '';
                        file_put_contents($file, $contents);
                    }
                }
                
                /* Set Default Display Photo */
                copy("asset/img/default_user_dp.png","account_information/".$id."/dp.png");

                $dataIn = 1;
            } else {
                $registerError = 1;
            }
        }else{
            $existEmail = 1;
        }
    }

    if(isset($_POST['submit'])){
        if($_POST['password'] == $_POST['repassword']){
            $sql = "SELECT * FROM users_tb WHERE email = '".$_POST['email']."';";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) <= 0) {
                $id = 'WIYLH'.rand(1000,9999).'N'.rand(10000,99999).'BSK';
                $sql1 = "INSERT INTO users_tb VALUES('".$id."','".$_POST['fname']."', '--','".$_POST['lname']."', '--', '', '', '', '', '', '', '".$_POST['contact']."', '--','".$_POST['birthday']."','".$_POST['email']."','".$_POST['password']."', 0,'USER','".date("Y/m/d")."');";
                if ($conn->query($sql1) === TRUE) {

                    /* Confirmation Email Send */
                    require_once 'vendor/autoload.php';
                    $transport = (new Swift_SmtpTransport('smtp-relay.sendinblue.com', 587))
                    ->setUsername('0110harold@gmail.com')
                    ->setPassword('Q6rFpKD8nOAUGYJR')
                    ;
                    $mailer = new Swift_Mailer($transport);
                    $message = (new Swift_Message('Email Confirmation'))
                    ->setFrom(['WashitYourselfLaundryHub@gmail.com' => 'Wash It Yourself Laundry Hub'])
                    ->setTo([$_POST['email'], $_POST['email'] => $_POST['fname']." ".$_POST['lname']])
                    ->setBody('Hi <b>'.$_POST['fname'].'</b>,
                    <p>Click the One-Time Link (OTL) below to verify your email address. <br>
                    <p>'.$__domain.'/auth.php?id='.$id.'&conf=JasLLAksAAS1'.RAND(111,999).'0aAPosA@'.$id.'</p>
                    <p>Do not share this link with anyone. We take account security very seriously at CDJC.<br>
                    WIYLH Customer Care will never ask you for your account password, credit card, or banking account number.</p>
                    <p>Kind regards,<br>
                    <b>The CDJC Team</b></p>')
                    ;
                    $result = $mailer->send($message);
                    
                    /* Account File Create */
                    if (!file_exists('account_information/'.$id)) {
                        mkdir('account_information/'.$id, 0777, true);
                        $file = 'account_information/'.$id.'/accountDetails.ini';
                        if(!is_file($file)){
                            $contents = '';
                            file_put_contents($file, $contents);
                        }
                    }
                    
                    /* Set Default Display Photo */
                    copy("asset/img/default_user_dp.png","account_information/".$id."/dp.png");

                    header('location: auth.php?succ=501');
                } else {
                    header('location: register.php?err=305');
                }
            }else{
                header('location: register.php?err=304');
            }
        }else{
            header('location: register.php?err=303');
        }
    }

    if(isset($_GET['conf'])){
        $sql1 = "UPDATE users_tb SET status = 1 WHERE id = '".$_GET['id']."';";
        if ($conn->query($sql1) === TRUE) {
            header('location: auth.php?succ=503');
        }
    }

    if(isset($_POST['saveProfile']) && $_POST['saveProfile'] == 1){
        $sql = "UPDATE users_tb SET fname = '".$_POST['fname']."', mname='".$_POST['mname']."', lname = '".$_POST['lname']."', website = '".$_POST['website']."', address1 = '".$_POST['address1']."', address2 = '".$_POST['address2']."', city = '".$_POST['city']."', state = '".$_POST['state']."', zipcode = '".$_POST['zip']."', country = '".$_POST['country']."', phone = '".$_POST['phone']."', alt_email = '".$_POST['alt_email']."' WHERE id = '".$_SESSION['id']."';";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['fname'] = $_POST['fname'];
            $_SESSION['mname'] = $_POST['mname'];
            $_SESSION['lname'] = $_POST['lname'];
            $_SESSION['website'] = $_POST['website'];
            $_SESSION['address_1'] = $_POST['address1'];
            $_SESSION['address_2'] = $_POST['address2'];
            $_SESSION['city'] = $_POST['city'];
            $_SESSION['state'] = $_POST['state'];
            $_SESSION['zip'] = $_POST['zip'];
            $_SESSION['country'] = $_POST['country'];
            $_SESSION['phone'] = $_POST['phone'];
            $_SESSION['alt_email'] = $_POST['alt_email'];
        }
        $profileSaved = 1;
    }

    if(isset($_FILES['dp'])){
        $errors= array();
        $file_name = $_FILES['dp']['name'];
        $file_size =$_FILES['dp']['size'];
        $file_tmp =$_FILES['dp']['tmp_name'];
        $file_type=$_FILES['dp']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['dp']['name'])));
        $extensions= array("jpeg","jpg","png");
        if(in_array($file_ext,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        if($file_size > 2097152){
        $errors[]='File size must be excately 2 MB';
        }
        if(empty($errors)==true){
            move_uploaded_file($file_tmp,"account_information/". $_SESSION['id']."/dp.png");
            $displaySaved = 1;
        }else{
            $displayErrorSave = 1;
        }
    }

    if(isset($_FILES['workPhoto'])){
        $errors= array();
        $file_name = $_FILES['workPhoto']['name'];
        $file_size =$_FILES['workPhoto']['size'];
        $file_tmp =$_FILES['workPhoto']['tmp_name'];
        $file_type=$_FILES['workPhoto']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['workPhoto']['name'])));
        $extensions= array("jpeg","jpg","png");
        if(in_array($file_ext,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        if($file_size > 2097152){
        $errors[]='File size must be excately 2 MB';
        }
        if(empty($errors)==true){
            move_uploaded_file($file_tmp,"account_information/".$_POST['user']."/workPhoto".$_POST['workid'].".png");
            $displaySaved = 1;
        }else{
            $displayErrorSave = 1;
        }
    }
                
?>