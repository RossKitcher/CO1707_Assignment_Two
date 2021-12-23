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

    // Create a new container to show the subtotal.
    let divider = document.createElement("hr");
    let subtotalContainer = document.createElement("div");
    let subtotalText = document.createElement("p");
    let removeAllNode = document.createElement("button");

    divider.classList.add("light");
    removeAllNode.classList.add("remove-all"); // Add class to element.
    subtotalContainer.classList.add("subtotal");

    // Create onclick attribute.
    let onclickAtt = document.createAttribute("onclick");
    onclickAtt.value = "handleRemoveAll()";
    
    // Set attribute.
    removeAllNode.setAttributeNode(onclickAtt);
    
    // Create text content.
    subtotalText.innerHTML = "Subtotal: " + subtotal;
    removeAllNode.innerHTML = "Clear all";   

    pageContainer.appendChild(removeAllNode);
    pageContainer.appendChild(divider);
    subtotalContainer.appendChild(subtotalText);
    pageContainer.appendChild(subtotalContainer);

}