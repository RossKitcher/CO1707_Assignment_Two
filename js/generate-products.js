// generate-product.js
// Uses JavaScript to dynamically create all the products to be displayed in the shop.

// Constants consisting of product data extracted from items.csv.
const hoodieColours = ["Purple","Light Blue","Green","Dark Grey","Black","Salmon","Burgundy","Light Grey","Slate Blue","Orange","Teal","Navy","Orange","Creame","Lime","Off Blue","Red","Charcoal","Navy Blue","Lighter Grey","New Blue","Forest Green","Ocean Blue","Pink","Orange New","Black","Light Off Grey","Rusty Red","Slate Grey","Bright Green","Bright Pink","Burgundy New","Navy New","Bright Green"];
const hoodieDesc = "cotton authentic character and practicality are combined in this comfy  warm and luxury hoodie for students that goes with everything to create casual looks";
const hoodiePrice = "£39.99";

const jumperColours = ["Purple","Rusty Red","Water Blue","White","Pink","Black","Old Blue","Dark Grey","Red","Brown","Green","Dark Red","Yellow","Light Grey","Light Green","Old Red","Light Purple","Slate Blue","Real Red","Old Pink","Slate Grey","Bright Green","Teal","Sky Blue","Sunshine Pink","Bronze","Olive Green","Bright White Green","Navy Blue","Rusty Orange","Bright Orange","Sky Purple","Really Red","Plum Purple","Dark Purple","Vibrant Red","Ocean Blue","Creame","Lighter Blue","Light Grey"];
const jumperDesc = "cotton authentic character and practicality are combined in this winter jumper for students that goes with everything to create casual looks";
const jumperPrice = "£29.99";

const tshirtColours = ["Navy Blue New","Rusty Red New","Burgundy","Pink","Teal","Black","Old Red","Grey","Red","Brown","Dark Purple","Yellow","Mustard Yellow","Dark Grey","Dark Green","Bright Green","Olive Green","Dark Grey","Orange","Purple","Slate Blue","Bright Pink","Brightly Green","Lime Green","Ocean Blue","Dark Red","Another Green","Slate Grey","Bright Orange","Another Purple","Real Red","Brilliant Blue","Creame","Teal Blue","White"];
const tshirtDesc = "cotton authentic character and practicality are combined in this summery t-shirt for students that goes with everything to create casual looks. Perfect for those summer days";
const tshirtPrice = "£19.99";

// Set parent container that all new child containers will be appended to.
const parentContainer = document.getElementById("displayProducts");

// Function to append a FlexBox child to the parent Flexbox container.
// Each child appended represents a single product.
createFlexChild = (title, filepath, alternateText, isFirst, desc, price, isTshirt = false) => {
    // Create the elements needed to display a product.
    let divContainer = document.createElement("div");
    let imgNode = document.createElement("img");
    let descContainer = document.createElement("div");
    let nameNode = document.createElement("h3");
    let descNode = document.createElement("p");
    let readmoreNode = document.createElement("a");
    let priceNode = document.createElement("p");
    let buyNode = document.createElement("button");

    // If it is the first item of the category, then add an ID to be used for same-page navigation.
    if (isFirst != "undef") {
        divContainer.id = isFirst;
    }

    // Create attributes for the <img> tag.
    let srcAtt = document.createAttribute("src");
    let altAtt = document.createAttribute("alt");

    // Create attribute for the <button> tag.
    let bOnclickAtt = document.createAttribute("onclick");

    // Create attribute for the <a> tag.
    let hrefAtt = document.createAttribute("href");
    let aOnclickAtt = document.createAttribute("onclick");

    // Give the attributes a value.
    srcAtt.value = filepath;
    altAtt.value = alternateText;
    bOnclickAtt.value = "handleBuy(this)";
    hrefAtt.value = "item.html";
    aOnclickAtt.value = "handleReadmore(this)";

    // Create text nodes to the tags featuring text.
    let titleText = document.createTextNode(title);
    let descText = document.createTextNode(desc);
    let readmoreText = document.createTextNode(" Read more...");
    let priceText = document.createTextNode(price);
    let buyText = document.createTextNode("Add to Cart");

    // Add the text content to the relevant tags.
    nameNode.appendChild(titleText);
    descNode.appendChild(descText);
    priceNode.appendChild(priceText);
    buyNode.appendChild(buyText);
    readmoreNode.appendChild(readmoreText);

    // Set the attributes previously created for the <img> and <button> tag.
    imgNode.setAttributeNode(srcAtt);
    imgNode.setAttributeNode(altAtt);
    buyNode.setAttributeNode(bOnclickAtt);
    readmoreNode.setAttributeNode(hrefAtt);
    readmoreNode.setAttributeNode(aOnclickAtt);

    // Add classes to elements to enable CSS styling.
    divContainer.classList.add("products-child");
    descContainer.classList.add("product-desc");
    priceNode.classList.add("price");
    buyNode.classList.add("button");

    // If the product is a t-shirt then add a new class due to slightly different dimensions of images.
    if (isTshirt) {
        imgNode.classList.add("tshirt");
    }

    // Add the previously created nodes to the relevant containers.
    descNode.appendChild(readmoreNode);
    descContainer.appendChild(nameNode);
    descContainer.appendChild(descNode);
    descContainer.appendChild(priceNode);
    descContainer.appendChild(buyNode);
    divContainer.appendChild(imgNode);
    divContainer.appendChild(descContainer);

    // Finally, add the newly created child container to the parent FlexBox container.
    parentContainer.appendChild(divContainer);
}

