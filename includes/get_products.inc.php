<?php

require 'db_connect.inc.php'; // Connect to database.

// Determine which SQL query to use.
if (isset($type)) {
    $sql = "select * from tbl_products where product_type=?";
    $data = $type;
} else if (isset($search)) {
    $sql = "select * from tbl_products where product_title like ?";
    $data = "%".$search."%";
} else {
    $sql = "select * from tbl_products";
}

// Initialise SQL statement.
$stmt = mysqli_stmt_init($conn);

// Prepare SQL statement.
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: /~RKitcher/index.php?sqlerror=true");
    exit();
}

// Bind data to parameter if it is required.
if (isset($data)) {
    mysqli_stmt_bind_param($stmt, "s", $data);
}

// Execute the statement and get the results.
mysqli_stmt_execute($stmt);
$results = mysqli_stmt_get_result($stmt);

// Output each product to the user.
while ($row = mysqli_fetch_row($results)) {
    echo '<div class="products-child" id="'. $row[0] .'">';
    echo '<img src="'. $row[3] .'" alt="'. $row[1] .'" />';
    echo '<div class="product-desc">';
    echo '<h3>'. $row[1] .'</h3>';
    echo '<p>'. $row[2] .' <a href="./item.php?id='. $row[0] . '" onclick="handleReadmore(this)">Read more...</a></p>';
    echo '<p class="price">£'. $row[4] .'</p>';
    echo '<button class="button" onclick="handleBuy(this)">Add to Cart</button>';
    echo '</div>';
    echo '</div>';

}

?>