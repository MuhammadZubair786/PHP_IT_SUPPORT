<?php
include 'config.php'; 

session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE Email='$email' AND password='$password'";
    $rzlt = mysqli_query($conn, $sql);

    if ($rzlt->num_rows > 0) {
        $row = mysqli_fetch_assoc($rzlt);

        if ($row['account_type'] === 'admin') {
            $_SESSION['email'] = $email;
            ?>
            <script type="text/javascript">
                window.location.href = 'admin/page.php'; // Admin panel
            </script>
            <?php
        } elseif ($row['account_type'] === 'user') {
            $_SESSION['email'] = $email;
            ?>
            <script type="text/javascript">
                window.location.href = 'user/page.php'; // User panel
            </script>
            <?php
        } elseif ($row['account_type'] === 'subadmin') {
            $_SESSION['email'] = $email;
            ?>
            <script type="text/javascript">
                window.location.href = 'subadmin/index.php'; // Sub admin panel
            </script>
            <?php
        } else {
            ?>
            <script type="text/javascript">
                alert("Account type is not recognized.");
            </script>
            <?php
        }
    } else {
        ?>
        <script type="text/javascript">
            alert("Please enter correct details.");
        </script>
        <?php
    }
}
?>


<!-- for automatically fill input email box -->

<?php
// Check if the email cookie is set
if (isset($_COOKIE['user_email'])) {
    $stored_email = $_COOKIE['user_email'];
} else {
    $stored_email = "";
}

// Handle form submission
if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Set the email as a cookie to remember it for future logins
    setcookie('user_email', $email, time() + (30 * 24 * 60 * 60)); // Cookie will expire in 30 days

   // Your authentication logic goes here
// Check if the entered email and password are correct
if ($email === "correct@email.com" && $password === "correctpassword") {
    // Redirect the user to the dashboard or another page
    header('Location: page.php');
    exit;
} else {
    // Display an error message if authentication fails
    $message = "Invalid email or password. Please try again.";
}
 // Your authentication logic goes here
    // Check if the entered email and password are correct

   
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Gulf Consult</title>
        <link rel="shortcut icon" href="images.png" />


   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   <br><br>
  
<div class="form-container">
 <div class="row justify-content-center">
           <div class="col-md-4">
               <div class="card">
                   <div class="card-body">
                       <div class="text-center mb-4">
                           <h3>Gulf Consult <img src="images.png" alt="Gulf Consult Logo" style="max-width: 50px;"></h3>
                                                  <h3 class="text-center mb-4">IT Help-Desk</h3>

                           
                       </div>
   <form action="" method="post" enctype="multipart/form-data">
        <?php
        if (isset($message)) {
            echo '<div class="message">' . $message . '</div>';
        }
        ?>
        <input type="email" name="email" placeholder="Enter Your email" class="box" required value="<?php echo $stored_email; ?>">

      <div class="password-container">
    <input type="password" id="password" name="password" placeholder="Enter Your password" class="box" required>
    <span class="password-toggle" onclick="togglePasswordVisibility('password')">👁️</span>
</div>

      <input type="submit" name="submit" value="Login" class="btn">
      <p>Don't have an account? <a href="registration.php">Create now</a></p>
            <p> <a href="forgot-password.php">Forget Password?</a></p>

   </form>

</div>


<script>
        function togglePasswordVisibility(inputId) {
            var passwordInput = document.getElementById(inputId);
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>
</html>


    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E6E6FA;

    margin-top: 60px;    /* Add space of 10px to the top */
    margin-right: 20px;  /* Add space of 20px to the right */
    margin-bottom: 15px; /* Add space of 15px to the bottom */
    margin-left: 30px;   /* Add space of 30px to the left */
}

        

        .form-container {
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f4ff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .mb-4 {
            margin-bottom: 20px;
        }

        h3 {
            font-size: 24px;
            margin-bottom: 10px;
            text-align: center;
        }

        .box {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;

        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        p {
            font-size: 16px;
            text-align: center;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
        .btn {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    margin: 0 auto; /* Center horizontally */
    display: block; /* Ensure it takes full width of its container */
}

    </style>

