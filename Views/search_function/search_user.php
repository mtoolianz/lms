<?php
// Include database connection
include_once("../../connection/connect.php");

// Check if search_term is set and not empty
if(isset($_POST['search_term']) && !empty($_POST['search_term'])) {
    // Sanitize the search term to prevent SQL injection
    $searchTerm = mysqli_real_escape_string($con, $_POST['search_term']);

    // Query to search for users with the given name or email
    $query = "SELECT * FROM user_table WHERE user_name LIKE '%$searchTerm%' OR user_email LIKE '%$searchTerm%'";
    $result = $con->query($query);

    // Check if the query was successful
    if ($result) {
        // Fetch all records as an associative array
        $users = $result->fetch_all(MYSQLI_ASSOC);
        // Generate HTML for the filtered data
        foreach ($users as $key => $c) {
            echo "<tr>";
            echo "<td>".++$key."</td>";
            echo "<td>".$c['user_name']."</td>";
            echo "<td>".$c['user_email']."</td>";
            echo "<td>";
            if (!empty($c['user_image'])) {
                echo "<img src='../../views/users/images/".$c['user_image']."' alt='User Image' width='80' height='50'>";
            } else {
                echo "No Image";
            }
            echo "</td>";
            echo "<td>".$c['user_address']."</td>";
            echo "<td>".$c['user_contact']."</td>";
            echo "<td>";
            echo "<div>";
            echo "<button class='btn btn-sm btn-info m-2 edit-user' data-id='".(isset($c['user_id']) ? $c['user_id'] : '')."'>Edit</button>";
            echo "<button class='btn btn-sm btn-danger m-2 delete-user' data-id='".(isset($c['user_id']) ? $c['user_id'] : '')."'>Delete</button>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        // If the query fails, return an error message
        echo "Error: " . $con->error;
    }
} else {
    // If search_term is not set or empty, return an error message
    echo "Error: Search term is missing or invalid!";
}
?>
