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
    <title>Register | Wash It Yourself Laundry Hub</title>
</head>
<body>
    <div class="main">
        <div class="container" >
            <section class="wrapper">
                <div class="heading">
                    <h1 class="text text-large">Create Account</h1>
                    <p class="text text-normal">Login? <span><a href="auth.php" class="text text-links">Sigin Now</a></span>
                    </p>
                </div>
                <form name="signin" method="POST" class="form">
                    <script> var url = new URL(window.location.href); var code = url.searchParams.get("err"); if(code == "303"){ document.write('<p style="color:red;">Password did not match.</p>') } </script>
                    <script> var url = new URL(window.location.href); var code = url.searchParams.get("err"); if(code == "304"){ document.write('<p style="color:red;">Email already taken.</p>') } </script>
                    <script> var url = new URL(window.location.href); var code = url.searchParams.get("err"); if(code == "305"){ document.write('<p style="color:red;">Something went wrong.</p>') } </script>
                    <div class="input-control">
                        <label for="fname" class="input-label" hidden>First Name</label>
                        <input type="text" name="fname" id="fname" class="input-field" placeholder="First Name" required>
                    </div>
                    <div class="input-control">
                        <label for="lname" class="input-label" hidden>Last Name</label>
                        <input type="text" name="lname" id="lname" class="input-field" placeholder="Last Name" required>
                    </div>
                    <div class="input-control">
                        <label for="contact" class="input-label" hidden>Contact</label>
                        <input type="text" name="contact" id="contact" class="input-field" placeholder="Contact" required>
                    </div>
                    <div class="input-control">
                        <label for="birthday" class="input-label" hidden>Birthday</label>
                        <input type="date" name="birthday" id="birthday" class="input-field" placeholder="Birthday" max="2005-01-01" required>
                    </div>
                    <div class="input-control">
                        <label for="email" class="input-label" hidden>Email Address</label>
                        <input type="email" name="email" id="email" class="input-field" placeholder="Email Address" required>
                    </div>
                    <div class="input-control">
                        <label for="password" class="input-label" hidden>Password</label>
                        <input type="password" name="password" id="password" class="input-field" placeholder="Password" required>
                    </div>
                    <div class="input-control">
                        <label for="repassword" class="input-label" hidden>Retype Password</label>
                        <input type="password" name="repassword" id="repassword" class="input-field" placeholder="Retype Password" required>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6LdoJhUlAAAAAN5VHwN1uqrYtA3dCOAGqxHf9wCf"></div>
                    <div class="input-control">
                        <input type="submit" name="submit" class="input-submit" value="Register">
                    </div>
                </form>
            </section>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.3/particles.min.js"></script>
</body>
</html>