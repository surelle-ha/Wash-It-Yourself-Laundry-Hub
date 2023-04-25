<?php 
include "../php/environment.php";
$servername = $__dbserver.":".$__dbport;
$username = $__dbusername;
$password = $__dbpassword;
$conn = new mysqli($servername, $username, $password);

if(isset($_GET['setupDatabase']) && $_GET['setupDatabase'] == '123456'){

    $result = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$__dbname'");
    if ($result->num_rows > 0) {
        echo "Database already exists.";
    } else {
        // Create database
        if ($conn->query("CREATE DATABASE $__dbname") === TRUE) {
            echo "Database created successfully.";
        } else {
            echo "Error creating database: " . $conn->error;
        }
    }

    $conn->query("USE ".$__dbname);
    $result = $conn->query("SHOW TABLES");
    if ($result === false) {
        echo "Error executing SHOW TABLES query: " . $conn->error;
    } else if ($result->num_rows > 0) {
        echo "Database is not empty.";
    } else {
        // Read SQL file
        $sql = file_get_contents("database.sql");

        // Execute SQL statements
        if ($conn->multi_query($sql)) {
            echo "All statements from SQL file were executed successfully.";
        } else {
            echo "Error executing SQL statements: " . $conn->error;
        }
    }

}
?>