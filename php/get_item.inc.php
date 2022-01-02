<?php

// If the GET parameter ID is set.
if (isset($_GET["id"])) {

    require 'db_connect.inc.php'; // Connect to database.

    $id = $_GET["id"];

    // Initialise query.
    $sql = "select * from tbl_products where product_id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?sqlerror=true");
        exit();
    }

    //Bind data to placeholders and execute the SQL statement.
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);

    // Get the result.
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_row($result)) {

        echo '<img src="'. $row[3] .'" alt="'.$row[1].'">';
        echo '<div class="item-desc">';
        echo '<h3>'.$row[1].'</h3>';
        echo '<p>'.$row[2].'</p>';
        echo '<p>£'.$row[4].'</p>';
        echo '<button class="button" onclick="handleBuy(this)">Add to Cart</button>';
        echo '</div>';
        
    }
} else {

    // If no ID is provided in the URL, then redirect the user to the first product on sale.
    header("Location: ../item.php?id=1");
    exit();
}

?>