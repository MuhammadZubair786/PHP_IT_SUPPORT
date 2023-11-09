<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $depart = $_POST['depart'];
        $phone = $_POST['phone'];

    $gender = $_POST['gender'];

    // Check if the user with the same email already exists
    $validate = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $validate);

    if ($result->num_rows > 0) {
        echo '<script type="text/javascript">
            alert("User Already Registered.");
            window.location.href = "login.php";
        </script>';
    } else {
        // Insert the user's data into the database
        $insert = "INSERT INTO users(name, email, password, depart, phone,gender, account_type)
                    VALUES('$name', '$email', '$password', '$depart', '$phone','$gender', 'user')";
        if (mysqli_query($conn, $insert)) {
            // Send a registration confirmation email
            echo '<script type="text/javascript">
                alert("Your Account Has Been Registered Successfully.");
                window.location.href = "login.php";
            </script>';
        } else {
            echo 'Error: ' . mysqli_error($conn); // Display an error message if there's a database error.
        }
    }
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


   <!-- Link to Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

   <style type="text/css">
  
        body {
            font-family: Arial, sans-serif;
            background-color: #E6E6FA;
             margin-top: 50px;    /* Add space of 10px to the top */
    margin-right: 20px;  /* Add space of 20px to the right */
    margin-bottom: 15px; /* Add space of 15px to the bottom */
    margin-left: 30px;
        }

        
        .mb-4 {
            margin-bottom: 10px;
        }

        .card {
            border: none;
            background-color: #f8f4ff;
        }

        .card-body {
            text-align: center;
        }

        h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .box {
            width: 100%;
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

        .gender-options input[type="radio"] {
            margin-right: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 10px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        p {
            font-size: 16px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
   
   /* Reduce button size and center it */
.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 5px 10px; /* Reduced padding for smaller size */
    border-radius: 5px;
    font-size: 16px; /* Reduced font size */
    cursor: pointer;
    display: block; /* To center the button */
    margin: 0 auto; /* To center the button horizontally */
}


/* Center-align the "Already have an account? login now" text */
.card-body p {
    text-align: center;
}

    </style>
</head>
<body>

       <div class="row justify-content-center">
           <div class="col-md-4">
               <div class="card">
                   <div class="card-body">
                       <div class="text-center mb-4">
                           <h3>Gulf Consult <img src="images.png" alt="Gulf Consult Logo" style="max-width: 50px;"></h3>
                                                  <h3 class="text-center mb-4">IT Help-Desk</h3>

                           
                       </div>
                       <!-- Display error messages here if needed -->
                       <!-- <div class="alert alert-danger">
                           Error message goes here.
                       </div> -->
                       <form action="" method="post" enctype="multipart/form-data">

                      
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="text" name="name" placeholder="Enter your Name" class="box" required>
      <input type="email" name="email" placeholder="Enter your Email" class="box" required>
      <input type="depart" name="depart" placeholder="Enter your Department" class="box" required>
      <input type="phone" name="phone" placeholder="Enter your Phone" class="box" required>


      <div class="password-container">
    <input type="password" id="password" name="password" placeholder="Enter your Password" class="box" required>
    <span class="password-toggle" onclick="togglePasswordVisibility('password')">👁️</span>
</div>

      

<div class="input-box">
      <span class="details">Gender</span>
      <div class="gender-options">
         <input type="radio" id="male" name="gender" value="Male" required>
         <label for="male">Male</label>

         <input type="radio" id="female" name="gender" value="Female" required>
         <label for="female">Female</label>

         <!-- Add more gender options if needed -->
      </div>
   </div> <input type="submit" name="submit" value="Register" class="btn btn-primary">

             
                           <!-- Rest of your form code remains the same -->
                          
<!--                            <input type="submit" name="submit" value="Register Now" class="btn btn-primary" style="background-color: #9b59b6;">
 --><div class="card-body">
                           <p>Already have an account? <a href="login.php">Login Now</a></p></div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>

   <!-- Link to Bootstrap JS and jQuery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
