<?php
// Include connection file
include_once("../../connection/connect.php");

// Check if searchValue is set in the POST request
if(isset($_POST['searchValue'])) {
    // Sanitize the input
    $searchValue = mysqli_real_escape_string($con, $_POST['searchValue']);

    // Query to fetch filtered data from the borrowed_books table
    $query = "SELECT * FROM borrowed_books WHERE status = 'Returned' AND (book_name LIKE '%$searchValue%' OR user_name LIKE '%$searchValue%')";
    $result = mysqli_query($con, $query);

    // Initialize an empty array to store the filtered data
    $filteredData = array();

    // Check if there are any rows returned
    if(mysqli_num_rows($result) > 0) {
        // Fetch rows from the result set
        while($book = mysqli_fetch_assoc($result)) {
            $filteredData[] = $book;
        }
    }

    // Return the filtered data as JSON
    echo json_encode($filteredData);
} else {
    // Return error message if searchValue is not set
    echo "error";
}
?>
