<?php

// PROJECT DETAILS
$__title = "Wash It Yourself Laundry Hub";
$__envtype = "Production";

if($__envtype == "Production"){
    $__domain = "washityourself.epizy.com"; 
    $__dbserver = "sql107.epizy.com"; 
    $__dbport = "3306";
    $__dbusername = "epiz_33860814"; 
    $__dbpassword = "19mv1M5bAW"; 
    $__dbname = "epiz_33860814_wiylh"; 
}else if($__envtype == "Development"){
    $__domain = "localhost"; 
    $__dbserver = "db4free.net"; 
    $__dbport = "3306";
    $__dbusername = "surelle123"; 
    $__dbpassword = "Izukishun@30"; 
    $__dbname = "surelle123"; 
}

// COLOR VARIABLE
$__colorAdmin = "red";
$__colorEmployee = "orange";

?>