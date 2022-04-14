<?php

// If a POST request has been received.
if (isset($_POST['register-submit'])) {

    include 'db_connect.inc.php'; // Connect to database.

    // Get data from POST request.
    $fullname = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPass = $_POST['confirmPass'];
    $address = $_POST['address'];

    $errorCode = "";

    // If any of the supplied data is empty.
    if (empty($fullname) || empty($email) || empty($password) || empty($confirmPass) || empty($address)) {
        $errorCode .= "1";
    } else {
        $errorCode .= "0";
    }

    // If the provided email is invalid, e.g. not in the format 'test@mail.com'.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorCode .= "1";
    } else {
        $errorCode .= "0";
    }

    // Check if the given email is already in use.
    $sql = "select * from tbl_users where user_email=?"; // SQL statement.
    $stmt = mysqli_stmt_init($conn); // Initialise a statement.

    // Prepare a SQL statement for execution, will return false on failure.
    if (!mysqli_stmt_prepare($stmt, $sql)) {

        header("Location: /~RKitcher/register.php?sqlerror=true");
        exit();

    } else {

        mysqli_stmt_bind_param($stmt, "s", $email); // Replace placeholder with data.
        mysqli_stmt_execute($stmt); // Executes prepared statement.
        mysqli_stmt_store_result($stmt); // Stores result set.
        $results = mysqli_stmt_num_rows($stmt); // Get amount of rows returned from query.

        // If any results are returned, then the email already exists in the database.
        if ($results > 0) {
            $errorCode .= "1";
        } else {
            $errorCode .= "0";
        }
    }

    // If the passwords do not match.
    if ($password  !== $confirmPass) {
        $errorCode .= "1";
    } else {
        $errorCode .= "0";
    }

    // If the password is too short.
    if (strlen($password) < 8) {
        $errorCode .= "1";
    } else {
        $errorCode .= "0";
    }

    $passChecks = 0;
    // Check if the password contains a lowercase letter.
    if (preg_match("/[a-z]/", $password)) {
        $passChecks++;
    }

    // Check if the password contains an uppercase letter.
    if (preg_match("/[A-Z]/", $password)) {
        $passChecks++;
    }

    // Check if the password contains a symbol.
    if (preg_match('/[!#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $password)) {
        $passChecks++;
    }

    // If any of the three previous checks failed, then password does not meet requirements.
    if ($passChecks < 3) {
        $errorCode .= "1";
    } else {
        $errorCode .= "0";
    }

    // If any of the server-side validation found errors. 
    if ($errorCode !== "000000") {

        header("Location: /~RKitcher/register.php?error=".$errorCode);
        exit();

    } else { // If not, insert new user into database.

        $sql = "insert into tbl_users (user_full_name, user_address, user_email, user_pass) values (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: /~RKitcher/register.php?sqlerror=true");
            exit();
        } else {

            // Hash password using PHP's constant PASSWORD_DEFAULT, which is currently bcrypt.
            $hashedPass = password_hash($password, PASSWORD_DEFAULT); 

            mysqli_stmt_bind_param($stmt, 'ssss', $fullname, $address, $email, $hashedPass);
            mysqli_stmt_execute($stmt);

            header("Location: /~RKitcher/register.php?register=success");
            exit();
        }

    }    
}

?>