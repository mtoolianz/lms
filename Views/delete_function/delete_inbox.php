<?php
// Include database connection or any necessary files
require_once "../../connection/connect.php"; // Adjust the path as needed

// Check if the request is a POST request and the message_id parameter is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message_id"])) {
    // Retrieve the message ID from the POST data
    $messageId = $_POST["message_id"];

    // Prepare SQL statement to delete the message
    $sql = "DELETE FROM user_message WHERE id = ?";

    // Prepare and execute the statement
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $messageId);

    // Execute the statement
    if ($stmt->execute()) {
        // Deletion successful
        echo "Message deleted successfully.";
    } else {
        // Deletion failed
        echo "Error deleting message.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$con->close();
?>
