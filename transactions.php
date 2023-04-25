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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="asset/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index-style.css">
    <title>Transaction | Wash It Yourself Laundry Hub</title>
</head>
<body>
    <div class="app-container">
        <?php include('widgets/header.php'); ?>
        <div class="app-content">
            <?php include('widgets/navigation.php'); ?>
            <div class="projects-section">
                <div class="projects-section-header">
                    <p>Transaction History</p>
                </div>
                <div class="projects-section-line">
                    <div class="view-actions">
                        <button class="view-btn list-view" title="List View">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-list">
                                <line x1="8" y1="6" x2="21" y2="6" />
                                <line x1="8" y1="12" x2="21" y2="12" />
                                <line x1="8" y1="18" x2="21" y2="18" />
                                <line x1="3" y1="6" x2="3.01" y2="6" />
                                <line x1="3" y1="12" x2="3.01" y2="12" />
                                <line x1="3" y1="18" x2="3.01" y2="18" />
                            </svg>
                        </button>
                        <button class="view-btn grid-view active" title="Grid View">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-grid">
                                <rect x="3" y="3" width="7" height="7" />
                                <rect x="14" y="3" width="7" height="7" />
                                <rect x="14" y="14" width="7" height="7" />
                                <rect x="3" y="14" width="7" height="7" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="project-boxes jsGridView">
                    <?php
                    $sql = "SELECT * FROM appointment_tb WHERE cust_id = '".$_SESSION['id']."' AND status = 3;";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_array($result)) {
                        ?>
                            <div class="project-box-wrapper">
                                <div class="project-box" style="background-color: <?php if($row['status'] == 3){echo "#c8f7dc";}else if($row['status'] == 2){echo "#fee4cb";}else if($row['status'] == 1){ echo "#ffd3e2";}?>;">
                                    <div class="project-box-header">
                                        <span><?php echo date("F j, Y", strtotime($row['appointment'])); ?></span>
                                    </div>
                                    <div class="project-box-content-header">
                                        <p class="box-content-header"><?php echo $row['service']; ?> <code>#<?php echo $row['order_id']; ?></code></p>
                                        <p class="box-content-subheader">
                                            <?php if($row['payment_method'] == 'otc'){ echo 'Over-the-counter'; }else{ echo 'Card/ePayment'; } ?> (P<?php echo number_format($row['total']); ?>)
                                        </p>
                                    </div>
                                    <div class="box-progress-wrapper">
                                        <p class="box-progress-header"><?php if($row['status'] == 3){echo "Complete";}else{echo "Progress";}?></p>
                                        <div class="box-progress-bar">
                                            <span class="box-progress" style="width: <?php if($row['status'] == 3){echo "100";}else if($row['status'] == 2){echo "60";}else if($row['status'] == 1){ echo "20";}?>%; background-color: <?php if($row['status'] == 3){echo "#34c471";}else if($row['status'] == 2){echo "#ff942e";}else if($row['status'] == 1){ echo "#df3670";}?>"></span>
                                        </div>
                                        <p class="box-progress-percentage"><?php if($row['status'] == 3){echo "100";}else if($row['status'] == 2){echo "60";}else if($row['status'] == 1){ echo "20";}?>%</p>
                                    </div>
                                    <div class="project-box-footer">
                                        <div class="participants">
                                            
                                                <?php if($row['status'] == 3){ ?>
                                                    <button onclick="window.location.href='index.php?getinvoiceonly=<?php echo $row['order_id']; ?>&total=<?php echo $row['total']; ?>&date=<?php echo $row['date']; ?>'" class="add-participant" style="border-radius:10px;font-style:bold;width: auto;padding: 5px;color: <?php if($row['status'] == 3){echo "#34c471";}else if($row['status'] == 2){echo "#ff942e";}else if($row['status'] == 1){ echo "#df3670";}?>;">
                                                        Get Invoice
                                                    </button>
                                                <?php } ?>
                                            
                                        </div>
                                        <div class="days-left" style="color: <?php if($row['status'] == 3){echo "#239B56";}else if($row['status'] == 2){echo "#BA4A00";}else if($row['status'] == 1){ echo "#BA4A00";}?>;">
                                            Thank you for trusting us!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/index-script.js"></script>
</html>