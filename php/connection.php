<?php
    $servername = $__dbserver.":".$__dbport;
    $username = $__dbusername;
    $password = $__dbpassword;
    $dbname = $__dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo $conn->connect_error;
    }else{
        $id = 'WIYLH'.rand(1000,9999).'N'.rand(10000,99999).'BSK'.rand(10000,99999).rand(10000,99999)."HE".rand(10000,99999);
        $sql = "INSERT INTO visit_tb VALUES('".$id."','".date("h:i:sa")."', '".date('Y-m-d')."');";
        if ($conn->query($sql) === TRUE) {

        }
    }
?>