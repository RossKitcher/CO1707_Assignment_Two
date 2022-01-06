// generate-cart.js
// Loads items from localStorage and displays them in the user's shopping cart.

// This is called when a 'Remove' button is clicked in the shopping cart.
handleRemove = (item) => {

    let container = item.parentElement.parentElement; // Get the container by navigating upwards.
    let id = container.id; // Get the id.
    let productName = item.parentElement.getElementsByTagName("h3")[0].innerHTML;

    // Use a yes/no dialog box to ensure the user has not clicked by accident.
    if (confirm("Are you sure you want to remove " + productName + " from your shopping cart?")) {
        localStorage.removeItem("item" + id); // Remove the item from localStorage.
        location.reload(); // Reload the page to refresh the shopping cart.
    }
}

// This is called when the 'Clear All' button is clicked.
handleRemoveAll = () => {

    // Prompt the user with a yes/no dialog to confirm that this is what they want to do.
    if (confirm("Are you sure you want to remove all items?")) {

        // Clear the localStorage and refresh the page.
        localStorage.clear();
        location.reload();
    }
}

// Create constant for the flexbox parent.
const flexParentContainer = document.getElementById("cartParent");

let fullCartAmount = localStorage.length; // Get amount of items in localStorage.
let realAmount = 0; // Amount of items in localStorage created by this application.

for (let i = 0; i < fullCartAmount; i++) {

    if (localStorage.key(i).slice(0,4) == "item") {
        realAmount++;
    }

}

let subtotal = 0; // Set subtotal to zero.
let children = {}; // Declare an object to hold key/value pairs of table rows.

let cartIDs = ""; // Declare a string to hold all id's currently inside the user's cart.

// If the shopping cart is empty, then display a message letting the user know.
// Else if it is not empty, programatically create a table row for each item in the shopping cart.
if (realAmount == 0) {

    let emptyDiv = document.getElementById("emptyCart"); 
    emptyDiv.classList.toggle("hidden"); // Toggle the 'hidden' class to show/hide the HTML.

} else {
    for (let i = 0; i < fullCartAmount; i++) {

        // Ignores entries in the localStorage that have not been created by this application.
        if (localStorage.key(i).slice(0,4) != "item") {
            continue;
        }

        let fullItem = localStorage.getItem(localStorage.key(i)); // Get value of item in localStorage.
        let itemArray = fullItem.split(","); // Split value on commas.
    
        // Declare variables to hold a product's information.
        let tempName = itemArray[0];
        let tempColour = itemArray[1];
        let tempPrice = itemArray[2];
        let tempFilepath = itemArray[3];
        let tempID = itemArray[4];

        // Update the cartIDs string to keep track of the products currently inside the cart.
        cartIDs += tempID + ",";
    
        // Create new HTML elements to hold the data to be added.
        let flexChildContainer = document.createElement("div"); 
        let titleContainer = document.createElement("div");       
        let titleNode = document.createElement("h3");
        let removeNode = document.createElement("button");
        let imgNode = document.createElement("img");
        let descContainer = document.createElement("div");
        let colourNode = document.createElement("p");
        let priceNode = document.createElement("p");

        // Give the flex child container an id to ease the process of removing an item from the cart.
        flexChildContainer.id = localStorage.key(i).slice(4);

        // Add relevant classes.
        flexChildContainer.classList.add("cart-child");
        titleContainer.classList.add("cart-title");
        removeNode.classList.add("remove-button")
        descContainer.classList.add("cart-desc");
        priceNode.classList.add("price");

        // Set attributes.
        imgNode.src = tempFilepath;
        imgNode.alt = tempColour + " coloured " + tempName + ".";
        removeNode.setAttribute("onclick", "handleRemove(this)");

        // Set the innerHTML.
        removeNode.innerHTML = "Remove";
        titleNode.innerHTML = tempName;
        colourNode.innerHTML = tempColour;
        priceNode.innerHTML = tempPrice;
        
        // Append the children to the description container.
        descContainer.appendChild(colourNode);
        descContainer.appendChild(priceNode);

        // Append the children to the title container.
        titleContainer.appendChild(titleNode);
        titleContainer.appendChild(removeNode);

        // Append the children to the flexbox child container.
        flexChildContainer.appendChild(titleContainer);
        flexChildContainer.appendChild(imgNode);
        flexChildContainer.appendChild(descContainer);

    
        // Append a key-value pair to the rows dictionary to enable sorting.
        children[parseInt(localStorage.key(i).slice(4))] = flexChildContainer;  
    
        // Update subtotal
        subtotal += parseFloat(tempPrice.slice(1));
    }

    let keys = Object.keys(children); // Get array of keys.
    keys.sort(); // Sort keys in asc order.

    // For each sorted key, append child container to the parent Flexbox.
    for (let i = 0; i < keys.length; i++) {
        flexParentContainer.appendChild(children[keys[i]]);
    }
        
    // Format the subtotal data.
    subtotal = subtotal.toFixed(2); // Round to two decimal places, toFixed returns a String.
    subtotal = "£" + subtotal;
    
    let pageContainer = flexParentContainer.parentElement;

    // Create new nodes for the remove all button and place order button.
    // The place order button is created inside a form to allow a php to send a POST request when clicked. 
    let buttonsContainer = document.createElement("div");
    let removeAllNode = document.createElement("button");
    let orderForm = document.createElement("form");
    let hiddenIDs = document.createElement("input");
    let placeOrderNode = document.createElement("input");

    // Add classes and set attributes.

    buttonsContainer.classList.add("cart-buttons-container");

    removeAllNode.classList.add("cart-button");
    removeAllNode.classList.add("remove-all");

    orderForm.action = "includes/post_order.inc.php";
    orderForm.method = "post";

    hiddenIDs.type = "hidden";
    hiddenIDs.name = "items";
    hiddenIDs.value = cartIDs;

    placeOrderNode.classList.add("cart-button");
    placeOrderNode.classList.add("place-order");
    placeOrderNode.type = "submit";
    placeOrderNode.value = "Place Order";
    placeOrderNode.name = "place-order";

    let removeAllAtt = document.createAttribute("onclick");
    removeAllAtt.value = "handleRemoveAll()";
    removeAllNode.setAttributeNode(removeAllAtt);
    removeAllNode.innerHTML = "Clear all";

    // Append the new nodes to their parent containers.
    orderForm.appendChild(hiddenIDs);
    orderForm.appendChild(placeOrderNode);
    buttonsContainer.appendChild(removeAllNode);
    buttonsContainer.appendChild(orderForm);

    // Create a new container to show the subtotal.
    let divider = document.createElement("hr");
    let subtotalContainer = document.createElement("div");
    let subtotalText = document.createElement("p");

    divider.classList.add("light");
    subtotalContainer.classList.add("subtotal");
    
    // Create text content.
    subtotalText.innerHTML = "Subtotal: " + subtotal;

    pageContainer.appendChild(buttonsContainer);
    pageContainer.appendChild(divider);
    subtotalContainer.appendChild(subtotalText);
    pageContainer.appendChild(subtotalContainer);

}