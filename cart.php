<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <!-- Set metadata to give the web browser information about the webpage. -->
        <meta charset="UTF-8">
        <meta name="description" content="Uclan's Student Union Shop Cart.">
        <meta name="keywords" content="UCLAN, Student Union, Shop">
        <meta name="author" content="Ross Kitcher">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Set title. -->
        <title>Shopping Cart</title>

        <!-- Import stylesheets. -->
        <link rel="stylesheet" href="styles/main.css">

        <!-- Import kit from https://fontawesome.com/ to allow the use of symbols. -->
        <script src="https://kit.fontawesome.com/8b3dff7f8c.js" crossorigin="anonymous"></script>
    </head>
    <body onresize="handleMenuResize()">

        <div class="page-container">
            <div class="content-wrap">

                <?php
                    include './includes/header.inc.php';
                ?>

                <!-- ==================== Page Content ==================== -->
                <div class="cart-content">

                    <?php

                        // If server-side validation checks failed.
                        if (isset($_GET['error'])) {

                            echo '<div class="hint reveal">';                                

                            if ($_GET['error'] == "missingdata") {
                                echo '<p><i class="fas fa-exclamation"></i>Missing email or password</p>';
                            }

                            if ($_GET['error'] == "notfound") {
                                echo '<p><i class="fas fa-exclamation"></i>No user with that email could be found.</p>';
                            }

                            if ($_GET['error'] == "wrongpwd") {
                                echo '<p><i class="fas fa-exclamation"></i>Incorrect password.</p>';
                            }

                            if ($_GET['error'] == "nologin") {
                                echo '<p><i class="fas fa-exclamation"></i>Please login before placing an order.</p>';
                            }

                            if ($_GET['error'] == "emptycart") {
                                echo '<p><i class="fas fa-exclamation"></i>You\'re shopping cart is empty!</p>';
                            }

                            if ($_GET['error'] == "sql") {
                                echo '<p><i class="fas fa-exclamation"></i>An unexpected SQL error occured.</p>';
                            }

                            echo '</div>';
                            
                        }

                        // If logged in.
                        if (isset($_SESSION["name"])) {

                            // If the user has just successfully logged in.
                            if (isset($_GET['login'])) {
                                if ($_GET['login'] == 'success') {
                                    echo '<div class="action-success"><p>You are now logged in!</p></div>';
                                }
                            }                            

                        } else {
                            // Login form.
                            echo '<p class="strong">In order to purchase items, you must be logged in:</p>';
                            echo '<form class="input-form" action="includes/login.inc.php" method="post">';
                            echo '<label for="email">Email address:</label>';
                            echo '<input type="text" id="email" name="email" placeholder="Enter email address">';
                            echo '<label for="password">Password:</label>';
                            echo '<input type="password" id="password" name="password" placeholder="Enter password">';
                            echo '<input type="submit" value="Login" name="login-submit">';
                            echo '</form>';
                            echo '<hr class="light"/>';
                        }
                    ?>

                    <h1>Shopping Cart</h1>

                    <?php

                        // If the user is logged in, display a personalised message.
                        if (isset($_SESSION['name'])) {
                            echo "<p>Welcome ".$_SESSION['name'].", the items you've added to your shopping cart are:</p>";
                        } else {
                            echo "<p>The items you've added to your shopping cart are:</p>";
                        }

                    ?>
                    

                    <!-- Flexbox container to hold all the items inside the shopping cart. -->
                    <div class="cart-parent" id="cartParent">

                        <!-- If no items are in the cart, notify the user. -->
                        <div class="cart-child hidden" id="emptyCart">
                            <div class="cart-title">
                                <h3>Empty Cart</h3>
                            </div>
                            <div class="cart-empty">
                                <p>You have no items in your shopping cart.</p>
                            </div>
                        </div>

                        <!-- Other items in the cart are added using generate-cart.js -->
                        <!-- along with extra features such as a remove button for each item, a remove all button, a place order button, and a subtotal. -->

                    </div>

                </div>

                <?php 

                    // If the user is logged in, get any pending orders.
                    if (isset($_SESSION['name'])) {
                        require 'includes/get_orders.inc.php';
                    }

                    include './includes/footer.inc.php';

                ?>
                
            </div>
        </div>

        

        <!-- Import JavaScript. -->
        <script src="js/main.js"></script>
        <script src="js/order-placed.js"></script>
        <script src="js/generate-cart.js"></script>
    </body>
</html>