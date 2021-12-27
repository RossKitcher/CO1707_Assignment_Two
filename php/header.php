<?php

    // Function to determine if the given page is the 'active' one.
    function isActive($page) {

        $url = $_SERVER['REQUEST_URI'];
        $url = substr($url, 1);

        if ($page == $url) {

            return true;

        } else {

            return false;

        }
    }

    // Function to echo a link's html markup.
    function echoLink($class, $url, $page) {

        $isActive = isActive($url);

        if ($isActive) {

            echo '<li class="' . $class . '"><a href="' . $url .'" class="active">' . $page . '</a></li>';

        } else {
            
            echo '<li class="' . $class . '"><a href="' . $url .'">' . $page . '</a></li>';

        }
    }

    // Function to handle the creation of all navigation links.
    function createLinks($linkType) {        

        $pageNames = ["Register", "Cart", "Products", "Home"];
        $urlNames = ["register.php", "cart.php", "products.php", "index.php"];
        
        session_start();

        if (isset($_SESSION["name"])) {
            $pageNames[0] = "Logout";
            $urlNames[0] = "register.php?logout=logout";
        }

        // If the type of link is a part of a burger menu or the main header.
        if ($linkType == "nav-link") {

            // Create links in asc order.
            for ($i = 0; $i < count($pageNames); $i++) {

                echoLink($linkType, $urlNames[$i], $pageNames[$i]);

            }

        } elseif ($linkType == "burger-link") {

            // Create links in desc order.
            for ($i = count($pageNames) - 1; $i >= 0; $i--) {

                echoLink($linkType, $urlNames[$i], $pageNames[$i]);

            }

        }
        
    }
?>

<!-- ==================== Navigation ==================== -->
<header class="nav">
    <nav>
        <img class="logo" src="images/uclan-logo.png" alt="UClan logo.">
        <h1 class="nav-header">Student Shop</h1>

        <!-- Primary navigation that is displayed by default. -->
        <ul class="nav-links">

            <?php createLinks("nav-link") ?>

        </ul>

        <!-- Create a burger icon using CSS, source: https://www.w3schools.com/howto/howto_css_menu_icon.asp -->
        <div class="burger-icon" onclick="animateBurger(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </nav>

    <!-- Secondary navigation that is displayed when the burger icon is clicked.-->
    <div id="burgerNavigation">
        <div class="burger-nav">
            <ul class="burger-links">

                <?php createLinks("burger-link") ?>

            </ul>
        </div>
    </div>
</header>