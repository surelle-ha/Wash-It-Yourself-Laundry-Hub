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
        header('location: landing.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Account | Wash It Yourself Laundry Hub</title>
        <link rel="shortcut icon" href="asset/img/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="css/account-style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="css/index-style.css">
        <script src="js/jquery.js"></script>
		<meta charset="UTF-8">
		<meta name="description" content="Admin">
  		<meta name="author" content="CBR">
        <meta name="viewport" content="width=1024">
	</head>
	<body oncontextmenu="return false;">
    <div class="app-container">
        <?php include('widgets/header.php'); ?>
        <div class="app-content">
            <?php include('widgets/navigation.php'); ?>
            <div class="projects-section">
                <?php
                if(isset($_GET['OrderHasBeenPlaced'])){
                    ?>
                        <div class="dialogGreen">
                            <p>Order has been placed. Visit <a href="account.php">Profile</a> to check the status of your order.</p>
                        </div>
                    <?php
                }
                ?>
                <?php if(isset($_GET['viewAsAdmin']) && $_SESSION['task'] == "ADMIN" || isset($_GET['viewAsAdmin']) && $_SESSION['id'] == "SUPERADMIN1030"){ ?>
                    <?php
                    $sql = "SELECT * FROM users_tb WHERE id = '".$_GET['viewAsAdmin']."' LIMIT 1;";
                    $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_array($result)) {
                    ?>
                    <div class="profile-page-container">
                        <div class="profile-container">
                            <div class="profileStatus">
                                <span><i class="fas fa-universal-access"></i> Active</span>
                            </div>
                            <img src="account_information/<?php echo $_GET['viewAsAdmin']; ?>/dp.png?<?php echo time(); ?>" class="profileChanger"><br>
                            <div class="profileName">
                                <b><?php echo $row['fname']." ".$row['lname']; ?><br><span style="color: gray; font-size: 10px;">#<?php echo $row['id']; ?></span></b><br>
                            </div><hr>
                            <p style="color:gray;"><i class="fas fa-map-marker-alt"></i> Location <span style="float: right;font-weight:bold;"><?php echo $row['country']; ?></span></p>
                            <p style="color:gray;"><i class="fas fa-envelope"></i> Email <span style="float: right;font-weight:bold;"><?php echo $row['email']; ?></span></p>
                            <p style="color:gray;"><i class="fas fa-window-maximize"></i> Website <span style="float: right;font-weight:bold;"><?php echo $row['website']; ?></span></p>
                            <p style="color:gray;"><i class="fas fa-users"></i> Member since <span style="float: right;font-weight:bold;"><?php echo $row['date_created']; ?></span></p>
                        </div>
                        <div class="details-container">
                                <form id="edit" method="POST"><p style="color:gray;">Account Information </p></form>
                                <hr>
                                <p style="color:gray;"><i class="fas fa-user-circle"></i> First Name <span style="float: right;font-weight:bold;"><?php echo $row['fname']; ?></span></p>
                                <p style="color:gray;"><i class="fas fa-user-circle" style="color: white;"></i> Middle Name <span style="float: right;font-weight:bold;"><?php echo $row['mname']; ?></span></p>
                                <p style="color:gray;"><i class="fas fa-user-circle" style="color: white;"></i> Last Name <span style="float: right;font-weight:bold;"><?php echo $row['lname']; ?></span></p>
                                <p style="color:gray;"><i class="fas fa-window-maximize"></i> Website <span style="float: right;font-weight:bold;"><?php echo $row['website']; ?></span></p>
                                <p style="color:gray;"><i class="fas fa-map-marked"></i> Address 1 <span style="float: right;font-weight:bold;"><?php echo $row['address_1']; ?></span></p>
                                <p style="color:gray;"><i class="fas fa-map-marked" style="color: white;"></i> Address 2 <span style="float: right;font-weight:bold;"><?php echo $row['address_2']; ?></span></p>
                                <p style="color:gray;"><i class="fas fa-map-marked" style="color: white;"></i> City <span style="float: right;font-weight:bold;"><?php echo $row['city']; ?></span></p>
                                <p style="color:gray;"><i class="fas fa-map-marked" style="color: white;"></i> State <span style="float: right;font-weight:bold;"><?php echo $row['state']; ?></span></p>
                                <p style="color:gray;"><i class="fas fa-map-marked" style="color: white;"></i> Zipcode <span style="float: right;font-weight:bold;"><?php echo $row['zip']; ?></span></p>
                                <p style="color:gray;"><i class="fas fa-map-marked" style="color: white;"></i> Country <span style="float: right;font-weight:bold;"><?php echo $row['country']; ?></span></p>
                                <p style="color:gray;"><i class="fas fa-phone"></i> Phone <span style="float: right;font-weight:bold;"><?php echo $row['phone']; ?></span></p>
                                <p style="color:gray;"><i class="fas fa-envelope"></i> Alternate Email <span style="float: right;font-weight:bold;"><?php echo $row['alt_email']; ?></span></p>
                        </div>
                    </div>
                    <?php }
                    } ?>
                <?php }else{ ?>
                <div class="profile-page-container">
                    <div class="profile-container">
                        <div class="profileStatus">
                            <span><i class="fas fa-universal-access"></i> Active</span>
                        </div>
                        <?php if(isset($_POST['editAccount']) && $_POST['editAccount'] == 1){ ?>
                            <form method="POST" id="accountDisplay" enctype="multipart/form-data">
                                <div class="photoInput">
                                    <label for="file-input_dp">
                                        <img src="account_information/<?php echo $_SESSION['id']; ?>/dp.png?<?php echo time(); ?>" class="profileChanger"><br>
                                    </label>
                                </div>
                                <input id="file-input_dp" name="dp" type="file" required/>
                            </form>
                        <?php }else{ ?>
                            <img src="account_information/<?php echo $_SESSION['id']; ?>/dp.png?<?php echo time(); ?>" class="profileChanger"><br>
                        <?php } ?>
                        <div class="profileName">
                            <b><?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?><br><span style="color: gray; font-size: 10px;">#<?php echo $_SESSION['id']; ?></span></b><br>
                            <?php if(isset($_POST['editAccount']) && $_POST['editAccount'] == 1){ ?>
                                <button class="profilePreview" form="accountDisplay">Save Display</button>
                            <?php }else{ ?>
                                <button class="profilePreview">Preview Profile</button>
                            <?php } ?>
                        </div><hr>
                        <p style="color:gray;"><i class="fas fa-map-marker-alt"></i> Location <span style="float: right;font-weight:bold;"><?php echo $_SESSION['country']; ?></span></p>
                        <p style="color:gray;"><i class="fas fa-envelope"></i> Email <span style="float: right;font-weight:bold;"><?php echo $_SESSION['email']; ?></span></p>
                        <p style="color:gray;"><i class="fas fa-window-maximize"></i> Website <span style="float: right;font-weight:bold;"><?php echo $_SESSION['website']; ?></span></p>
                        <p style="color:gray;"><i class="fas fa-users"></i> Member since <span style="float: right;font-weight:bold;"><?php echo $_SESSION['date_created']; ?></span></p>
                    </div>
                    <div class="details-container">
                        <?php if(isset($_POST['editAccount']) && $_POST['editAccount'] == 1){ ?>
                            <form method="POST" id="accountDetails">
                                <p style="color:gray;">Account Information </p>
                                <hr>
                                <p style="color:gray;"><i class="fas fa-user-circle"></i> First Name <span style="float: right;"><input type="text" name="fname" value="<?php echo $_SESSION['fname']; ?>" required></span></p>
                                <p style="color:gray;"><i class="fas fa-user-circle" style="color: white;"></i> Middle Name <span style="float: right;"><input type="text" name="mname" value="<?php echo $_SESSION['mname']; ?>"></span></p>
                                <p style="color:gray;"><i class="fas fa-user-circle" style="color: white;"></i> Last Name <span style="float: right;"><input type="text" name="lname" value="<?php echo $_SESSION['lname']; ?>" required></span></p>
                                <p style="color:gray;"><i class="fas fa-window-maximize"></i> Website <span style="float: right;"><input type="text" name="website" value="<?php echo $_SESSION['website']; ?>"></span></p>
                                <p style="color:gray;"><i class="fas fa-map-marked"></i> Address 1 <span style="float: right;"><input type="text" name="address1" value="<?php echo $_SESSION['address_1']; ?>"></span></p>
                                <p style="color:gray;"><i class="fas fa-map-marked" style="color: white;"></i> Address 2 <span style="float: right;"><input type="text" name="address2" value="<?php echo $_SESSION['address_2']; ?>"></span></p>
                                <p style="color:gray;"><i class="fas fa-map-marked" style="color: white;"></i> City <span style="float: right;"><input type="text" name="city" value="<?php echo $_SESSION['city']; ?>"></span></p>
                                <p style="color:gray;"><i class="fas fa-map-marked" style="color: white;"></i> State <span style="float: right;"><input type="text" name="state" value="<?php echo $_SESSION['state']; ?>"></span></p>
                                <p style="color:gray;"><i class="fas fa-map-marked" style="color: white;"></i> Zipcode <span style="float: right;"><input type="text" name="zip" value="<?php echo $_SESSION['zip']; ?>"></span></p>
                                <p style="color:gray;"><i class="fas fa-map-marked" style="color: white;"></i> Country <span style="float: right;"><input type="text" name="country" value="<?php echo $_SESSION['country']; ?>"></span></p>
                                <p style="color:gray;"><i class="fas fa-phone"></i> Phone <span style="float: right;"><input type="text" name="phone" value="<?php echo $_SESSION['phone']; ?>"></span></p>
                                <p style="color:gray;"><i class="fas fa-envelope"></i> Alternate Email <span style="float: right;"><input type="email" name="alt_email" value="<?php echo $_SESSION['alt_email']; ?>"></span></p>
                                <hr>
                                <p style="color:gray;"> Language <span style="float: right;font-weight:bold;">+</span></p>
                                <p style="color:gray;"> Skills <span style="float: right;font-weight:bold;">+</span></p>
                                <p style="color:gray;"> Education <span style="float: right;font-weight:bold;">+</span></p>
                                <p style="color:gray;"> Certification <span style="float: right;font-weight:bold;">+</span></p>
                                <input type="hidden" name="saveProfile" value="1">
                                <button class="profileSave" onclick="submitForms()">Save Profile</button>
                            </form>
                        <?php }else{ ?>
                            <form id="edit" method="POST"><p style="color:gray;">Account Information <span style="float: right;text-decoration: underline;display: inline;"><input type="hidden" name="editAccount" value="1"><a href="#" onclick="document.getElementById('edit').submit()">Update Details</a></span></p></form>
                            <hr>
                            <p style="color:gray;"><i class="fas fa-user-circle"></i> First Name <span style="float: right;font-weight:bold;"><?php echo $_SESSION['fname']; ?></span></p>
                            <p style="color:gray;"><i class="fas fa-user-circle" style="color: white;"></i> Middle Name <span style="float: right;font-weight:bold;"><?php echo $_SESSION['mname']; ?></span></p>
                            <p style="color:gray;"><i class="fas fa-user-circle" style="color: white;"></i> Last Name <span style="float: right;font-weight:bold;"><?php echo $_SESSION['lname']; ?></span></p>
                            <p style="color:gray;"><i class="fas fa-window-maximize"></i> Website <span style="float: right;font-weight:bold;"><?php echo $_SESSION['website']; ?></span></p>
                            <p style="color:gray;"><i class="fas fa-map-marked"></i> Address 1 <span style="float: right;font-weight:bold;"><?php echo $_SESSION['address_1']; ?></span></p>
                            <p style="color:gray;"><i class="fas fa-map-marked" style="color: white;"></i> Address 2 <span style="float: right;font-weight:bold;"><?php echo $_SESSION['address_2']; ?></span></p>
                            <p style="color:gray;"><i class="fas fa-map-marked" style="color: white;"></i> City <span style="float: right;font-weight:bold;"><?php echo $_SESSION['city']; ?></span></p>
                            <p style="color:gray;"><i class="fas fa-map-marked" style="color: white;"></i> State <span style="float: right;font-weight:bold;"><?php echo $_SESSION['state']; ?></span></p>
                            <p style="color:gray;"><i class="fas fa-map-marked" style="color: white;"></i> Zipcode <span style="float: right;font-weight:bold;"><?php echo $_SESSION['zip']; ?></span></p>
                            <p style="color:gray;"><i class="fas fa-map-marked" style="color: white;"></i> Country <span style="float: right;font-weight:bold;"><?php echo $_SESSION['country']; ?></span></p>
                            <p style="color:gray;"><i class="fas fa-phone"></i> Phone <span style="float: right;font-weight:bold;"><?php echo $_SESSION['phone']; ?></span></p>
                            <p style="color:gray;"><i class="fas fa-envelope"></i> Alternate Email <span style="float: right;font-weight:bold;"><?php echo $_SESSION['alt_email']; ?></span></p>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="js/account-script.js"></script>
    </body>
</html>