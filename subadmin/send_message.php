<?php
// Include the database configuration file (config.php) to establish a database connection
include('config.php');

// Check if a message is submitted
if (isset($_POST['usermsg'])) {
    // Get the user's message from the form
    $message = $_POST['usermsg'];

    // Here, you would typically identify the sender and recipient user IDs
    $fromUserID = 1; // Replace with the actual sender user's ID
    $toUserID = 2;   // Replace with the actual recipient user's ID

    // Insert the message into the database
    $sql = "INSERT INTO chat_message (from_user_id, to_user_id, chat_message) VALUES ('$fromUserID', '$toUserID', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Message inserted successfully

        // Redirect to chat.php after message is sent
        header("Location: chat.php");
        exit(); // Make sure to exit after sending the redirect header
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
