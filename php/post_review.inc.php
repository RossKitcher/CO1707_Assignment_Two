<?php

// If a POST request has been received.
if (isset($_POST['review-submit'])) {

    require 'db_connect.inc.php'; // Connect to database.

    session_start(); // Start/resume session to fetch $_SESSION variables.

    // Get data from POST request.
    $title = $_POST['title'];
    $comments = $_POST['comment'];
    $prodID = $_POST['prodID'];

    $userID = $_SESSION['userID']; 
    
    // Convert the rating to a numerical 1-5 value.
    switch($_POST['rating']) {
        case "excellent":
            $rating = 5;
            break;
        case "great":
            $rating = 4;
            break;
        case "okay":
            $rating = 3;
            break;
        case "bad":
            $rating = 2;
            break;
        case "terrible":
            $rating = 1;
            break;
        default:
            $rating = -1;
            break;
    }

    // If the product id sent in POST request is invalid.
    if (empty($prodID)) {
        header("Location: ../item.php?id=1&error=noprodid");
        exit();
    }

    // If any of the data received is missing.
    if (empty($title) || empty($comments) || empty($userID) || $rating == -1) {
        header("Location: ../item.php?id=".$prodID."&error=missingdata");
        exit();
    }

    // Initialise SQL statement.
    $sql = "insert into tbl_reviews (user_id, product_id, review_title, review_desc, review_rating) values (?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);

     // If the SQL query is invalid, quit and notify the user.
    if (!mysqli_stmt_prepare($stmt, $sql)) {

        header("Location: ../item.php?id=".$prodID."&error=sql");
        exit();

    } else {

        // Bind parameters and execute the statement.
        mysqli_stmt_bind_param($stmt, 'sssss', $userID, $prodID, $title, $comments, $rating);
        mysqli_stmt_execute($stmt);

        // On success, let the user know.
        header("Location: ../item.php?id=".$prodID."&posted=success");
        exit();

    }

}


?>