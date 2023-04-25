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
    <title>Schedule | Wash It Yourself Laundry Hub</title>
</head>
<body>
    <div class="app-container">
        <?php include('widgets/header.php'); ?>
        <div class="app-content">
            <?php include('widgets/navigation.php'); ?>
            <div class="projects-section">
                <div class="projects-section-header">
                    <p>Schedule Availability</p>
                    <p class="time">
                        <style scoped>
                            form {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            margin-top: 20px;
                            }

                            input[type="month"] {
                            padding: 10px;
                            font-size: 16px;
                            border: 2px solid #ccc;
                            border-radius: 4px;
                            margin-right: 10px;
                            }

                            input[type="submit"], input[type="button"] {
                            padding: 10px 20px;
                            font-size: 16px;
                            background-color: #333;
                            color: white;
                            border: none;
                            border-radius: 4px;
                            cursor: pointer;
                            }

                            input[type="submit"]:hover, input[type="button"]:hover {
                            background-color: #303030;
                            }
                        </style>
                        <form method="post">
                            <input type="month" name="scopeSched" value="<?php echo date('Y-m'); ?>" min="<?php echo date('Y-m'); ?>" max="<?php echo date('Y-m', strtotime('+3 month')); ?>">
                            <input type="submit" name="searchSched" value="Search">
                            <input type="button" value="Book" style="margin-left: 10px;" onclick='window.location.href="schedulebooking.php"'>
                        </form>
                    </p>
                </div>
                
                <div>
                    <style scoped>
                        table {
                        border-collapse: collapse;
                        width: 100%;
                        margin-bottom: 1em;
                        }

                        th {
                        background-color: #f2f2f2;
                        color: #333;
                        text-align: left;
                        padding: 0.5em;
                        border: 1px solid #ccc;
                        }

                        td {
                        text-align: center;
                        padding: 50px;
                        border: 1px solid #ccc;
                        }

                        td.green {
                        background-color: #bdecb6;
                        }

                        td.yellow {
                        background-color: #fff9b1;
                        }

                        td.orange {
                        background-color: #ffd5a5;
                        }

                        td.red {
                        background-color: #ff9c9c;
                        }

                    </style>
                    <?php 
                    $sql = "SELECT appointment, COUNT(*) as count FROM appointment_tb GROUP BY appointment";
                    $result = mysqli_query($conn, $sql);
                    $appointments = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $appointments[$row['appointment']] = $row['count'];
                    }
                    if (isset($_POST['searchSched'])) {
                        $scopeSched = $_POST['scopeSched'];
                        list($year, $month) = explode('-', $scopeSched);
                    }else{
                        $year = date("Y");
                        $month = date("m");
                    }
                    $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                    echo "<table>";
                    echo "<thead><tr><th colspan='7'>" . date('F', mktime(0, 0, 0, $month, 1)) . " ". $year . "</th></tr>";
                    echo "<tr><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr></thead>";
                    echo "<tbody><tr>";
                    for ($i = 1; $i <= $num_days; $i++) {
                        $day_of_week = date("N", strtotime("$year-$month-$i"));
                        if ($i == 1) {
                            for ($j = 1; $j < $day_of_week; $j++) {
                                echo "<td></td>";
                            }
                        }
                        $num_appointments = $appointments["$year-$month-$i"];
                        if ($num_appointments <= 10) {
                        $color = "#C8F7DC";
                        } elseif ($num_appointments <= 20) {
                        $color = "#FEE4CB";
                        } elseif ($num_appointments <= 24) {
                        $color = "#FFD3E2";
                        } else {
                        $color = "#FF9465";
                        }
                        echo "<td style='background-color: $color;'>$i</td>";

                        if ($day_of_week == 7 && $i != $num_days) {
                            echo "</tr><tr>";
                        }
                    }
                    if ($day_of_week < 7) {
                        for ($i = $day_of_week; $i < 7; $i++) {
                        echo "<td></td>";
                        }
                    }
                    echo "</tr></tbody></table>";
                    ?>
                </div>

            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/index-script.js"></script>
</html>