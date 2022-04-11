<?php

// If the POST request has been received.
if (isset($_POST['place-order'])) {

    // Start session to read from the $_SESSION object.
    session_start();

    // If the user is not logged in, return to cart.php.
    if (!isset($_SESSION['userID'])) {
        header("Location: ../cart.php?error=nologin");
        exit();
    }

    include 'db_connect.inc.php'; // Connect to database.

    // Receive data from the POST request and the $_SESSION object.
    $products = $_POST['items'];
    $userID = $_SESSION['userID'];

    // If the shopping cart is empty, return to cart.php.
    if (empty($products)) {
        header("Location: ../cart.php?error=emptycart");
        exit();
    }

    // Initialise SQL statement.
    $sql = "insert into tbl_orders (user_id, product_ids) values (?,?)";
    $stmt = mysqli_stmt_init($conn);

    // Prepare SQL statement.
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../cart.php?error=sql");
        exit();
    }

    // Bind parameters and execute query.
    mysqli_stmt_bind_param($stmt, "is", $userID, $products);
    mysqli_stmt_execute($stmt);

    // Return to cart.php with GET variable order equals success, this will trigger order-placed.js.
    header("Location: ../cart.php?order=success");
    exit();

}


?>