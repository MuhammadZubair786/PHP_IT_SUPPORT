<?php
include('config.php'); // Include your database connection code

// Query online users
$sql = "SELECT name FROM users";
$result = $conn->query($sql);

$onlineUsers = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $onlineUsers[] = $row;
    }
}

$conn->close();

// Return online users as JSON
echo json_encode($onlineUsers);
?>
