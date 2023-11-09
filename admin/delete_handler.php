<?php
// Include your database connection
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Sanitize and validate the ID if needed

    // Perform the deletion query
    $deleteQuery = "DELETE FROM message WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Deletion successful
        echo "Message deleted successfully.";
        // Redirect to a page or display a message as needed
    } else {
        // Deletion failed
        echo "Error deleting user: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Invalid request or missing ID
    echo "Invalid request.";
}
?>
