<?php
    session_start();
    include "php/environment.php";
    include "php/init.php";
    include "php/mobileDetect.php";
    include "php/iniParser.php";
    include "php/connection.php";
    include "php/notification.php";
    include "php/dataIn.php";
    include "php/login.php";
    include "php/employee.php";
    include "php/manageCart.php";

    /* USER VERIFY */
    if(isset($_SESSION['logged_status'])){
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="asset/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/auth-style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Signin | Wash It Yourself Laundry Hub</title>
</head>
<body>
    <div class="main">
        <div class="container" >
            <section class="wrapper">
                <div class="heading">
                    <h1 class="text text-large">Sign In</h1>
                    <p class="text text-normal">New user? <span><a href="register.php" class="text text-links">Join Now</a></span>
                    </p>
                </div>
                <form name="signin" method="POST" class="form">
                    <script> var url = new URL(window.location.href); var code = url.searchParams.get("passwordChanged"); if(code == "1"){ document.write('<p style="color:green;">Password has been changed.</p>') } </script>
                    <script> var url = new URL(window.location.href); var code = url.searchParams.get("succ"); if(code == "501"){ document.write('<p style="color:green;">Registered. Check your email address to verify your account.</p>') } </script>
                    <script> var url = new URL(window.location.href); var code = url.searchParams.get("err"); if(code == "502"){ document.write('<p style="color:red;">Account not verified.</p>') } </script>
                    <script> var url = new URL(window.location.href); var code = url.searchParams.get("succ"); if(code == "503"){ document.write('<p style="color:green;">Account is now verified.</p>') } </script>
                    <script> var url = new URL(window.location.href); var code = url.searchParams.get("err"); if(code == "403"){ document.write('<p style="color:red;">Incorrect Email or Password</p>') } </script>
                    <script> var url = new URL(window.location.href); var code = url.searchParams.get("err"); if(code == "401"){ document.write('<p style="color:red;">Server is down.</p>') } </script>
                    <script> var url = new URL(window.location.href); var code = url.searchParams.get("err"); if(code == "404"){ document.write('<p style="color:red;">Account is blocked.</p>') } </script>
                    <script> var url = new URL(window.location.href); var code = url.searchParams.get("err"); if(code == "333"){ document.write('<p style="color:red;">Invalid Captcha. Prove you\'re not a robot.</p>') } </script>
                    <script> var url = new URL(window.location.href); var code = url.searchParams.get("maintenance"); if(code == "true"){ document.write('<p style="color:red;">Portal is currently under maintenance</p>') } </script>
                    <div class="input-control">
                        <label for="email" class="input-label" hidden>Email Address</label>
                        <input type="email" name="email" id="email" class="input-field" placeholder="Email Address" value="" required>
                    </div>
                    <div class="input-control">
                        <label for="password" class="input-label" hidden>Password</label>
                        <input type="password" name="password" id="password" class="input-field" placeholder="Password" value="" required>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6Ldvky8lAAAAAONLkgNMoQdtYqO0Cpk-IOfZXoZz"></div>
                    <div class="input-control">
                        <a href="resetpassword.php" class="text text-links">Forgot Password</a>
                        <input type="submit" name="login" class="input-submit" value="Sign In">
                    </div>
                </form>
            </section>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.3/particles.min.js"></script>
</body>
</html>