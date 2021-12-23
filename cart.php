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
    </head>
    <body onresize="handleMenuResize()">

        <div class="page-container">
            <div class="content-wrap">

                <?php
                    include './php/header.php';
                ?>

                <!-- ==================== Page Content ==================== -->
                <div class="cart-content">
                    <h1>Shopping Cart</h1>
                    <p>The items you've added to your shopping cart are:</p>

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
                        <!-- along with extra features such as a remove button for each item, a remove all button, and a subtotal. -->

                    </div>
                </div>


                <?php
                    include './php/footer.php';
                ?>
                
            </div>
        </div>

        

        <!-- Import JavaScript. -->
        <script src="js/main.js"></script>
        <script src="js/generate-cart.js"></script>
    </body>
</html>