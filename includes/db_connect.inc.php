<?php

// Database credentials.
$servername = 'localhost';
$dbUsername = 'root';
$dbPassword = 'Herring@1232';
$dbName = 'co1706_csk2';

try {

    // Connect to database.
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

} catch(mysqli_sql_exception $e) {

    // If connection failed, send raw HTTP header and exit.
    header("Location: ../index.php?sqlerror=true");
    exit();

}

?>