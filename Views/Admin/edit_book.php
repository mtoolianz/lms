<?php
// Include necessary files and initialize database connection
require_once "../../connection/connect.php"; // Update the path as per your file structure

// Check if the book ID is provided in the URL parameter
if (isset($_GET['book_id']) && !empty($_GET['book_id'])) {
    // Retrieve the book ID from the URL parameter
    $bookId = $_GET['book_id'];

    // Prepare and execute a query to fetch the book details based on the book ID
    $stmt = $con->prepare("SELECT * FROM add_books WHERE book_id = ?");
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the book with the given ID exists
    if ($result->num_rows > 0) {
        // Fetch the book details
        $book = $result->fetch_assoc();

        // Return book details as JSON response
        echo json_encode($book);
    } else {
        // Return an error message if the book is not found
        echo json_encode(array("error" => "Book not found!"));
    }
    
    // Close the statement
    $stmt->close();
} else {
    // Return an error message if the book ID is missing
    // echo json_encode(array("error" => "Book ID is missing!"));
}

// Close database connection

?>
