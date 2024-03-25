<?php
// get_book_details.php

// Check if book_id is provided in the POST request
if (isset($_POST['book_id'])) {
    // Include necessary files and initialize database connection
    require_once '../../connection/connect.php';

    // Prepare and execute a query to fetch book details based on book_id
    $bookId = $_POST['book_id'];
    $query = "SELECT * FROM add_books WHERE book_id = ?";
    $statement = $con->prepare($query);
    $statement->bind_param('i', $bookId); // Assuming book_id is an integer, use 'i' for binding
    $statement->execute();
    $result = $statement->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Fetch book details as an associative array
        $bookDetails = $result->fetch_assoc();
        
        // Return book details as JSON response
        header('Content-Type: application/json');
        echo json_encode($bookDetails);
    } else {
        // Return an error response if book with provided ID was not found
        header('HTTP/1.1 404 Not Found');
        echo json_encode(array('error' => 'Book not found'));
    }

    // Close prepared statement and database connection
    $statement->close();
    $con->close();
} else {
    // Return an error response if book_id is not provided
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(array('error' => 'Book ID is required'));
}
?>
