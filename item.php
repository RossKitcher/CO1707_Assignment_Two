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
    </head>
    <body onresize="handleMenuResize()">

        <div class="page-container">
            <div class="content-wrap">

                <?php
                    include './php/header.php';
                ?>

                <!-- ==================== Page Content ==================== -->
                <div class="item-container">

                    <!-- item contents are displayed using generate-item.js -->

                </div>

                <?php
                    include './php/footer.php';
                ?>
                
            </div>
        </div>

        <!-- Import JavaScript. -->
        <script src="js/main.js"></script>
        <script src="js/generate-item.js"></script>
    </body>
</html>