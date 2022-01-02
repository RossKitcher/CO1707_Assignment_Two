let urlString = window.location.search; // Get the URL parameters as a string e.g. ?error=true&id=1
let urlParams = new URLSearchParams(urlString); // Initialise object from class URLSearchParams.
let id = urlParams.get("id"); // Get the value of the 'id' parameter.
document.getElementById("review-form").elements["prodID"].value = id; // Pupulate the hidden input value with the relevant product id.