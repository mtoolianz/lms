<?php
// Include database connection
include_once("../../connection/connect.php");

// Check if book ID is provided and valid
if (isset($_POST['book_id']) && !empty($_POST['book_id'])) {
    // Sanitize book ID to prevent SQL injection
    $bookId = mysqli_real_escape_string($con, $_POST['book_id']);

    // SQL query to delete book record
    $query = "DELETE FROM add_books WHERE book_id = '$bookId'";

    // Execute the query
    if (mysqli_query($con, $query)) {
        echo "Book deleted successfully";
    } else {
        echo "Error deleting book: " . mysqli_error($con);
    }
} else {
    echo "Invalid book ID";
}
?>
