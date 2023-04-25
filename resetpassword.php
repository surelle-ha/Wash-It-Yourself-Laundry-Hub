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
  <title>Reset Password | Wash It Yourself Laundry Hub</title>
    <link rel="shortcut icon" href="asset/img/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
  <link rel="stylesheet" href="css/checkout-style.css">
<meta name="robots" content="noindex,follow" />
</head>
<body>

  <div class="checkout-panel" style="height: 350px;">
    <div class="panel-body">
      <h2 class="title">Forgot Password?</h2>
      <?php if(isset($_GET['reset'])){?>
        <form method="post">
          <div class="input-fields">
            <div class="column-1" style="width: 100%;">
              <label for="password">Enter New Password</label>
              <input type="password" name="password" placeholder="Enter New Password.." required/>
              <input type='hidden' name="email" value="<?php echo $_GET['reset']; ?>">
            </div>
          </div>
        </div>
        <div class="panel-footer">
          <button class="btn back-btn" onclick="window.location.href='index.php'">Return</button>
          <?php echo $_GET['reset']; ?>
          <input type="submit" class="btn next-btn" name="resetnow" value="Reset Password">
        </div>
      </form>
      <?php }else{ ?>
        <script> var url = new URL(window.location.href); var code = url.searchParams.get("resetPasswordSent"); if(code == "1"){ document.write('<p style="color:green;">Password Reset was sent to your email.</p>'); } </script>
        <form method="post">
          <div class="input-fields">
            <div class="column-1" style="width: 100%;">
              <label for="email">Email Address</label>
              <input type="email" name="email" placeholder="Enter Email Address.." required/>
            </div>
          </div>
        </div>
        <script> var url = new URL(window.location.href); var code = url.searchParams.get("resetPasswordSent"); if(code == "1"){ var div = document.querySelector('.input-fields'); div.style.display = 'none'; } </script>
        <div class="panel-footer">
          <button class="btn back-btn" onclick="window.location.href='auth.php'">Return</button>
          <input type="submit" class="btn next-btn" name="resetpassword" value="Reset Password">
        </div>
      </form>
      <?php }?>
      </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="js/checkout-script.js"></script>
</body>
</html>