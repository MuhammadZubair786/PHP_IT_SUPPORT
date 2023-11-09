<?php
// Include the database configuration file
include('config.php');

// Perform a SELECT query to fetch messages
$sql = "SELECT * FROM chat_message ORDER BY timestamp ASC"; // Adjust the query as needed

$result = $conn->query($sql);

$messages = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = array(
            'from_user_id' => $row['from_user_id'],
            'chat_message' => $row['chat_message']
        );
    }
}

// Close the database connection
$conn->close();

// Return messages as JSON
echo json_encode($messages);
?>
