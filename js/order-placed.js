let urlString = window.location.search; // Get the URL parameters as a string e.g. ?error=true&id=1
let urlParams = new URLSearchParams(urlString); // Initialise object from class URLSearchParams.
let orderStatus = urlParams.get("order"); // Get the value of the 'order' parameter.

// If an order was just placed, clear the local storage and notify the user.
if (orderStatus == "success") {

    localStorage.clear();
    alert("Your order has been placed!\n\nOutstanding orders can be viewed beneath the shopping cart.");

}