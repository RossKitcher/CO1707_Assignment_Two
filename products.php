<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <!-- Set metadata to give the web browser information about the webpage. -->
        <meta charset="UTF-8">
        <meta name="description" content="Uclan's Student Union Shop Products.">
        <meta name="keywords" content="UCLAN, Student Union, Shop">
        <meta name="author" content="Ross Kitcher">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Set title. -->
        <title>Shop Products</title>

        <!-- Import stylesheets. -->
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet" href="styles/responsive.css">
        <link rel="stylesheet" href="styles/products.css">
    </head>
    <body onresize="handleMenuResize()">

        <div class="page-container">
            <div class="content-wrap">
                
                <!-- ==================== "Top" Button ==================== -->
                <div class="sticky-top-button">
                    <a href="#top">Top ↑</a>
                </div>

                <?php
                    require './includes/header.inc.php';
                ?>

                <!-- ==================== Page Content ==================== -->
                <div class="products-page">

                    <!-- Search box functionality, Empty comments are used inbetween elements to remove the space created by using inline-blockk elements. -->
                    <!-- Source: https://css-tricks.com/fighting-the-space-between-inline-block-elements/ -->
                    <form action="products.php" method="get" class="prod-search"> 
                        <input type="test" id="search" name="search" class="search-box" placeholder="Search..."><!--
                        --><input type="submit" value="Go" class="search-button"> 
                    </form>

                    <!-- Links to filter the displayed products, again, empty comments are used. -->                    
                    <a class="filter-link" href="products.php?type=UCLan Hoodie">Hoodies</a><!--
                    --><a class="filter-link" href="products.php?type=UCLan Logo Jumper">Jumpers</a><!--
                    --><a class="filter-link" href="products.php?type=UCLan Logo Tshirt">Tshirts</a>

                    <!-- Display all relevant products. -->
                    <div class="products-parent">
                        <?php
                            
                            // Set specific variables depending on the GET parameters found, this is used as the SQL queries vary depending on the user's intention.
                            if (isset($_GET['type'])) {
                                $type = $_GET['type'];
                            } else if (isset($_GET['search'])) {
                                if (!empty($_GET['search'])) {
                                    $search = $_GET['search'];
                                }
                            }
                            require 'includes/get_products.inc.php';
                        ?>
                        
                    </div>
                </div>

                <?php
                    require './includes/footer.inc.php';
                ?>

            </div>
        </div>

        <!-- Import JavaScript. -->
        <script src="js/main.js"></script>
    </body>
</html>