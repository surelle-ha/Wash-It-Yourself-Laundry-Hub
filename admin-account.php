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
    include "php/adminTools.php";
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
    <title>Account Manager | Wash It Yourself Laundry Hub</title>
</head>
<body>
    <div class="app-container">
        <?php include('widgets/header.php'); ?>
        <div class="app-content">
            <?php include('widgets/navigation.php'); ?>
            <div class="projects-section">
                <div class="projects-section-header">
                    <p>Account Management</p>
                    <div class="search-wrapper">
                        <form method="POST">
                            <input class="search-input" name="search-input" type="text" placeholder="Search">
                        </form>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="feather feather-search"
                            viewBox="0 0 24 24">
                            <defs></defs>
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="M21 21l-4.35-4.35"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <style scoped>
                    a{
                    color: #739931;
                    }
                    .page{
                    max-width: 100%;
                    margin: 0 auto;
                    }
                    table th,
                    table td{
                    text-align: left;
                    }
                    table.layout{
                    width: 100%;
                    border-collapse: collapse;
                    }
                    table.display{
                    margin: 1em 0;
                    }
                    table.display th,
                    table.display td{
                    border: 1px solid #B3BFAA;
                    padding: .5em 1em;
                    }

                    table.display th{ background: #D5E0CC; }
                    table.display td{ background: #fff; }

                    table.responsive-table{
                    box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
                    }

                    @media (max-width: 30em){
                        table.responsive-table{
                        box-shadow: none;  
                        }
                        table.responsive-table thead{
                        display: none; 
                        }
                    table.display th,
                    table.display td{
                        padding: .5em;
                    }
                        
                    table.responsive-table td:nth-child(1):before{
                        content: 'Number';
                    }
                    table.responsive-table td:nth-child(2):before{
                        content: 'Name';
                    }
                    table.responsive-table td:nth-child(1),
                    table.responsive-table td:nth-child(2){
                        padding-left: 25%;
                    }
                    table.responsive-table td:nth-child(1):before,
                    table.responsive-table td:nth-child(2):before{
                        position: absolute;
                        left: .5em;
                        font-weight: bold;
                    }
                    
                        table.responsive-table tr,
                        table.responsive-table td{
                            display: block;
                        }
                        table.responsive-table tr{
                            position: relative;
                            margin-bottom: 1em;
                        box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
                        }
                        table.responsive-table td{
                            border-top: none;
                        }
                        table.responsive-table td.organisationnumber{
                            background: #D5E0CC;
                            border-top: 1px solid #B3BFAA;
                        }
                        table.responsive-table td.actions{
                            position: absolute;
                            top: 0;
                            right: 0;
                            border: none;
                            background: none;
                        }
                    }
                    </style>
                    <div class="page" style="overflow: scroll;height:750px">
                        <table class="layout display responsive-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Birthday</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Date Created</th>
                                    <th>Task Change</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if(isset($_POST['search-input'])){
                                    $sql = "SELECT * FROM users_tb WHERE fname LIKE '%".$_POST['search-input']."%' OR lname LIKE '%".$_POST['search-input']."%' LIMIT 9;";
                                }else{
                                    $sql = "SELECT * FROM users_tb LIMIT 9;";
                                }
                                
                                $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td class="organisationnumber"><?php echo $row['id']; ?></td>
                                    <td class="organisationname"><?php echo $row['fname']." ".$row['lname']; ?></td>
                                    <td class="organisationnumber"><?php echo $row['task']; ?></td>
                                    <td class="organisationnumber"><?php echo $row['birthday']; ?></td>
                                    <td class="organisationnumber"><?php echo $row['address1'].", ".$row['address2']." ".$row['city'].", ".$row['country']; ?></td>
                                    <td class="organisationnumber"><?php echo $row['phone']; ?></td>
                                    <td class="organisationnumber"><?php echo $row['email']; ?></td>
                                    <td class="organisationnumber"><?php echo $row['phone']; ?></td>
                                    <td class="organisationnumber">
                                        <?php if($row['status'] == -1){
                                            echo "BLOCKED";
                                        }else if($row['status'] == 0){
                                            echo "NOT VERIFIED";
                                        }else{
                                            echo "ACTIVE";
                                        } ?>
                                    </td>
                                    <td class="organisationnumber"><?php echo $row['date_created']; ?></td>
                                    <td>
                                        <?php if($row['id'] == $_SESSION['id'] || $row['id'] == 'SUPERADMIN1030'){ }else{ ?>
                                            <?php if($row['task'] == "USER"){ ?>
                                                <a href="admin-account.php?makeEmployee=<?php echo $row['id']; ?>" class="edit-item" title="Edit">Employee</a><br>
                                                <a href="admin-account.php?makeAdmin=<?php echo $row['id']; ?>" class="edit-item" title="Edit">Admin</a><br>
                                            <?php }else if($row['task'] == "EMPLOYEE"){ ?>
                                                <a href="admin-account.php?makeUser=<?php echo $row['id']; ?>" class="edit-item" title="Edit">User</a><br>
                                                <a href="admin-account.php?makeAdmin=<?php echo $row['id']; ?>" class="edit-item" title="Edit">Admin</a><br>
                                            <?php }else if($row['task'] == "ADMIN"){ ?>
                                                <a href="admin-account.php?makeUser=<?php echo $row['id']; ?>" class="edit-item" title="Edit">User</a><br>
                                                <a href="admin-account.php?makeEmployee=<?php echo $row['id']; ?>" class="edit-item" title="Edit">Employee</a><br>
                                            <?php }else{ echo "Error TW:Role"; } ?>
                                        <?php } ?>
                                    </td>
                                    <td class="actions">
                                        <a href="account.php?viewAsAdmin=<?php echo $row['id']; ?>" class="edit-item" title="Edit">View</a><br>
                                        <?php if($row['status'] == -1){ ?>
                                            <a href="admin-account.php?unblockAccount=<?php echo $row['id']; ?>" class="edit-item" title="Edit">Unblock</a><br>
                                        <?php }else if($row['status'] == 0){ ?>
                                            <a href="admin-account.php?verifyAccount=<?php echo $row['id']; ?>" class="edit-item" title="Edit">Verify</a><br>
                                        <?php }else{ ?>
                                            <?php if($row['id'] == $_SESSION['id'] || $row['id'] == 'SUPERADMIN1030'){ }else{ ?>
                                                <a href="admin-account.php?blockAccount=<?php echo $row['id']; ?>" class="edit-item" title="Edit">Block</a><br>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if($row['id'] == $_SESSION['id'] || $row['id'] == 'SUPERADMIN1030'){ }else{ ?>
                                            <a href="admin-account.php?removeAccount=<?php echo $row['id']; ?>" class="remove-item" title="Remove">Remove</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                            ?>

                            </tbody>
                        </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/index-script.js"></script>
</html>