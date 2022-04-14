<?php

include 'db_connect.inc.php'; // Connect to database.

// Initialise SQL statement.
$sql = "select order_id, order_date, product_ids from tbl_orders where user_id=?";
$stmt = mysqli_stmt_init($conn);

// Prepare SQL statement.
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: /~RKitcher/cart.php?error=sql");
    exit();
}

$userID = $_SESSION['userID']; // Get the current user's ID.

// Bind parameter and execute SQL statement.
mysqli_stmt_bind_param($stmt, "i", $userID);
mysqli_stmt_execute($stmt);

// Get results.
$results = mysqli_stmt_get_result($stmt);

// If the user has any orders placed, echo the HTML markup to show full order information.
if (mysqli_num_rows($results) != 0) {

    echo '<div class="orders-content">
            <h1>Pending Orders</h1>';
    
    // For each order the user has placed.
    while ($row = mysqli_fetch_assoc($results)) {

        $totalPrice = 0;

        $orderID = $row['order_id'];
        $orderDate = $row['order_date'];
        $prodIDString = $row['product_ids'];

        $prodIDs = explode(",", $prodIDString, -1); // Convert string to a list. e.g. "1,5,4" -> ["1", "5", "4"]

        echo '<div class="complete-order">
                <h3>Order #'.$orderID.'</h3>';

        // For each product inside the order.
        foreach ($prodIDs as $id) {

            // Get product information such as title and price.
            include 'get_product.inc.php';

            $totalPrice += $prodPrice; // Update the total price.

            echo '<span class="single-info">
                    <h4>- '.$prodTitle.'</h4>
                    <p>£'.$prodPrice.'</p>
                </span>';

        }

        // Convert the date string from the database to a date object.
        // Source:
        //      - https://www.geeksforgeeks.org/php-converting-string-to-date-and-datetime/
        //      - https://stackoverflow.com/questions/3727615/adding-days-to-date-in-php
        $date = strtotime($orderDate.' + 7 days');

        $totalPrice += 7.99; // Add shipping to the total.
        
        echo '<div class="order-summary">                            
                <div class="small-divider"></div>
                <p class="shipping">Shipping: £7.99</p>
                <p>Total: £'.$totalPrice.'</p>
                <p>Est. delivery date: '.date('d/m/y', $date).'</p>
            </div>';


        echo '</div>';
    }

    echo '</div>';

}

?>