<?php
// Include database connection
include_once("../../connection/connect.php");

// Check if user_id is set and not empty
if(isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    // Sanitize the input to prevent SQL injection
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);

    // Query to delete user from the database
    $query = "DELETE FROM user_table WHERE user_id = '$user_id'";
    
    // Execute the query
    if(mysqli_query($con, $query)) {
        // If deletion is successful, return success message
        echo "User deleted successfully!";
    } else {
        // If deletion fails, return error message
        echo "Error: " . mysqli_error($con);
    }
} else {
    // If user_id is not set or empty, return error message
    echo "Error: User ID is missing or invalid!";
}
?>
