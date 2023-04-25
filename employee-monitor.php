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

    if($_SESSION['task'] == 'EMPLOYEE' || $_SESSION['id'] == 'SUPERADMIN1030'){

    }else{
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index-style.css">
    <title>Employee | Wash It Yourself Laundry Hub</title>
</head>
<body>
    <div class="app-container">
        <?php include('widgets/header.php'); ?>
        <div class="app-content">
            <?php include('widgets/navigation.php'); ?>
            <div class="projects-section">
                <div class="projects-section-header">
                    <p>Employee Dashboard</p>
                    <button style="height: 35px; width: 150px; border-radius: 10px; border: none; background: black;color:white;font-size:16px;"
                    onclick="generateAllReports()">Export</button>
                </div>
                <div>
                    <style scoped>
                    * {
                    box-sizing: border-box;
                    }
                    .cards {
                    display: grid;
                    grid-template-columns: repeat(5, 1fr) ;
                    grid-gap: 1rem;
                    }

                    .card-wrapper {
                    border: 1px solid silver;
                    border-radius: 0.5rem ;
                    width: 240px;
                    padding: 0.8rem ;
                    box-shadow: 1rem 1rem 1rem 0 rgba(221,221,221,1);
                    margin-left: auto ;
                    margin-right: auto ;
                    }

                    .container {
                    border: 1px solid #eeeeee ;
                    border-radius: 0.15rem ;
                    }
                    .box-1 {
                    background: linear-gradient(to top, #eeeeee 0%,#ffffff 100%);
                    padding: 0.5rem 0 ;

                    }
                    .title{
                    padding: 0.35rem 0.35rem 2.3rem 0.35rem;
                    font-size: 1.15rem;
                    font-weight: bold;
                    text-align: center;
                    }
                    .arrows-and-percentage{
                    display: grid;
                    grid-template-columns: 45% 55%;
                    }
                    .up-down {
                    text-align: center;
                    }
                    .up-down div {
                    display: inline-block ;
                    margin: 1rem auto 0 auto ;
                    width: 2rem ;
                    height: 1rem ;
                    line-height: 1 ;
                    }
                    .up-down .up {
                    border-width: 0 1rem 1rem 1rem ;
                    border-style: solid;
                    border-color: transparent transparent green transparent;
                    }
                    .up-down .down {
                    border-width: 1rem 1rem 0 1rem ;
                    border-style: solid;
                    border-color: red transparent transparent transparent;
                    }
                    .up-only .down {
                        display: none ;
                    }
                    .down-only .up {
                        display: none ;
                    }

                    .percentage {
                    font-size: 2.5rem;
                    text-align: center ;
                    }

                    .box-2 {
                    display: grid;
                    grid-template-columns: 50% 50%;
                    padding: 1rem 0 ;
                    }
                    .box-2 > div {
                    text-align: center;
                    }
                    .volume {
                    font-size: 0.8rem;
                    }
                    .year {
                    font-size: 12px;
                    color: silver;
                    }
                    </style>
                    <div class="cards">
                            
                        <?php 
                            $sql = "SELECT SUM(total) AS yesterday FROM appointment_tb WHERE date_complete = '".date('Y-m-d', strtotime('-1 day'))."' AND status = 3;";
                            $sql1 = "SELECT SUM(total) AS daily FROM appointment_tb WHERE date_complete = '".date('Y-m-d')."' AND status = 3;";
                            $result = mysqli_query($conn, $sql);
                            $result1 = mysqli_query($conn, $sql1);
                            if (mysqli_num_rows($result) > 0 && mysqli_num_rows($result1) > 0) {
                                while($row = mysqli_fetch_array($result)) {
                                    while($row1 = mysqli_fetch_array($result1)) {
                                    ?>
                                        <div class="card-wrapper">
                                            <div class="container">
                                                <div class="box-1">
                                                    <div class="title">
                                                        Daily Sales
                                                    </div>
                                                    <div class="arrows-and-percentage">
                                                        <?php 
                                                            $daily = intval($row1['daily'])+1;
                                                            $yesterday = intval($row['yesterday'])+1;
                                                            if($daily > $yesterday){
                                                                echo '<div class="up-down up-only">';
                                                                echo '<div class="up"></div>';
                                                                echo '</div>';
                                                            }else{
                                                                echo '<div class="up-down down-only">';
                                                                echo '<div class="down"></div>';
                                                                echo '</div>';
                                                            }
                                                        ?>
                                                        <div class="percentage">
                                                            <?php 
                                                                if($yesterday != 0){
                                                                    $percentage_increase = (($daily - $yesterday) / $yesterday);
                                                                }else{
                                                                    $percentage_increase = 100;
                                                                }
                                                                echo abs(round($percentage_increase))."%";
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="box-2">
                                                    <div class="volume volume-1">
                                                        <?php echo number_format($row['yesterday']); ?>
                                                    </div>
                                                    <div class="volume volume-2">
                                                        <?php echo number_format($row1['daily']); ?>
                                                    </div>
                                                    <div class="year year-1">
                                                        Yesterday
                                                    </div>
                                                    <div class="year year-2">
                                                        Today
                                                    </div>
                                                </div>
                                                <button id="dailysalesbtn" style="width:100%;background:black;color:white;">Show Summary</button>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                }
                            }
                        ?>  

                        <?php 
                        // Get current week and previous week dates
                        $current_week_start = date('Y-m-d', strtotime('monday this week'));
                        $current_week_end = date('Y-m-d', strtotime('sunday this week'));
                        $previous_week_start = date('Y-m-d', strtotime('monday last week'));
                        $previous_week_end = date('Y-m-d', strtotime('sunday last week'));

                        // Get current week and previous week sales totals
                        $sql = "SELECT SUM(total) AS previous_week FROM appointment_tb WHERE date_complete >= '$previous_week_start' AND date_complete <= '$previous_week_end' AND status = 3;";
                        $sql1 = "SELECT SUM(total) AS current_week FROM appointment_tb WHERE date_complete >= '$current_week_start' AND date_complete <= '$current_week_end' AND status = 3;";
                        $result = mysqli_query($conn, $sql);
                        $result1 = mysqli_query($conn, $sql1);

                        if (mysqli_num_rows($result) > 0 && mysqli_num_rows($result1) > 0) {
                            while($row = mysqli_fetch_array($result)) {
                                while($row1 = mysqli_fetch_array($result1)) {
                                    ?>
                                    <div class="card-wrapper">
                                        <div class="container">
                                            <div class="box-1">
                                                <div class="title">
                                                    Weekly Sales
                                                </div>
                                                <div class="arrows-and-percentage">
                                                    <?php 
                                                    $current_week_total = intval($row1['current_week'])+1;
                                                    $previous_week_total = intval($row['previous_week'])+1;
                                                    if($current_week_total > $previous_week_total){
                                                        echo '<div class="up-down up-only">';
                                                        echo '<div class="up"></div>';
                                                        echo '</div>';
                                                    }else{
                                                        echo '<div class="up-down down-only">';
                                                        echo '<div class="down"></div>';
                                                        echo '</div>';
                                                    }
                                                    ?>
                                                    <div class="percentage">
                                                        <?php 
                                                        if($previous_week_total != 0){
                                                            $percentage_increase = (($current_week_total - $previous_week_total) / $previous_week_total);
                                                        }else{
                                                            $percentage_increase = 100;
                                                        }
                                                        echo abs(round($percentage_increase))."%";
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-2">
                                                <div class="volume volume-1">
                                                    <?php echo number_format($previous_week_total); ?>
                                                </div>
                                                <div class="volume volume-2">
                                                    <?php echo number_format($current_week_total); ?>
                                                </div>
                                                <div class="year year-1">
                                                    <?php echo date('M d, Y', strtotime($previous_week_start)); ?> - <?php echo date('M d, Y', strtotime($previous_week_end)); ?>
                                                </div>
                                                <div class="year year-2">
                                                    <?php echo date('M d, Y', strtotime($current_week_start)); ?> - <?php echo date('M d, Y', strtotime($current_week_end)); ?>
                                                </div>
                                            </div>
                                            <button id="weeklysalesbtn" style="width:100%;background:black;color:white;">Show Summary</button>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>


                        <?php 
                        // Get current month and previous month dates
                        $current_month_start = date('Y-m-01');
                        $current_month_end = date('Y-m-t');
                        $previous_month_start = date('Y-m-01', strtotime('-1 month'));
                        $previous_month_end = date('Y-m-t', strtotime('-1 month'));

                        // Get current month and previous month sales totals
                        $sql = "SELECT SUM(total) AS previous_month FROM appointment_tb WHERE date_complete >= '$previous_month_start' AND date_complete <= '$previous_month_end' AND status = 3;";
                        $sql1 = "SELECT SUM(total) AS current_month FROM appointment_tb WHERE date_complete >= '$current_month_start' AND date_complete <= '$current_month_end' AND status = 3;";
                        $result = mysqli_query($conn, $sql);
                        $result1 = mysqli_query($conn, $sql1);

                        if (mysqli_num_rows($result) > 0 && mysqli_num_rows($result1) > 0) {
                            while($row = mysqli_fetch_array($result)) {
                                while($row1 = mysqli_fetch_array($result1)) {
                                    ?>
                                    <div class="card-wrapper">
                                        <div class="container">
                                            <div class="box-1">
                                                <div class="title">
                                                    Monthly Sales
                                                </div>
                                                <div class="arrows-and-percentage">
                                                    <?php 
                                                    $current_month_total = intval($row1['current_month'])+1;
                                                    $previous_month_total = intval($row['previous_month'])+1;
                                                    if($current_month_total > $previous_month_total){
                                                        echo '<div class="up-down up-only">';
                                                        echo '<div class="up"></div>';
                                                        echo '</div>';
                                                    }else{
                                                        echo '<div class="up-down down-only">';
                                                        echo '<div class="down"></div>';
                                                        echo '</div>';
                                                    }
                                                    ?>
                                                    <div class="percentage">
                                                        <?php 
                                                        if($previous_month_total != 0){
                                                            $percentage_increase = (($current_month_total - $previous_month_total) / $previous_month_total);
                                                        }else{
                                                            $percentage_increase = 100;
                                                        }
                                                        echo abs(round($percentage_increase))."%";
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-2">
                                                <div class="volume volume-1">
                                                    <?php echo number_format($previous_month_total); ?>
                                                </div>
                                                <div class="volume volume-2">
                                                    <?php echo number_format($current_month_total); ?>
                                                </div>
                                                <div class="year year-1">
                                                    <?php echo date('F Y', strtotime($previous_month_start)); ?>
                                                </div>
                                                <div class="year year-2">
                                                    <?php echo date('F Y', strtotime($current_month_start)); ?>
                                                </div>
                                            </div>
                                            <button id="monthlysalesbtn" style="width:100%;background:black;color:white;">Show Summary</button>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>


                        <?php 
                        // Get current year and previous year dates
                        $current_year_start = date('Y-01-01');
                        $current_year_end = date('Y-12-31');
                        $previous_year_start = date('Y-01-01', strtotime('-1 year'));
                        $previous_year_end = date('Y-12-31', strtotime('-1 year'));

                        // Get current year and previous year sales totals
                        $sql = "SELECT SUM(total) AS previous_year FROM appointment_tb WHERE date_complete >= '$previous_year_start' AND date_complete <= '$previous_year_end' AND status = 3;";
                        $sql1 = "SELECT SUM(total) AS current_year FROM appointment_tb WHERE date_complete >= '$current_year_start' AND date_complete <= '$current_year_end' AND status = 3;";
                        $result = mysqli_query($conn, $sql);
                        $result1 = mysqli_query($conn, $sql1);

                        if (mysqli_num_rows($result) > 0 && mysqli_num_rows($result1) > 0) {
                            while($row = mysqli_fetch_array($result)) {
                                while($row1 = mysqli_fetch_array($result1)) {
                                    ?>
                                    <div class="card-wrapper">
                                        <div class="container">
                                            <div class="box-1">
                                                <div class="title">
                                                    Annual Sales
                                                </div>
                                                <div class="arrows-and-percentage">
                                                    <?php 
                                                    $current_year_total = intval($row1['current_year']);
                                                    $previous_year_total = intval($row['previous_year']);
                                                    if($current_year_total > $previous_year_total){
                                                        echo '<div class="up-down up-only">';
                                                        echo '<div class="up"></div>';
                                                        echo '</div>';
                                                    }else{
                                                        echo '<div class="up-down down-only">';
                                                        echo '<div class="down"></div>';
                                                        echo '</div>';
                                                    }
                                                    ?>
                                                    <div class="percentage">
                                                        <?php 
                                                        if($previous_year_total != 0){
                                                            $percentage_increase = (($current_year_total - $previous_year_total) / $previous_year_total);
                                                        }else{
                                                            $percentage_increase = 100;
                                                        }
                                                        echo abs(round($percentage_increase))."%";
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-2">
                                                <div class="volume volume-1">
                                                    <?php echo number_format($previous_year_total); ?>
                                                </div>
                                                <div class="volume volume-2">
                                                    <?php echo number_format($current_year_total); ?>
                                                </div>
                                                <div class="year year-1">
                                                    <?php echo date('Y', strtotime($previous_year_start)); ?>
                                                </div>
                                                <div class="year year-2">
                                                    <?php echo date('Y', strtotime($current_year_start)); ?>
                                                </div>
                                            </div>
                                            <button id="annualsalesbtn" style="width:100%;background:black;color:white;">Show Summary</button>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>


                        <?php 
                        // Get current year and previous year dates
                        $current_year_start = date('Y-01-01');
                        $current_year_end = date('Y-12-31');
                        $previous_year_start = date('Y-01-01', strtotime('-1 year'));
                        $previous_year_end = date('Y-12-31', strtotime('-1 year'));

                        // Get current year and previous year sales totals
                        $sql_less_one_month = "SELECT COUNT(*) AS less_one_month FROM appointment_tb WHERE date_complete >= DATE_SUB(NOW(), INTERVAL 1 MONTH) AND status = 3;";
                        $sql_more_one_month = "SELECT COUNT(*) AS more_one_month FROM appointment_tb WHERE date_complete < DATE_SUB(NOW(), INTERVAL 1 MONTH) AND status = 3;";
                        $result_less_one_month = mysqli_query($conn, $sql_less_one_month);
                        $result_more_one_month = mysqli_query($conn, $sql_more_one_month);

                        if (mysqli_num_rows($result_less_one_month) > 0 && mysqli_num_rows($result_more_one_month) > 0) {
                            while($row_less_one_month = mysqli_fetch_array($result_less_one_month)) {
                                while($row_more_one_month = mysqli_fetch_array($result_more_one_month)) {
                                    ?>
                                    <div class="card-wrapper">
                                        <div class="container">
                                            <div class="box-1">
                                                <div class="title">
                                                    Transactions
                                                </div>
                                                <div class="arrows-and-percentage">
                                                    <?php 
                                                    $less_one_month = intval($row_less_one_month['less_one_month']);
                                                    $more_one_month = intval($row_more_one_month['more_one_month']);
                                                    if($less_one_month > $more_one_month){
                                                        echo '<div class="up-down up-only">';
                                                        echo '<div class="up"></div>';
                                                        echo '</div>';
                                                    }else{
                                                        echo '<div class="up-down down-only">';
                                                        echo '<div class="down"></div>';
                                                        echo '</div>';
                                                    }
                                                    ?>
                                                    <div class="percentage">
                                                        <?php 
                                                        $total_records = $less_one_month + $more_one_month;
                                                        echo $total_records;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-2">
                                                <div class="volume volume-1">
                                                    <?php echo $more_one_month; ?>
                                                </div>
                                                <div class="volume volume-2">
                                                    <?php echo $less_one_month; ?>
                                                </div>
                                                <div class="year year-1">
                                                    > 1 Month
                                                </div>
                                                <div class="year year-2">
                                                    < 1 Month
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>

                    </div>
                </div>

                <div id="dailysales" style="display:none;transition: all 0.5s ease;">
                    <div class="projects-section-header" style="margin-top: 100px;">
                        <p>Daily Sales Summary</p>
                        <button style="height: 35px; width: 150px; border-radius: 10px; border: none; background: black;color:white;font-size:16px;"
                    onclick="generatePDF('dailysalesinner')">Export</button>
                    </div>
                    <div id="dailysalesinner">
                        <style scoped>
                            body{
                            background-color: #eee; 
                            }

                            table th , table td{
                            text-align: center;
                            padding:10px;
                            }

                            table tr:nth-child(even){
                            background-color: #BEF2F5;
                            }
                        </style>
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Appointment Date</th>
                                    <th>Date Created</th>
                                    <th>Date Completed</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sql = "SELECT * FROM appointment_tb WHERE date_complete = '".date('Y-m-d')."' AND status = 3;";
                                $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_array($result)) {
                                ?>
                                            <tr>
                                                <td><?php echo $row['order_id']; ?></td>
                                                <td><?php echo $row['cust_id']; ?></td>
                                                <td><?php echo $row['cust_name']; ?></td>
                                                <td><?php echo $row['appointment']; ?></td>
                                                <td><?php echo $row['date']; ?></td>
                                                <td><?php echo $row['date_complete']; ?></td>
                                                <td><?php echo number_format($row['total']); ?></td>
                                            </tr>
                                <?php
                                        }
                                    } else {
                                ?>
                                        <tr>
                                            <td colspan="6">No transaction found.</td>
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="weeklysales" style="display:none;transition: all 0.5s ease;">
                    <div class="projects-section-header" style="margin-top: 100px;">
                        <p>Weekly Sales Summary</p>
                        <button style="height: 35px; width: 150px; border-radius: 10px; border: none; background: black;color:white;font-size:16px;"
                        onclick="generatePDF('weeklysalesinner')">Export</button>
                    </div>
                    <div id="weeklysalesinner">
                        <style scoped>
                            body{
                            background-color: #eee; 
                            }
                            table th , table td{
                            text-align: center;
                            padding:10px;
                            }

                            table tr:nth-child(even){
                            background-color: #BEF2F5;
                            }
                        </style>
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Appointment Date</th>
                                    <th>Date Created</th>
                                    <th>Date Completed</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $current_week_start = date('Y-m-d', strtotime('monday this week'));
                                $current_week_end = date('Y-m-d', strtotime('sunday this week'));
                                $sql = "SELECT * FROM appointment_tb WHERE date_complete >= '$current_week_start' AND date_complete <= '$current_week_end' AND status = 3;";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_array($result)) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['order_id']; ?></td>
                                            <td><?php echo $row['cust_id']; ?></td>
                                            <td><?php echo $row['cust_name']; ?></td>
                                            <td><?php echo $row['appointment']; ?></td>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><?php echo $row['date_complete']; ?></td>
                                            <td><?php echo number_format($row['total']); ?></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                        <tr>
                                            <td colspan="6">No transaction found.</td>
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="monthlysales" style="display:none;transition: all 0.5s ease;">
                    <div class="projects-section-header" style="margin-top: 100px;">
                        <p>Monthly Sales Summary</p>
                        <button style="height: 35px; width: 150px; border-radius: 10px; border: none; background: black;color:white;font-size:16px;"
                        onclick="generatePDF('monthlysalesinner')">Export</button>
                    </div>
                    <div id="monthlysalesinner">
                        <style scoped>
                            body{
                            background-color: #eee; 
                            }

                            table th , table td{
                            text-align: center;
                            padding:10px;
                            }

                            table tr:nth-child(even){
                            background-color: #BEF2F5;
                            }
                        </style>
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Appointment Date</th>
                                    <th>Date Created</th>
                                    <th>Date Completed</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $current_month_start = date('Y-m-01');
                                $current_month_end = date('Y-m-t');
                                $sql = "SELECT * FROM appointment_tb WHERE date_complete >= '$current_month_start' AND date_complete <= '$current_month_end' AND status = 3;";
                                $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_array($result)) {
                                ?>
                                            <tr>
                                                <td><?php echo $row['order_id']; ?></td>
                                                <td><?php echo $row['cust_id']; ?></td>
                                                <td><?php echo $row['cust_name']; ?></td>
                                                <td><?php echo $row['appointment']; ?></td>
                                                <td><?php echo $row['date']; ?></td>
                                                <td><?php echo $row['date_complete']; ?></td>
                                                <td><?php echo number_format($row['total']); ?></td>
                                            </tr>
                                <?php
                                        }
                                    } else {
                                ?>
                                        <tr>
                                            <td colspan="6">No transaction found.</td>
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="annualsales" style="display:none;transition: all 0.5s ease;">
                    <div class="projects-section-header" style="margin-top: 100px;">
                        <p>Annual Sales Summary</p>
                        <button style="height: 35px; width: 150px; border-radius: 10px; border: none; background: black;color:white;font-size:16px;"
                        onclick="generatePDF('annualsalesinner')">Export</button>
                    </div>
                    <div id="annualsalesinner">
                        <style scoped>
                            body{
                            background-color: #eee; 
                            }
                            table {
                                width: 100%;
                            }
                            table th , table td{
                            text-align: center;
                            padding:10px;
                            }

                            table tr:nth-child(even){
                            background-color: #BEF2F5;
                            }
                        </style>
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Appointment Date</th>
                                    <th>Date Created</th>
                                    <th>Date Completed</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $current_year_start = date('Y-01-01');
                                $current_year_end = date('Y-12-31');
                                $sql = "SELECT * FROM appointment_tb WHERE date_complete >= '$current_year_start' AND date_complete <= '$current_year_end' AND status = 3;";
                                $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_array($result)) {
                                ?>
                                            <tr>
                                                <td><?php echo $row['order_id']; ?></td>
                                                <td><?php echo $row['cust_id']; ?></td>
                                                <td><?php echo $row['cust_name']; ?></td>
                                                <td><?php echo $row['appointment']; ?></td>
                                                <td><?php echo $row['date']; ?></td>
                                                <td><?php echo $row['date_complete']; ?></td>
                                                <td><?php echo number_format($row['total']); ?></td>
                                            </tr>
                                <?php
                                        }
                                    } else {
                                ?>
                                        <tr>
                                            <td colspan="6">No transaction found.</td>
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <script>
                    function generatePDF(id) {
                    // Get the HTML content of the div
                    var content = document.getElementById(id).innerHTML;

                    // Create a new window with the PDF generation API
                    var win = window.open('', '', 'height=700,width=700');

                    // Write the HTML content to the new window
                    win.document.write('<html><head><title>PDF</title></head><body>');
                    win.document.write(content);
                    win.document.write('</body></html>');

                    // Generate the PDF
                    win.document.close();
                    win.print();
                    }
                </script>
                <script>
                    function generateAllReports() {
                    // Get the HTML content of the div
                    var dailysalesinner = document.getElementById('dailysalesinner').innerHTML;
                    var weeklysalesinner = document.getElementById('weeklysalesinner').innerHTML;
                    var monthlysalesinner = document.getElementById('monthlysalesinner').innerHTML;
                    var annualsalesinner = document.getElementById('annualsalesinner').innerHTML;

                    // Create a new window with the PDF generation API
                    var win = window.open('', '', 'height=700,width=700');

                    // Write the HTML content to the new window
                    win.document.write('<html><head><title>PDF</title></head><body>');
                    win.document.write(dailysalesinner);
                    win.document.write(weeklysalesinner);
                    win.document.write(monthlysalesinner);
                    win.document.write(annualsalesinner);
                    win.document.write('</body></html>');

                    // Generate the PDF
                    win.document.close();
                    win.print();
                    }
                </script>
                <script>
                    // Get the buttons and div elements
                    const dailySalesBtn = document.getElementById('dailysalesbtn');
                    const weeklySalesBtn = document.getElementById('weeklysalesbtn');
                    const monthlySalesBtn = document.getElementById('monthlysalesbtn');
                    const annualSalesBtn = document.getElementById('annualsalesbtn');
                    const dailySalesDiv = document.getElementById('dailysales');
                    const weeklySalesDiv = document.getElementById('weeklysales');
                    const monthlySalesDiv = document.getElementById('monthlysales');
                    const annualSalesDiv = document.getElementById('annualsales');

                    // Hide the div elements by default
                    dailySalesDiv.style.display = 'none';
                    weeklySalesDiv.style.display = 'none';
                    monthlySalesDiv.style.display = 'none';
                    annualSalesDiv.style.display = 'none';

                    // Attach click events to the buttons
                    dailySalesBtn.addEventListener('click', function() {
                        // Hide all divs first
                        dailySalesDiv.style.display = 'none';
                        weeklySalesDiv.style.display = 'none';
                        monthlySalesDiv.style.display = 'none';
                        annualSalesDiv.style.display = 'none';
                        // Show the daily sales div
                        dailySalesDiv.style.display = 'block';
                    });

                    weeklySalesBtn.addEventListener('click', function() {
                        // Hide all divs first
                        dailySalesDiv.style.display = 'none';
                        weeklySalesDiv.style.display = 'none';
                        monthlySalesDiv.style.display = 'none';
                        annualSalesDiv.style.display = 'none';
                        // Show the monthly sales div
                        weeklySalesDiv.style.display = 'block';
                    });

                    monthlySalesBtn.addEventListener('click', function() {
                        // Hide all divs first
                        dailySalesDiv.style.display = 'none';
                        weeklySalesDiv.style.display = 'none';
                        monthlySalesDiv.style.display = 'none';
                        annualSalesDiv.style.display = 'none';
                        // Show the monthly sales div
                        monthlySalesDiv.style.display = 'block';
                    });

                    annualSalesBtn.addEventListener('click', function() {
                        // Hide all divs first
                        dailySalesDiv.style.display = 'none';
                        weeklySalesDiv.style.display = 'none';
                        monthlySalesDiv.style.display = 'none';
                        annualSalesDiv.style.display = 'none';
                        // Show the annual sales div
                        annualSalesDiv.style.display = 'block';
                    });
                </script>

                
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/index-script.js"></script>
</html>