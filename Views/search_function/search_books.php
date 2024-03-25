<?php
// Include database connection
include_once("../../connection/connect.php");

// Check if search query is provided and not empty
if (isset($_POST['search_query']) && !empty($_POST['search_query'])) {
    // Sanitize search query to prevent SQL injection
    $searchQuery = mysqli_real_escape_string($con, $_POST['search_query']);

    // SQL query to search for books
    $query = "SELECT * FROM add_books WHERE book_title LIKE '%$searchQuery%'";

    // Execute the query
    $result = mysqli_query($con, $query);

    // Fetch result as associative array
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Return JSON response
    echo json_encode($books);
} else {
    // Return empty response if search query is not provided
    echo json_encode([]);
}
?>
