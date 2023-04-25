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

    if(isset($_GET['appointmentsave'])){
        notification($_SESSION['id'], $_SESSION['fname']." ".$_SESSION['lname'], "Appointment Save.");
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
    <link rel="shortcut icon" href="asset/img/favicon.ico" type="image/x-icon">
    <title>Home | Wash It Yourself Laundry Hub</title>
</head>
<body>
    <div class="app-container">
        <?php include('widgets/header.php'); ?>
        <div class="app-content">
            <?php include('widgets/navigation.php'); ?>
            <div class="projects-section">
                <div class="projects-section-header">
                    <p>Dashboard</p>
                    <button style="height: 35px; width: 150px; border-radius: 10px; border: none; background: black;color:white;font-size:16px;"
                    onclick="window.location.href='schedulebooking.php'">Book</button>
                </div>
                <div class="projects-section-line">
                    <div class="projects-status">
                        <div class="item-status">
                            <span class="status-number">
                                <?php 
                                    $sql = "SELECT COUNT(*) as count FROM appointment_tb WHERE cust_id = '".$_SESSION['id']."' AND NOT status = 3;";
                                    $result = mysqli_query($conn, $sql);
                                    $count = mysqli_fetch_assoc($result)['count'];
                                    echo $count;
                                ?>
                            </span>
                            <span class="status-type">My Appointments</span>
                        </div>
                    </div>
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
                $sql = "SELECT * FROM appointment_tb WHERE cust_id = '".$_SESSION['id']."' AND NOT status = 3;";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_array($result)) {
                        $appointmentDate = new DateTime($row['appointment']);
                        $today = new DateTime();
                        $interval = $today->diff($appointmentDate);
                        $days_before = $interval->format('%a');
                        if ($interval->invert) {
                            $days_before = -$days_before;
                        }
                    ?>
                        <div class="project-box-wrapper">
                            <div class="project-box" style="background-color: <?php if($row['status'] == 3){echo "#c8f7dc";}else if($row['status'] == 2){echo "#fee4cb";}else if($row['status'] == 1){ echo "#ffd3e2";}?>;">
                                <div class="project-box-header">
                                    <span><?php echo date("F j, Y", strtotime($row['appointment'])); ?></span>
                                    <div class="more-wrapper">
                                        <?php if($row['status'] == 1){ ?>
                                            <button onclick="window.location.href='checkout.php?cancelAppointment=<?php echo $row['order_id']; ?>'" class="add-participant" style="border-radius:10px;font-style:bold;width: auto;padding: 5px;color: #BA4A00;">
                                                Cancel
                                            </button>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="project-box-content-header">
                                    <p class="box-content-header"><?php echo $row['service']; ?> <code>#<?php echo $row['order_id']; ?></code></p>
                                    <p class="box-content-subheader">
                                        <?php if($row['payment_method'] == 'otc'){ echo 'Over-the-counter'; }else{ echo 'Card/ePayment'; } ?> (P<?php echo number_format($row['total']); ?>)
                                    </p>
                                </div>
                                <div class="box-progress-wrapper">
                                    <p class="box-progress-header"><?php if($row['status'] == 3){echo "Complete";}else if($row['status'] == 2){echo "Progress (Ready for Laundry)";}else{echo "Progress (Awaiting for Payment)";}?></p>
                                    <div class="box-progress-bar">
                                        <span class="box-progress" style="width: <?php if($row['status'] == 3){echo "100";}else if($row['status'] == 2){echo "60";}else if($row['status'] == 1){ echo "20";}?>%; background-color: <?php if($row['status'] == 3){echo "#34c471";}else if($row['status'] == 2){echo "#ff942e";}else if($row['status'] == 1){ echo "#df3670";}?>"></span>
                                    </div>
                                    <p class="box-progress-percentage"><?php if($row['status'] == 3){echo "100";}else if($row['status'] == 2){echo "60";}else if($row['status'] == 1){ echo "20";}?>%</p>
                                </div>
                                <div class="project-box-footer">
                                    <div class="participants">
                                        
                                            <?php 
                                            if($days_before >= 0){
                                                if($row['status'] == 3){ ?>
                                                <button onclick="window.location.href='index.php?getinvoiceonly=<?php echo $row['order_id']; ?>&total=<?php echo $row['total']; ?>&date=<?php echo $row['date']; ?>'" class="add-participant" style="border-radius:10px;font-style:bold;width: auto;padding: 5px;color: <?php if($row['status'] == 3){echo "#34c471";}else if($row['status'] == 2){echo "#ff942e";}else if($row['status'] == 1){ echo "#df3670";}?>;">
                                                    Get Invoice
                                                </button>
                                            <?php }else if($row['status'] == 2){ ?>
                                                <button onclick="window.location.href='index.php?getqrcode=<?php echo $row['order_id']; ?>&getinvoice=<?php echo $row['order_id']; ?>&total=<?php echo $row['total']; ?>&date=<?php echo $row['date']; ?>'" class="add-participant" style="border-radius:10px;font-style:bold;width: auto;padding: 5px;color: <?php if($row['status'] == 3){echo "#34c471";}else if($row['status'] == 2){echo "#ff942e";}else if($row['status'] == 1){ echo "#df3670";}?>;">
                                                    Get Invoice
                                                </button>
                                                <button onclick="window.location.href='index.php?getqrcode=<?php echo $row['order_id']; ?>'" class="add-participant" style="border-radius:10px;font-style:bold;width: auto;padding: 5px;color: <?php if($row['status'] == 3){echo "#34c471";}else if($row['status'] == 2){echo "#ff942e";}else if($row['status'] == 1){ echo "#df3670";}?>;">
                                                    Download QR Code
                                                </button>
                                                <button onclick="window.location.href='index.php?getqrcode=<?php echo $row['order_id']; ?>'" class="add-participant" style="border-radius:10px;font-style:bold;width: auto;padding: 5px;color: <?php if($row['status'] == 3){echo "#34c471";}else if($row['status'] == 2){echo "#ff942e";}else if($row['status'] == 1){ echo "#df3670";}?>;">
                                                    Request Refund
                                                </button>
                                            <?php }else{ ?>
                                                <button onclick="window.location.href='checkout.php?transaction=<?php echo $row['order_id']; ?>'" class="add-participant" style="border-radius:10px;font-style:bold;width: auto;padding: 5px;color: <?php if($row['status'] == 3){echo "#34c471";}else if($row['status'] == 2){echo "#ff942e";}else if($row['status'] == 1){ echo "#df3670";}?>;">
                                                    Pay Now
                                                </button>
                                            <?php 
                                                } 
                                            }else{
                                                ?>
                                                <button onclick="window.location.href='checkout.php?pay=<?php echo $row['order_id']; ?>'" class="add-participant" style="border-radius:10px;font-style:bold;width: auto;padding: 5px;color: <?php if($row['status'] == 3){echo "#34c471";}else if($row['status'] == 2){echo "#ff942e";}else if($row['status'] == 1){ echo "#df3670";}?>;">
                                                    Reschedule
                                                </button>
                                                <?php
                                            }
                                            ?>
                                        
                                    </div>
                                    <div class="days-left" style="color: <?php if($row['status'] == 3){echo "#239B56";}else if($row['status'] == 2){echo "#BA4A00";}else if($row['status'] == 1){ echo "#BA4A00";}?>;">
                                        <?php 
                                            if($days_before == 0){
                                                echo 'Today';
                                            }else if($days_before >= 0){
                                                echo $days_before . ' Day(s) Left';
                                            }else{
                                                echo "Missed Appointment";
                                            }
                                        ?>
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