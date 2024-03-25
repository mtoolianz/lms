<?php
// Include the database connection file
include_once("../../connection/connect.php");

// Check if the message ID is set in the POST request
if (isset($_POST['message_id'])) {
    $messageId = $_POST['message_id'];

    // Prepare a delete statement
    $query = "DELETE FROM user_message WHERE id = ?";
    $stmt = $con->prepare($query);

    // Bind the parameter
    $stmt->bind_param("i", $messageId);

    // Execute the statement
    if ($stmt->execute()) {
        // Deletion successful
        echo "Message deleted successfully.";
    } else {
        // Error occurred
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // ID not set in the request
    echo "Error: Message ID not provided.";
}
?>
