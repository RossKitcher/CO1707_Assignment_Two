// register-validation.js
// Client side validation for all inputs on the register form.
// Note: Server-side validation is also performed to prevent bad actors from editing the JavaScript, the purpose of this 
// file is to provide a simpler UX and reduce the amount of HTTP requests between the client and server.

// Function to check if the given input features any data.
checkPresence = (input, tag, hint) => {

    if (input.length > 0) {

        // If the <input> tag features the class 'failure', replace it with 'success'.
        if (!tag.classList.replace("failure", "success")) {
            tag.classList.add("success");
        }

        // If the corresponding 'hint' container is shown, occult it.
        if (hint.classList.contains("reveal")) {
            hint.classList.toggle("reveal");
        }

        return true;

    } else {

        // If the <input> tag features the class 'success', replace it with 'failure'.
        if (!tag.classList.replace("success", "failure")) {
            tag.classList.add("failure");
        }

        // If the corresponding 'hint' container is occulted, show it.
        if (!hint.classList.contains("reveal")) {
            hint.classList.toggle("reveal");
        }

        return false;

    }
}

// Function to check if the email is valid.
checkEmail = (input, tag, hint) => {

    // Regular expression to match a valid email address.
    // Source: https://emailregex.com/
    let regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (input.match(regex)) {

        if (!tag.classList.replace("failure", "success")) {
            tag.classList.add("success");
        }

        if (hint.classList.contains("reveal")) {
            hint.classList.toggle("reveal");
        }

        return true;

    } else {

        if (!tag.classList.replace("success", "failure")) {
            tag.classList.add("failure");
        }

        if (!hint.classList.contains("reveal")) {
            hint.classList.toggle("reveal");
        }

        return false;

    }

}

// Function to check if the given password passes the given specification.
checkSpecialChars = (input, tag, hint) => {

    // Regular expressions to check if the given input contains i) at least one lowercase letter ii) at least one uppercase letter iii) a symbol iv) a number.
    let rLowercase = /[a-z]/;
    let rUppercase = /[A-Z]/;
    let rSymbol = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
    let rNumber = /[0-9]/;

    let lowercaseMatch = input.match(rLowercase);
    let uppercaseMatch = input.match(rUppercase);
    let symbolMatch = input.match(rSymbol);
    let numberMatch = input.match(rNumber);

    // If any of the matches have failed, return false.
    if (!lowercaseMatch || !uppercaseMatch || !symbolMatch || !numberMatch) {

        return false;

    } else {

        return true;

    }
}

// Function to check if the given password passes the minimum length requirements.
checkPassLength = (input, tag, hint) => {

    if (input.length >= 8) {

        return true;

    } else {

        return false;

    }
}

// Function to call individual password checks to avoid either check overriding the success/failure of the parent hint container.
checkPassword = (input, tag, hint) => {
    let lengthCheck = checkPassLength(input, tag, hint);
    let specialCheck = checkSpecialChars(input, tag, hint);

    // If both checks pass, it is a valid password.
    if (lengthCheck && specialCheck) {

        if (!tag.classList.replace("failure", "success")) {
            tag.classList.add("success");
        }

        if (hint.classList.contains("reveal")) {
            hint.classList.toggle("reveal");
        }

    } else {

        if (!tag.classList.replace("success", "failure")) {
            tag.classList.add("failure");
        }

        if (!hint.classList.contains("reveal")) {
            hint.classList.toggle("reveal");
        }

    }

    return [lengthCheck, specialCheck];
}

// Function to check if the second password inputted matches the first.
checkPassMatch = (input, tag, hint) => {
    let password = document.getElementById("password").value;
    let passRepeat = document.getElementById("confirmPass").value;

    if (password == passRepeat && password != "") {

        if (!tag.classList.replace("failure", "success")) {
            tag.classList.add("success");
        }

        if (hint.classList.contains("reveal")) {
            hint.classList.toggle("reveal");
        }

        return true;        

    } else {

        if (!tag.classList.replace("success", "failure")) {
            tag.classList.add("failure");
        }

        if (!hint.classList.contains("reveal")) {
            hint.classList.toggle("reveal");
        }

        return false;

    }
}

// Function to show a specific error message inside the given hint container.
showErrorMessage = (show, hint, pos) => {

    // If the boolean 'show' is undefined, then the supplied error message is not applicable to the current user input.
    // This is done as calls for all checks are made whenever a single <input> is edited.
    if (typeof show == "undefined") {
        return;
    }

    let errorMessage = hint.getElementsByTagName("p")[pos];

    if (show == true) {
        if (!errorMessage.classList.contains("hidden")) {
            errorMessage.classList.toggle("hidden");
        }        
    } else if (show == false) {
        if (errorMessage.classList.contains("hidden")) {
            errorMessage.classList.toggle("hidden");
        }
    }
}

// Get the form for validation
let form = document.getElementsByClassName("register")[0];

// Event listener for all <input> tags in the form.
// Triggers on any change to the content of the element.
form.addEventListener("input", (element) => {

    // Extract the relevant data from the function parameter.
    let tag = element.target;
    let input = tag.value;
    let id = tag.id;
    let hintId = id + "Hint";
    let hint = document.getElementById(hintId);

    // Define default variables to store validation checks.
    let presence;
    let validEmail;
    let passSpecialCheck;
    let passLengthCheck;
    let passMatch;

    // Check data is present in a field - applicable to all inputs.
    presence = checkPresence(input, tag, hint);

    // Input-specific checks.
    switch (id) {

        case "email":

            validEmail = checkEmail(input, tag, hint);
            break;

        case "password":

            let passChecks = checkPassword(input, tag, hint);
            passLengthCheck = passChecks[0];
            passSpecialCheck = passChecks[1];
            break;

        case "confirmPass":

            passMatch = checkPassMatch(input, tag, hint);
            break;

        default:
            break;
    }

    // Determine which error messages to show/occult using showErrorMessage().
    showErrorMessage(presence, hint, 0);
    showErrorMessage(validEmail, hint, 1);
    showErrorMessage(passSpecialCheck, hint, 2);
    showErrorMessage(passLengthCheck, hint, 1);
    showErrorMessage(passMatch, hint, 1);

})


// Seperate event listener for the <textarea> tag.
form.addEventListener("textarea", (element) => {
    let tag = element.target;
    let input = tag.value;
    let id = tag.id;
    let hintId = id + "Hint";
    let hint = document.getElementById(hintId);

    // Check data is present in the field.
    presence = checkPresence(input, tag, hint);

    showErrorMessage(presence, hint, 0);
})