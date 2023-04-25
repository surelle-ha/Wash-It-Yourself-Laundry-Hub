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
        
    }else{
        header('location: index.php');
    }
    
    if(isset($_GET['transaction'])){

    }else{
      header('location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment | Wash It Yourself Laundry Hub</title>
  <link rel="shortcut icon" href="asset/img/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
  <link rel="stylesheet" href="css/checkout-style.css">
<meta name="robots" content="noindex,follow" />
</head>
<body>

<?php
$sql = "SELECT * FROM appointment_tb WHERE order_id = '".$_GET['transaction']."' AND cust_id = '".$_SESSION['id']."' LIMIT 1;";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_array($result)) {
    ?>
  <div class="checkout-panel">
    <div class="panel-body">
      <h2 class="title">Payment Vendor</h2>
      <form method="post">

      <div class="payment-method">

        <label for="gcash" class="method gcash">
          <img src="asset/img/gcash.png" height="30px"/>
          <div class="radio-input">
            <input id="gcash" type="radio" value="GCash" name="paymentVendor" required>
            Pay P<?php echo number_format($row['total']); ?> with GCash
          </div>
        </label>

        <label for="maya" class="method gcash">
          <img src="asset/img/maya.png" height="30px"/>
          <div class="radio-input">
            <input id="maya" type="radio" value="Maya" name="paymentVendor" required>
            Pay P<?php echo number_format($row['total']); ?> with Maya
          </div>
        </label>

      </div>

      <div class="payment-method">

        <label for="visa" class="method gcash">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/512px-Visa_Inc._logo.svg.png" height="30px"/>
          <div class="radio-input">
            <input id="visa" type="radio" value="Visa" name="paymentVendor" required>
            Pay P<?php echo number_format($row['total']); ?> with GCash
          </div>
        </label>

        <label for="mastercard" class="method gcash">
          <img src="asset/img/mastercard.png" height="30px"/>
          <div class="radio-input">
            <input id="mastercard" type="radio" value="Mastercard" name="paymentVendor" required>
            Pay P<?php echo number_format($row['total']); ?> with GCash
          </div>
        </label>
        
      </div>

    </div>
    <div class="panel-footer">
      <button class="btn back-btn" onclick="window.location.href='index.php'">Pay Later</button>
      <input type="hidden" name='total' value='<?php echo $row['total']; ?>'>
      <input type="hidden" name="id" value="<?php echo $_GET['pay']; ?>">
      <input type="submit" class="btn next-btn" name="paynow" value="Pay Now">
    </div>
  </div>
  </form>
    <?php
    }
  }?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="js/checkout-script.js"></script>
</body>
</html>