// Function to handle when the 'Read more...' link is clicked.
handleReadmore = (element) => {

    // Extract data from the product in question by navigating upwards on the DOM.
    let descContainer = element.parentElement.parentElement;
    let divContainer = descContainer.parentElement;
    let fullname = descContainer.getElementsByTagName("h3")[0].innerHTML;
    let desc = descContainer.getElementsByTagName("p")[0].innerHTML.split("<a")[0];
    let price = descContainer.getElementsByTagName("p")[1].innerHTML;
    let imgFilepath = divContainer.getElementsByTagName("img")[0].getAttribute("src");

    sessionStorage.removeItem("product"); // Remove any previously set data.
    sessionStorage.setItem("product", fullname + "," + price + "," + imgFilepath + "," + desc); // Add the product-specific data to the sessionStorage.
}

// Define variables to be used in the subsequent for-loops.
let tempFilepath;
let tempAltText;
let tempTitle;
let isFirst;

// For every hoodie.
for (let i = 0; i < hoodieColours.length; i++) {

    isFirst = "undef";

    // If it is the first product displayed, set the isFirst variable.
    if (i == 0) {
        isFirst = "hoodie";
    }

    // Set parameters to be sent to createFlexChild().
    tempFilepath = "./resources/products/hoodie (" + (i+1) + ").jpg";
    tempAltText = hoodieColours[i] + " coloured hoodie.";
    tempTitle = "UCLan Hoodie (" + (i+1) + ") - " + hoodieColours[i];

    // Call function to create the new child container.
    createFlexChild(tempTitle, tempFilepath, tempAltText, isFirst, hoodieDesc, hoodiePrice);    
}

// For every jumper.
for (let i = 0; i < jumperColours.length; i++) {

    isFirst = "undef";

    if (i == 0) {
        isFirst = "jumper";
    }

    tempFilepath = "./resources/products/jumper (" + (i+1) + ").jpg";
    tempAltText = jumperColours[i] + " coloured jumper.";
    tempTitle = "UCLan Logo Jumper (" + (i+1) + ") - " + jumperColours[i];

    createFlexChild(tempTitle, tempFilepath, tempAltText, isFirst, jumperDesc, jumperPrice);
}

// For every t-shirt.
for (let i = 0; i < tshirtColours.length; i++) {
    isFirst = "undef";
    if (i == 0) {
        isFirst = "tshirt";
    }

    tempFilepath = "./resources/products/tshirt (" + (i+1) + ").jpg";
    tempAltText = tshirtColours[i] + " coloured t-shirt.";
    tempTitle = "UCLan Logo T-Shirt (" + (i+1) + ") - " + tshirtColours[i];

    createFlexChild(tempTitle, tempFilepath, tempAltText, isFirst, tshirtDesc, tshirtPrice, true);
}