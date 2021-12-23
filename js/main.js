// main.js
// JavaScript to be used for all .html files.

// When the burger menu icon is clicked.
animateBurger = (icon) => {
    icon.classList.toggle("animate"); // Toggle the burger icon class for animation

    let burgerNav = document.getElementById("burgerNavigation"); // Get the secondary navigation using it's ID
    burgerNav.classList.toggle("show"); // Toggle it's class to display the menu

}

// Handle when menu is resized after the burger icon has been toggled.
handleMenuResize = () => {
    let browserWidth = window.innerWidth; // Get browser width in pixels
    let burgerNav = document.getElementById("burgerNavigation"); 
    let burgerIcon = document.getElementsByClassName("burger-icon")[0];

    // If the browser has been resized to the point in which the burger icon is hidden.
    if (browserWidth > 800) {

        // If the burger menu is toggled (open), close it.
        if (burgerIcon.classList.contains("animate")) {
            burgerIcon.classList.toggle("animate");
            burgerNav.classList.toggle("show");
        }
    }
}

// Function to handle when the 'Add to Cart' button is clicked.
handleBuy = (element) => {

    // Extract the relevant data by navigating upwards throgh the DOM.
    let descContainer = element.parentElement;
    let divContainer = descContainer.parentElement;
    let fullname = descContainer.getElementsByTagName("h3")[0].innerHTML;
    let price = descContainer.getElementsByTagName("p")[1].innerHTML;
    let imgFilepath = divContainer.getElementsByTagName("img")[0].getAttribute("src");

    // Seperate the product name and the colour from the title.
    let titleSplit = fullname.split(" - ");
    prodName = titleSplit[0];
    prodColour = titleSplit[1];

    // Loop through each item in localStorage to determine the max ID currently present.
    // This is to ensure all keys in localStorage are unique.
    let maxID = 0;
    for (let i = 0; i < localStorage.length; i++) {
        let id = parseInt(localStorage.key(i).slice(4)); // String slice to remove the prepending 'item'.
        if (id > maxID) {
            maxID = id;
        }
    }
    
    // Set item to localStorage.
    localStorage.setItem("item" + (maxID+1), prodName + "," + prodColour + "," + price + "," + imgFilepath);
    
    // Alert the user.
    alert(prodName + " added to cart!");
}

