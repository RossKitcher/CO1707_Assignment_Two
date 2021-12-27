<?php

// If a POST request has been received.
if (isset($_POST['login-submit'])) {

    include 'db_connect.inc.php'; // Connect to database.

    // Get data from POST request.
    $email = $_POST['email'];
    $password = $_POST['password'];

    // If data is missing.
    if (empty($email) || empty($password)) {
        header("Location: ../cart.php?error=missingdata");
        exit();
    }

    // Initialise SQL statement.
    $sql = "select * from tbl_users where user_email=?";
    $stmt = mysqli_stmt_init($conn);

    // If SQL error is found.
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?sqlerror=true");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email); // Replace placeholders with data.
    mysqli_stmt_execute($stmt); // Execute statement.

    $result = mysqli_stmt_get_result($stmt);

    // If a user was returned with the given email.
    if ($row = mysqli_fetch_row($result)) {

        // Verify the hashes of both the password sent in the POST req and the one stored in the database.
        $pwdCheck = password_verify($password, $row[4]);

        // If the hashes differ.
        if (!$pwdCheck) {

            header("Location: ../cart.php?error=wrongpwd");
            exit();

        } else if ($pwdCheck) { // If the hashes match.

            // Start a PHP server-side session for persistence.
            session_start();
            $_SESSION['name'] = $row[1];

            header("Location: ../cart.php?login=success");
            exit();
        }        
    } else { // If no user was found with the given email.
        header("Location: ../cart.php?error=notfound");
        exit();
    }

}


?>