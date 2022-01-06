<?php

include "db_connect.inc.php"; // Connect to database.

// Initialise SQL query.
$sql = "select * from tbl_offers";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {

    header("Location: ../index.php?error=sqlerror");
    exit();

} else {

    mysqli_stmt_execute($stmt); // Execute query.
    $results = mysqli_stmt_get_result($stmt); // Get result set.    

    // Iterate through each row in the result set.
    while ($row = mysqli_fetch_row($results)) {
        echo '<div class="offer">';
        echo '<h2>'. $row[1] .'</h2>';
        echo '<p>'. $row[2] .'</p>';
        echo '</div>';
    }    
}

?>