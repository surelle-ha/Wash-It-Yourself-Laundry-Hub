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
    if($_SESSION['task'] == 'ADMIN' || $_SESSION['id'] == 'SUPERADMIN1030'){

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
    <title>Admin | Wash It Yourself Laundry Hub</title>
</head>
<body>
    <div class="app-container">
        <?php include('widgets/header.php'); ?>
        <div class="app-content">
            <?php include('widgets/navigation.php'); ?>
            <div class="projects-section">
                <div class="projects-section-header">
                    <p>Admin Dashboard</p>
                    <button style="height: 35px; width: 150px; border-radius: 10px; border: none; background: black;color:white;font-size:16px;"
                    onclick="window.location.href='schedulebooking.php'">Book</button>
                </div>
                    <style scoped>
                        .cards{
                        display: grid;
                        grid-template-columns: repeat(4, 1fr);
                        grid-gap: 2rem;
                        margin-top: 1rem;
                        }
                        .card-single{
                        display: flex;
                        justify-content: space-between;
                        background: #e6ffcc;
                        padding: 2rem;
                        border-radius: 12px;
                        box-shadow: 0 5px 10px rgba(154,160,185,.05), 0 15px 40px rgba(166,173,201,.2);
                        }
                        .card-single div:last-child span{
                        color: var(--main-color);
                        font-size: 3rem;

                        }
                        .card-single div:first-child span{
                        color: var(--text-grey);
                        }

                        .recent-grid{
                        margin-top: 3.5rem;
                        display: grid;
                        grid-gap: 2rem;
                        grid-template-columns: 65% auto;
                        
                        }
                        .card{
                        background: #fff;
                        border-radius: 12px;
                        box-shadow: 0 5px 10px rgba(154,160,185,.05), 0 15px 40px rgba(166,173,201,.2);
                        padding: 1rem;
                        }
                        .card-header
                        {
                        padding: 1rem;
                        }
                        .card-header{
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        border-bottom: 1px solid #f0f0f0;
                        }
                        .card-header button{
                        background: var(--main-color);
                        border-radius: 10px;
                        color: #fff;
                        font-size: .8rem;
                        padding: .5rem 1rem;
                        border:1px solid var(--main-color);
                        }
                    </style>

                    <div class="cards">
                        <div class="card-single">
                            <div>
                                <?php
                                if (!$conn) {
                                    echo '<h1>Down</h1>';
                                }else{
                                    echo '<h1>Running</h1>';
                                }                                
                                ?>
                                <span>Database Server</span>
                            </div>
                            <div>
                                <span class="fas fa-database"></span>
                            </div>
                        </div>
                        <div class="card-single">
                            <div>
                                <?php
                                $url = "https://infinityfree.net";
                                $timeout = 10;
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, $url);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
                                $response = curl_exec($ch);
                                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                                if ($response === false || $httpCode >= 400) {
                                    echo "<h1>Down</h1>";
                                } else {
                                    echo "<h1>Running</h1>";
                                }
                                curl_close($ch);
                                ?>
                                <span>Hosting Server (<?php echo $__domain; ?>)</span>
                            </div>
                            <div>
                                <span class="fas fa-server"></span>
                            </div>
                        </div>
                        <div class="card-single">
                            <div>
                                <h1><?php echo $__envtype; ?></h1>
                                <span>Environment</span>
                            </div>
                            <div>
                                <span class="fas fa-globe"></span>
                            </div>
                        </div>
                        <div class="card-single">
                            <div>
                                <h1>1</h1>
                                <span>Version</span>
                            </div>
                            <div>
                                <span class="fas fa-code-branch"></span>
                            </div>
                        </div>
                    </div>

                    <div class="cards">
                        <div class="card-single">
                            <div>
                                <?php 
                                $sql = "SELECT COUNT(*) as count FROM users_tb";
                                $result = mysqli_query($conn, $sql);
                                $count = mysqli_fetch_assoc($result)['count'];
                                echo '<h1>'.$count.'</h1>';
                                ?>
                                <span>Accounts</span>
                            </div>
                            <div>
                                <span class="fas fa-users"></span>
                            </div>
                        </div>
                        <div class="card-single">
                            <div>
                                <?php 
                                $sql = "SELECT COUNT(*) as count FROM visit_tb";
                                $result = mysqli_query($conn, $sql);
                                $count = mysqli_fetch_assoc($result)['count'];
                                echo '<h1>'.$count.'</h1>';
                                ?>
                                <span>Visits</span>
                            </div>
                            <div>
                                <span class="fas fa-door-open"></span>
                            </div>
                        </div>
                        <div class="card-single">
                            <div>
                                <?php 
                                $sql = "SELECT COUNT(*) as count FROM appointment_tb";
                                $result = mysqli_query($conn, $sql);
                                $count = mysqli_fetch_assoc($result)['count'];
                                echo '<h1>'.$count.'</h1>';
                                ?>
                                <span>Appointments</span>
                            </div>
                            <div>
                                <span class="fas fa-calendar-check"></span>
                            </div>
                        </div>
                        <div class="card-single">
                            <div>
                                <h1>Off</h1>
                                <span>Maintenance</span>
                            </div>
                            <div>
                                <span class="fas fa-wrench"></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/index-script.js"></script>
</html>