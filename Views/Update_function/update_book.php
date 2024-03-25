<?php
// Include the database connection
include_once("../../connection/connect.php");

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $bookId = $_POST["editBookId"];
    $bookTitle = $_POST["editBookTitle"];
    $author = $_POST["editBookAuthor"];
    $publisher = $_POST["editBookPublisher"];
    $year = $_POST["editBookYear"];
    $availability = $_POST["editBookAvailability"];

    // Prepare SQL statement to update the book details
    $query = "UPDATE add_books SET book_title = ?, author = ?, publisher = ?, year = ?, number_of_copies = ? WHERE book_id = ?";
    
    // Prepare and bind parameters
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssssii", $bookTitle, $author, $publisher, $year, $availability, $bookId);

    // Execute the update statement
    if ($stmt->execute()) {
        // Update successful
        echo json_encode(["success" => true, "message" => "Book details updated successfully"]);
    } else {
        // Update failed
        echo json_encode(["success" => false, "message" => "Error updating book details: " . $con->error]);
    }

    // Close statement
    $stmt->close();
} else {
    // Invalid request method
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}

// Close database connection
$con->close();
?>
