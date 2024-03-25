<?php
// Include database connection or any necessary files
require_once "../../connection/connect.php"; // Adjust the path as needed

// Initialize an empty array to hold the search results
$searchResults = [];

// Check if the request is a GET request and the search parameter is set
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
    // Retrieve the search query
    $search = $_GET["search"];

    // Prepare SQL statement to search for users
    $sql = "SELECT * FROM borrowed_books WHERE book_name LIKE ? OR user_name LIKE ?";

    // Prepare and execute the statement
    $stmt = $con->prepare($sql);

    // Bind the search parameter
    $searchParam = "%{$search}%";
    $stmt->bind_param("ss", $searchParam, $searchParam); // Assuming both book_name and user_name are strings

    // Execute the statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Fetch the rows into an associative array
    while ($row = $result->fetch_assoc()) {
        // Add each row to the search results array
        $searchResults[] = $row;
    }

    // Close the result set
    $result->close();

    // Close the statement
    $stmt->close();
}

// Close the database connection
$con->close();

// Output the search results as JSON
echo json_encode($searchResults);
?>
