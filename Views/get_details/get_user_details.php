<?php
// get_user_details.php

// Include necessary files and initialize database connection
include_once("../../connection/connect.php");

// Check if user_id is provided via POST request
if (isset($_POST['user_id'])) {
    // Sanitize user_id to prevent SQL injection
    $userId = $con->real_escape_string($_POST['user_id']);

    // Query to fetch user details from the database
    $query = "SELECT * FROM user_table WHERE user_id = $userId";
    $result = $con->query($query);

    // Check if the query was successful
    if ($result) {
        // Fetch user details as an associative array
        $userDetails = $result->fetch_assoc();

        // Return user details as JSON response
        echo json_encode($userDetails);
    } else {
        // Handle the case where the query failed
        echo json_encode(array('error' => 'Failed to fetch user details'));
    }
} else {
    // Handle the case where user_id is not provided
    echo json_encode(array('error' => 'User ID is not provided'));
}

// Close the database connection
$con->close();
?>
