<!DOCTYPE html>
<html>
<head>
    <title>Gulf Consult</title>
    <link rel="shortcut icon" href="images/img.png" />
    <!-- Add Bootstrap CSS link -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add your custom CSS styles here -->
    <style>
        body {
            background-color: #f2f2f2; /* Background color */
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            background-color: gray; /* Header background color */
            color: #fff; /* Header text color */
            padding: 10px;
        }
        .logo {
            text-align: center;
            margin-top: 10px;
        }
        .header img {
            width: 100px; /* Adjust the width as needed */
            height: auto; /* This maintains the aspect ratio */
        }

        .logo img {
            width: 20px; /* Adjust the width as needed */
            height: auto; /* This maintains the aspect ratio */
        }

        .content {
            margin: 10px;
        }
        /* Diagonal Background Text */
       body::before {
    content: "Gulf Consult";
    position: fixed;
    bottom: 30%; /* Vertically center the text */
    left: 10%; /* Adjust the left margin */
    width: 100%;
    height: 100px; /* Adjust the height to control the diagonal angle */
    /*background-color: rgba(0, 0, 0, 0.1);*/ /* Background color with transparency */
    font-size: 170px; /* Font size as per your preference */
    font-weight: bold;
    color: rgba(255, 255, 255, 0.3); /* Text color with transparency */
    transform: translateY(-20%) rotate(-45deg); /* Vertically center and rotate */
    transform-origin: left bottom; /* Rotate from the bottom left corner */
    white-space: nowrap; /* Prevent text from wrapping */
    z-index: 1; /* Place it behind other content */
}
    </style>
</head>
<body>
    <div class="header">
        <!-- Replace 'path_to_your_logo.png' with the actual path to your logo image -->
        <h1>Gulf Consult <img src="images.png" alt="Gulf Consult Logo"></h1>
    </div>

    <?php
    include('config.php'); // Include the database connection

    if (isset($_GET['id'])) {
        $userId = $_GET['id'];

        // Use prepared statement to avoid SQL injection
        $query = "SELECT * FROM `message` WHERE id = ?";
        $stmt = $conn->prepare($query);

        if (!$stmt) {
            echo "Error preparing statement: " . $conn->error;
        } else {
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // Output the user's information for printing
                echo '<h3>User Information</h3>';
                echo '<p>Name: ' . htmlspecialchars($user['name']) . '</p>';
                echo '<p>Email: ' . htmlspecialchars($user['email']) . '</p>';
                echo '<p>Department: ' . htmlspecialchars($user['department']) . '</p>';
                echo '<p>Message: ' . htmlspecialchars($user['mes']) . '</p>';

                // You might want to provide a separate printable view without the following JavaScript
                // JavaScript to initiate printing after page loads
                echo '<script>window.onload = function() { window.print(); }</script>';
            } else {
                echo 'User not found.';
            }

            $stmt->close();
        }
    } else {
        echo 'Invalid request.';
    }
    ?>

</body>
</html>
