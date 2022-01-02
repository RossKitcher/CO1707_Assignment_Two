<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <!-- Set metadata to give the web browser information about the webpage. -->
        <meta charset="UTF-8">
        <meta name="description" content="Uclan's Student Union Shop Homepage.">
        <meta name="keywords" content="UCLAN, Student Union, Shop">
        <meta name="author" content="Ross Kitcher">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Set title. -->
        <title>Student Shop Homepage</title>

        <!-- Import kit from https://fontawesome.com/ to allow the use of symbols. -->
        <script src="https://kit.fontawesome.com/8b3dff7f8c.js" crossorigin="anonymous"></script>

        <!-- Import stylesheets. -->
        <link rel="stylesheet" href="styles/main.css">
    </head>
    <body onresize="handleMenuResize()">
        <div class="page-container">
            <div class="content-wrap">

                <?php
                    include './includes/header.inc.php';
                ?>

                <?php
                    if (isset($_GET['sqlerror'])) {
                        if ($_GET['sqlerror'] == "true") {
                            
                            echo '<div class="hint reveal">';

                            echo '<p><i class="fas fa-database"></i>Could not connect to the database.</p>';

                            echo '</div>';
                            
                        }
                    }
                ?>

                <!-- ==================== Page Content ==================== -->
                <div class="content">

                    <!-- Display offers --> 
                    <?php 

                        if (!isset($_GET['sqlerror'])) {

                            echo '<h1>Offers</h1>';
                            echo '<div class="offers-container">';

                            include "includes/offers.inc.php";

                            echo '</div>';
                        }                            
                        
                    ?>

                    <h1>Where opportunity creates success</h1>
                    <p>Every student at The University of Central Lancashire is automatically a member of the Students' Union.</p>
                    <p>We're here to make life better for students - inspiring you to succeed and achieve your goals.</p>
                    <br />
                    <p>Everything you need to know about UCLan Students' Union. Your membership starts here.</p>
                    <h2>Together</h2>

                    <!-- HTML5 Video -->
                    <video class="youtube-video" controls>
                        <source src="images/uclan-together.mp4" type="video/mp4"/>
                        Sorry, your browser does not support the video tag.
                    </video>

                    <h2>Join our global community</h2>

                    <!-- Iframe Video -->
                    <iframe class="youtube-video" src="https://www.youtube.com/embed/i2CRunZv9CU"></iframe>
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