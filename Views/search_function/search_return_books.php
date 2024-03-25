<?php
include_once("../../connection/connect.php");

// Check if searchValue is set in the POST request
if(isset($_POST['searchValue'])) {
    // Sanitize the input
    $searchValue = mysqli_real_escape_string($con, $_POST['searchValue']);

    // Query to fetch filtered data from the borrowed_books table
    $query = "SELECT * FROM borrowed_books WHERE status = 'Returned' AND (book_name LIKE '%$searchValue%' OR user_name LIKE '%$searchValue%')";
    $result = mysqli_query($con, $query);

    // Initialize an empty variable to store the HTML for filtered data
    $filteredDataHTML = '';

    // Check if there are any rows returned
    if(mysqli_num_rows($result) > 0) {
        // Fetch rows from the result set
        while($book = mysqli_fetch_assoc($result)) {
            // Append HTML for each row
            $filteredDataHTML .= "<tr>";
            $filteredDataHTML .= "<td>{$book['id']}</td>";
            $filteredDataHTML .= "<td>{$book['book_name']}</td>";
            $filteredDataHTML .= "<td>{$book['user_name']}</td>";
            $filteredDataHTML .= "<td>{$book['borrowed_date']}</td>";
            $filteredDataHTML .= "<td>{$book['return_date']}</td>";
            $filteredDataHTML .= "<td>{$book['status']}</td>";
            $filteredDataHTML .= "<td>";
            if($book['status'] !== 'Returned') {
                $filteredDataHTML .= "<button class='btn btn-sm btn-info m-2 edit-book' data-id='{$book['id']}'>Return</button>";
            } else {
                $filteredDataHTML .= "<button class='btn btn-sm btn-info m-2' disabled>Returned</button>";
            }
            $filteredDataHTML .= "</td>";
            $filteredDataHTML .= "</tr>";
        }
    } else {
        // No records found
        $filteredDataHTML = "<tr><td colspan='7'>No records found</td></tr>";
    }

    // Return the HTML for filtered data
    echo $filteredDataHTML;
} else {
    // Return error message if searchValue is not set
    echo "error";
}
?>
