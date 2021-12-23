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
    </head>
    <body onresize="handleMenuResize()">

        <div class="page-container">
            <div class="content-wrap">
                
                <!-- ==================== "Top" Button ==================== -->
                <div class="sticky-top-button">
                    <a href="#top">Top ↑</a>
                </div>

                <?php
                    include './php/header.php';
                ?>

                <!-- ==================== Page Content ==================== -->
                <div class="products-page">
                    <ul>
                        <!-- Elements for same page navigation. -->
                        <li>Products ></li>
                        <li><a href="#tshirt">t-shirts</a></li>
                        <li><a href="#hoodie">hoodies</a></li>
                        <li><a href="#jumper">jumpers</a></li>
                    </ul>
                    <div class="products-parent" id="displayProducts">
                        
                        <!-- Content of this container is populated using generate-products.js -->

                    </div>
                </div>

                <?php
                    include './php/footer.php';
                ?>

            </div>
        </div>

        <!-- Import JavaScript. -->
        <script src="js/main.js"></script>
        <script src="js/generate-products.js"></script>
    </body>
</html>