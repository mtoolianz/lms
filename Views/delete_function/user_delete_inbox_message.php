<?php
// Include the database connection file
include_once("../../connection/connect.php");

// Check if the message ID is set and not empty
if (isset($_POST['message_id']) && !empty($_POST['message_id'])) {
    // Sanitize the message ID to prevent SQL injection
    $messageId = mysqli_real_escape_string($con, $_POST['message_id']);

    // SQL query to delete the message with the given ID
    $query = "DELETE FROM admin_message WHERE id = '$messageId'";
    $result = mysqli_query($con, $query);

    // Check if the deletion was successful
    if ($result) {
        echo "Message deleted successfully";
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Invalid message ID";
}
?>
