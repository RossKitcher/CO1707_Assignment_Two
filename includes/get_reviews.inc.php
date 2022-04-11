<?php

include 'db_connect.inc.php'; // Connect to database.

// Initialise the SQL statement.
$sql = "select user_id, review_title, review_desc, review_rating from tbl_reviews where product_id = ?";
$stmt = mysqli_stmt_init($conn);

// Prepare SQL statement.
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../products.php");
    exit();
} else {

    // Bind parameters and execute statement.
    mysqli_stmt_bind_param($stmt, 's', $prodID);
    mysqli_stmt_execute($stmt);

    // Get results.
    $results = mysqli_stmt_get_result($stmt);

    // Initialise arrays to store review ratings & markup.
    $allRatings = [];
    $allReviews = [];

    // If there are reviews found for the given product.
    if (mysqli_num_rows($results) != 0) {

        // Iterate through each returned result.
        while ($row = mysqli_fetch_assoc($results)) {

            $ratingNum = $row['review_rating'];

            array_push($allRatings, $ratingNum);

            // Convert the rating value to its relevant string.
            switch($ratingNum) {
                case 1:
                    $rating = "Terrible";
                    break;
                case 2:
                    $rating = "Bad";
                    break;
                case 3:
                    $rating = "Okay";
                    break;
                case 4:
                    $rating = "Great";
                    break;
                case 5:
                    $rating = "Excellent";
                    break;
            }

            // Conver the first character of the string to lowercase, to be used as a class name.
            $ratingClass = strtolower(substr($rating, 0, 1)) . substr($rating, 1);

            // Extract data from the $row variable as it will be overwritten when calling get_user_name.inc.php.
            $userID = $row['user_id'];
            $title = $row['review_title'];
            $desc = $row['review_desc'];

            include 'get_user_name.inc.php'; // Call this to get the name of the review author.

            // HTML markup of the review, this is stored instead of being immediately echo'd as the average rating calculation needs to be complete first.
            $reviewMarkup = '<div class="review '.$ratingClass.'">
                        <h4>'.$title.'</h4>
                        <p>'.$desc.'</p>
                        <hr class="dark" />
                        <p class="rating">'.$rating.'</p>
                        <p class="author">-'.$username.'</p>
                    </div>';
            
            array_push($allReviews, $reviewMarkup);
        }

        // Calculate mean rating of product and round the answer.
        $average = ceil(array_sum($allRatings) / count($allRatings));

        // Echo the markup to the user.
        echo '<h4>Average Rating: '.$average.'</h4>';
        echo '<div class="reviews-flex-parent">';
        foreach ($allReviews as $review) {
            echo $review;
        }
        echo '</div>';

    }
}

?>