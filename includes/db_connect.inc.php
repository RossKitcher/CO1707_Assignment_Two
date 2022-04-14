<?php

// Database credentials.
$servername = '';
$dbUsername = '';
$dbPassword = '';
$dbName = '';

// Connect to database.
$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    // If connection failed, send raw HTTP header and exit.
    header("Location: /~RKitcher/index.php?sqlerror=true");
    exit();
}

?>