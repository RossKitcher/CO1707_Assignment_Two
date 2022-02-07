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

                <div class="doesnt-exist">

                    <?php 
                        echo "The requested URL ". $_SERVER['REQUEST_URI'] ." could not be found.";
                    ?>
                    
                </div>

                <?php
                    include './includes/footer.inc.php';
                ?>
                
            </div>
        </div>


        <!-- Import JavaScript. -->
        <script src="js/main.js"></script>
    </body>
</html>