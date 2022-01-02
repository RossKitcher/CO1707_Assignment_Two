<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <!-- Set metadata to give the web browser information about the webpage. -->
        <meta charset="UTF-8">
        <meta name="description" content="Uclan's Student Union Product View.">
        <meta name="keywords" content="UCLAN, Student Union, Shop">
        <meta name="author" content="Ross Kitcher">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Set title. -->
        <title>View Item</title>

        <!-- Import stylesheets. -->
        <link rel="stylesheet" href="styles/main.css">

        <!-- Import kit from https://fontawesome.com/ to allow the use of symbols. -->
        <script src="https://kit.fontawesome.com/8b3dff7f8c.js" crossorigin="anonymous"></script>
    </head>
    <body onresize="handleMenuResize()">

        <div class="page-container">
            <div class="content-wrap">

                <?php
                    include './php/header.php';
                ?>

                <?php

                    // If the user has just posted a review.
                    if (isset($_GET['posted'])) {
                        if ($_GET['posted'] == "success") {
                            echo '<div class="action-success"><p>Your review has been posted.</p></div>';
                        }
                    }

                ?>

                <!-- ==================== Page Content ==================== -->
                <div class="item-container">

                    <!-- item contents are displayed using php/get_item.inc.php -->
                    <?php require 'php/get_item.inc.php' ?>

                </div>

                <div class="reviews">

                    <!-- If reviews are present for the current product, display them. -->
                    <?php $prodID = $_GET['id']; require 'php/get_reviews.inc.php'; ?>
                    
                </div>

                
                <div class="review-content">

                    <?php

                        // If errors are found in the url parameters, show the relevant error message.
                        if (isset($_GET['error'])) {
                            echo '<div class="hint reveal">';
                            if ($_GET['error'] == "missingdata") {
                                echo '<p><i class="fas fa-exclamation"></i>Ensure all boxes are filled out.</p>';
                            } else if ($_GET['error'] == "noprodid") {
                                echo '<p><i class="fas fa-exclamation"></i>Invalid product ID.</p>';
                            } else if ($_GET['error'] == 'sql') {
                                echo '<p><i class="fas fa-exclamation"></i>Unexpected SQL error found.</p>';
                            }
                            echo '</div>';
                        }

                        // If the user is logged in, show the form to post a review.
                        if (isset($_SESSION["name"])) {

                            echo '  <h4>Post Review</h4>
                                    <form action="php/post_review.inc.php" method="post" class="input-form" id="review-form">
                
                                        <div class="input-section">
                                            <label for="title">Title:</label>
                                            <input type="text" id="title" name="title" placeholder="Enter review title">
                                        </div>
                                        
                                        <div class="input-section">
                                            <label for="comment">Comments:</label>
                                            <textarea type="text" id="comment" name="comment" maxlength="1000" rows="4" cols="50" placeholder="Enter review comments"></textarea>
                                        </div>
                
                                        <div class="input-section">
                                            <label for="rating">Rating:</label>
                                            <select id="rating" name="rating">
                                                <option value="" disabled selected>Select an option</option>
                                                <option value="excellent">Excellent</option>
                                                <option value="great">Great</option>
                                                <option value="okay">Okay</option>
                                                <option value="bad">Bad</option>
                                                <option value="terrible">Terrible</option>
                                            </select>
                                        </div>
                                        
                                        <!-- Hidden HTML input tag to hold the current Product ID, populated using JavaScript. -->
                                        <input type="hidden" name="prodID" value="" />
                
                                        <input type="submit" value="Post" name="review-submit">
                
                                    </form>';

                        } else {
                            echo '<p>You must be logged in to post a review.</p>';
                        }
                    ?>

                </div>

                <?php
                    include './php/footer.php';
                ?>
                
            </div>
        </div>

        <!-- Import JavaScript. -->
        <script src="js/main.js"></script>
        <script src="js/fill-review-id-input.js"></script>
    </body>
</html>