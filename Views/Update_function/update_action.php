<?php
// Include connection file
include_once("../../connection/connect.php");

// Check if the return_book_id is set in the POST request
if(isset($_POST['return_book_id'])) {
    // Sanitize the input
    $returnBookId = mysqli_real_escape_string($con, $_POST['return_book_id']);

    // Update the action column in the borrowed_books table
    $updateQuery = "UPDATE borrowed_books SET action = 'Paid' WHERE id = '$returnBookId'";
    if(mysqli_query($con, $updateQuery)) {
        // Return success message
        echo "success";
    } else {
        // Return error message
        echo "error";
    }
} else {
    // Return error message if return_book_id is not set
    echo "error";
}
?>
