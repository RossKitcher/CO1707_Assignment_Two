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

        <!-- Import kit from https://fontawesome.com/ to allow the use of symbols. -->
        <script src="https://kit.fontawesome.com/8b3dff7f8c.js" crossorigin="anonymous"></script>
    </head>
    <body onresize="handleMenuResize()">
        <div class="page-container">
            <div class="content-wrap">

                <?php
                    include './php/header.php';
                ?>

                <!-- ==================== Page Content ==================== -->
                <div class="content">
                    <h1>Register</h1>
                    <p>In order to purchase from the Students' Union shop, you need to create an account with all fields below required. If you have any difficulties please contact the webmaster.</p>
                    
                    <!-- Form for registration -->
                    <!-- All containers with class 'hint' are programatically shown/occulted using register-validation.js -->
                    <form class="register">

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

                        <input type="submit" value="Submit">
                    </form>

                </div>

                <?php
                    include './php/footer.php';
                ?>

            </div>
        </div>


        <!-- Import JavaScript. -->
        <script src="js/register-validation.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>