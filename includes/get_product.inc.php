<?php

// Initialise SQL statement.
$sql = "select product_title, product_price from tbl_products where product_id=?";
$stmt = mysqli_stmt_init($conn);

// Prepare SQL statement.
mysqli_stmt_prepare($stmt, $sql);

// Bind parameter and execute query.
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);

// Get results.
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

$prodTitle = $row['product_title'];
$prodPrice = $row['product_price'];

?>