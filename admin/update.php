<?php
include('config.php'); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
        $depart = $_POST['depart'];
        $phone = $_POST['phone'];

    $gender = $_POST['gender'];


    // Update user data in the database
    $query = "UPDATE `users` SET name='$name', email='$email', depart='$depart',phone='$phone', gender='$gender' WHERE id=$id";
    if ($conn->query($query) === TRUE) {
        echo 'User information updated successfully.';
    } else {
        echo 'Error updating user information: ' . $conn->error;
    }
} else {
    echo 'Invalid request.';
}

// CLOSE CONNECTION (You might not need to close the connection here if it's being done in config.php)
$conn->close();
?>
