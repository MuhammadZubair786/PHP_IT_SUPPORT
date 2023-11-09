<?php
include('config.php');

// Retrieve the chat history from the database
$sql = "SELECT * FROM chat_messages ORDER BY timestamp ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div><strong>" . $row["sender"] . ":</strong> " . $row["message"] . "</div>";
    }
} else {
    echo "No messages yet.";
}

$conn->close();
?>
