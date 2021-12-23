// generate-item.js
// This file is used to populate the contents of item.html using data taken from the sessionStorage.

let itemContainer = document.getElementsByClassName("item-container")[0]; // Get parent container.
let descContainer = document.createElement("div"); // Create another container to be used as a child.

descContainer.classList.add("item-desc");

let data = sessionStorage.getItem("product"); // Get product data from the sessionStorage.

let dataArray = data.split(","); // Convert string to array.

// Assign each element to a variable for readability.
let productTitle = dataArray[0];
let productPrice = dataArray[1];
let imgFilepath = dataArray[2];
let prodDesc = dataArray[3];

// Create image element.
let imgNode = document.createElement("img");

// Create attributes.
let srcAtt = document.createAttribute("src");
let altAtt = document.createAttribute("alt");

// Set attribute values.
let prodDetails = productTitle.split(" - ");
srcAtt.value = imgFilepath;
altAtt.value = "Image showing a " + prodDetails[1] + " colored " + prodDetails[0];

// Set the attributes.
imgNode.setAttributeNode(srcAtt);
imgNode.setAttributeNode(altAtt);

itemContainer.appendChild(imgNode); // Append the image node to the parent container.

// Create the elements for the item description

// Create elements.
let titleNode = document.createElement("h3");
let descNode = document.createElement("p");
let priceNode = document.createElement("p");
let buyNode = document.createElement("button");

// Add classes.
priceNode.classList.add("price");
buyNode.classList.add("button");

// Create text nodes.
let titleText = document.createTextNode(productTitle);
let descText = document.createTextNode(prodDesc);
let priceText = document.createTextNode(productPrice);
let buyText = document.createTextNode("Add to Cart");

// Assign the text nodes to the relevant element.
titleNode.appendChild(titleText);
descNode.appendChild(descText);
priceNode.appendChild(priceText);
buyNode.appendChild(buyText);

// Create and set the onclick attribute.
let onclickAtt = document.createAttribute("onclick");
onclickAtt.value = "handleBuy(this)";
buyNode.setAttributeNode(onclickAtt);

// Append all the newly created elements to the description container.
descContainer.appendChild(titleNode);
descContainer.appendChild(descNode);
descContainer.appendChild(priceNode);
descContainer.appendChild(buyNode);

// Now, append the description container to the initial parent container.
itemContainer.appendChild(descContainer);