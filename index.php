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
                <div class="content">
                    <h1>Where opportunity creates success</h1>
                    <p>Every student at The University of Central Lancashire is automatically a member of the Students' Union.</p>
                    <p>We're here to make life better for students - inspiring you to succeed and achieve your goals.</p>
                    <br />
                    <p>Everything you need to know about UCLan Students' Union. Your membership starts here.</p>
                    <h2>Together</h2>

                    <!-- HTML5 Video -->
                    <video class="youtube-video" controls>
                        <source src="resources/uclan-together.mp4" type="video/mp4"/>
                        Sorry, your browser does not support the video tag.
                    </video>

                    <h2>Join our global community</h2>

                    <!-- Iframe Video -->
                    <iframe class="youtube-video" src="https://www.youtube.com/embed/i2CRunZv9CU"></iframe>
                </div>

                <?php
                    include './php/footer.php';
                ?>
                
            </div>
        </div>


        <!-- Import JavaScript. -->
        <script src="js/main.js"></script>
    </body>
</html>