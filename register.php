<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <!-- Set metadata to give the web browser information about the webpage. -->
        <meta charset="UTF-8">
        <meta name="description" content="Uclan's Student Union Shop Register.">
        <meta name="keywords" content="UCLAN, Student Union, Shop">
        <meta name="author" content="Ross Kitcher">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Set title. -->
        <title>Student Shop Homepage</title>

        <!-- Import stylesheets. -->
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet" href="styles/responsive.css">

        <!-- Import kit from https://fontawesome.com/ to allow the use of symbols. -->
        <script src="https://kit.fontawesome.com/8b3dff7f8c.js" crossorigin="anonymous"></script>
    </head>
    <body onresize="handleMenuResize()">
        <div class="page-container">
            <div class="content-wrap">

                <?php
                    require './includes/header.inc.php';
                ?>

                <!-- ==================== Page Content ==================== -->
                <div class="content">

                    <!-- Check for possible GET variables. -->
                    <?php

                        // If the user has just logged out.
                        if (isset($_GET["logout"])) {
                            if ($_GET["logout"] == "logout") {

                                echo '<div class="action-success"><p>You have been logged out.</p></div>';

                                // Destroy the user's current session to log them out.
                                session_unset();
                                session_destroy();

                                // Refresh current page to change the header navigation from 'Logout' to 'Register'.
                                // Get variable value changed to 'true' to avoid infinite browser refreshing yet keeping the logged out message.
                                header("Location: register.php?logout=true");

                            } else if ($_GET["logout"] == "true") {

                                echo '<div class="action-success"><p>You have been logged out.</p></div>';

                            }
                        }

                        // If the user has just successfully registered.
                        if (isset($_GET['register'])) {
                            if ($_GET['register'] == 'success') {
                                echo '<div class="action-success"><p>You are now registered!</p></div>';
                            }
                        }

                        // If server-side validation checks failed.
                        if (isset($_GET['error'])) {
                            echo '<div class="hint reveal">';

                            $errorCode = $_GET['error'];

                            if ($errorCode[0] == "1") {
                                echo '<p><i class="fas fa-exclamation"></i>All boxes require data.</p>';
                            }

                            if ($errorCode[1] == "1") {
                                echo '<p><i class="fas fa-exclamation"></i>Email is invalid.</p>';
                            }

                            if ($errorCode[2] == "1") {
                                echo '<p><i class="fas fa-exclamation"></i>There is already an account registered with that email.</p>';
                            }

                            if ($errorCode[3] == "1") {
                                echo '<p><i class="fas fa-exclamation"></i>Passwords do not match.</p>';
                            }

                            if ($errorCode[4] == "1") {
                                echo '<p><i class="fas fa-exclamation"></i>Password is too short.</p>';
                            }

                            if ($errorCode[5] == "1") {
                                echo '<p><i class="fas fa-exclamation"></i>Password does not meet all requirements.</p>';
                            }

                            echo '</div>';
                        }

                        // If an unexpected SQL error has been found.
                        if (isset($_GET['sqlerror'])) {
                            if ($_GET['sqlerror'] == "true") {
                                echo '<div class="hint reveal">';

                                echo '<p><i class="fas fa-database"></i>A SQL error has occured.</p>';

                                echo '</div>';
                            }
                        }
                    ?>

                    <h1>Register</h1>
                    <p>In order to purchase from the Students' Union shop, you need to create an account with all fields below required. If you have any difficulties please contact the webmaster.</p>
                    
                    <!-- Form for registration -->
                    <!-- All containers with class 'hint' are programatically shown/occulted using register-validation.js -->
                    <!-- On submission, a POST request is sent to includes/post_register.inc.php -->
                    <form action="includes/post_register.inc.php" method="post" class="input-form">

                        <label for ="fullName">Full name:</label>
                        <input type="text" id="fullName" name="fullName" placeholder="Enter full name">

                        <div class="hint" id="fullNameHint">
                            <p class="hidden"><i class="fas fa-exclamation"></i> This is a required field.</p>
                        </div>
                        

                        <label for="email">Email address:</label>
                        <input type="text" id="email" name="email" placeholder="Enter email address">

                        <div class="hint" id="emailHint">
                            <p class="hidden"><i class="fas fa-exclamation"></i> This is a required field.</p>
                            <p class="hidden"><i class="fas fa-exclamation"></i> Please enter a valid email address.</p>
                        </div>

                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter password">

                        <div class="hint" id="passwordHint">
                            <p class="hidden"><i class="fas fa-exclamation"></i> This is a required field.</p>
                            <p class="hidden"><i class="fas fa-exclamation"></i> Password must be more than 8 characters.</p>
                            <p class="hidden"><i class="fas fa-exclamation"></i> Password must feature at least one uppercase letter, lowercase letter, symbol, and number.</p>
                        </div>

                        <label for="confirmPass">Confirm password:</label>
                        <input type="password" id="confirmPass" name="confirmPass" placeholder="Confirm password">

                        <div class="hint" id="confirmPassHint">
                            <p class="hidden"><i class="fas fa-exclamation"></i> This is a required field.</p>
                            <p class="hidden"><i class="fas fa-exclamation"></i> Passwords do not match.</p>
                        </div>

                        <label for="address">Address:</label>
                        <textarea id="address" name="address" maxlength="200" rows="4" cols="50" placeholder="Enter address"></textarea>

                        <div class="hint" id="addressHint">
                            <p class="hidden"><i class="fas fa-exclamation"></i> This is a required field.</p>
                        </div>

                        <input type="submit" value="Submit" name="register-submit" disabled>
                    </form>
                </div>

                <?php
                    require './includes/footer.inc.php';
                ?>

            </div>
        </div>


        <!-- Import JavaScript. -->
        <script src="js/register-validation.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>