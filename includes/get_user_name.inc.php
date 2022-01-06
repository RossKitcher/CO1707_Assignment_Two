<?php

// Initialise SQL statement.
$sql = "select user_full_name from tbl_users where user_id=?";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);

// Before binding data to the parameter, check if the variable $userID exists.
// This is due to this file being called from two sources with different aims - the existence of the variable differentiates between the two.
if (isset($userID)) {
    mysqli_stmt_bind_param($stmt, 's', $userID);
} else {
    mysqli_stmt_bind_param($stmt, 's', $_SESSION['userID']);
}

// Execute query and get results.
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// If a match is found, store the results in the variable $username, accessible by the file that called this file.
if ($row = mysqli_fetch_assoc($result)) { 

    $username = $row['user_full_name'];

} else {

    $username = "He who cannot be named.";

}

?>