<?php
// update_user.php

// Include necessary files and initialize database connection
include_once("../../connection/connect.php");

// Check if form data is provided via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form data to prevent SQL injection
    $userId = $con->real_escape_string($_POST['editUserId']);
    $userName = $con->real_escape_string($_POST['editUserName']);
    $userEmail = $con->real_escape_string($_POST['editUserEmail']);
    $userAddress = $con->real_escape_string($_POST['editUserAddress']);
    $userContact = $con->real_escape_string($_POST['editUserContact']);

    // Query to update user details in the database
    $query = "UPDATE user_table 
              SET user_name = '$userName', user_email = '$userEmail', 
                  user_address = '$userAddress', user_contact = '$userContact'
              WHERE user_id = $userId";

    // Execute the query
    if ($con->query($query) === TRUE) {
        // Return success message as JSON response
        echo json_encode(array('success' => 'User details updated successfully'));
    } else {
        // Return error message as JSON response
        echo json_encode(array('error' => 'Failed to update user details'));
    }
} else {
    // Handle the case where form data is not provided
    echo json_encode(array('error' => 'Form data is not provided'));
}

// Close the database connection
$con->close();
?>
