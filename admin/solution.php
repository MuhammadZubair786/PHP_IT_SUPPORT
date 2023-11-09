
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Gulf Consult</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/img.png" />
              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
       <h4>Gulf Consult <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/img.png" class="mr-2" alt="logo"/></a></h4>
        <!-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/img.png" alt="logo"/></a> -->
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <!-- <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul> -->
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            
            
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <?php
SESSION_start();
include 'config.php';

// Check if the user is logged in
if (isset($_SESSION["email"])) {
    $user_email = $_SESSION["email"];
    
    $sel = "SELECT * FROM users";
    $query = mysqli_query($conn, $sel);

    // Loop through the users' data
    while ($result = mysqli_fetch_assoc($query)) {
        if ($result['email'] === $user_email) {
            // Display the name for the matching email
            // echo "Welcome " . $result['name'];
            break; // Exit the loop after finding the matching email
        }
    }
} else {
    // Handle the case where the user is not logged in
    echo "User is not logged in.";
}
?>
<?php
                            // Display user image or default avatar
                            echo $result['name'];
                            ?>
                                          <img src="images/im.jpg" alt="profile"/>


            </a>
           
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
             
            <!-- <a class="dropdown-item" href="../profile.php">
    <i class="ti-user text-primary"></i> Profile
</a> -->
<a class="dropdown-item" href="password.php">
    <i class="fa fa-lock text-primary"></i> Change Password
</a>

<a class="dropdown-item" href="logout.php">
    <i class="ti-power-off text-primary"></i> Logout
</a>

            </div>
          </li>
          
        </ul>

        
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
    

          
          <!-- chat tab ends -->
       
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="page.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Welcome</span>
            </a>
          </li>

            <li class="nav-item">
    <a class="nav-link" href="user.php">
        <i class="fa fa-user menu-icon"></i>
        <span class="menu-title">User</span>
    </a>
</li>
          


       <li class="nav-item">
            <a class="nav-link" href="req.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Message Received </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pending.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Message Pending</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
    
            
           
<div class="main-panel">
        <div class="content-wrapper">
         


         <?php
include 'config.php'; // Include your database connection file

// Get the 'id' from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    // Handle the case when 'id' is not present in the URL
    die("Error: 'id' parameter is missing.");
}

if (isset($_POST['submit_solution'])) {
    $email = $_POST['email'];
    $solution = $_POST['solution'];
    $name = "Admin"; // Admin's name

    // SQL query to insert the solution with admin's name into the database
    $insertSql = "INSERT INTO solutions (issue_id, solution, email, name) VALUES ('$id', '$solution', '$email', '$name')";
    
    if (mysqli_query($conn, $insertSql)) {
        echo "Solution inserted successfully.";
        $sql = "UPDATE message SET mes_type='solve' WHERE id ='$id'";
        if (mysqli_query($conn, $sql)) {
            // Additional actions after insertion can be added here
            //wite a code to send email 

            $getUserEmailSql = "SELECT email FROM message WHERE id = '$id'";
            $result = mysqli_query($conn, $getUserEmailSql);
            $row = mysqli_fetch_assoc($result);
            $userEmail = $row['email'];
    
            // Define email parameters
            $to = $userEmail;
            $subject = "Response to Your Issue";
            $message = "Your issue has been resolved. Here is the response:\n\n" . $solution;
            $senderName = "Team IT"; // Replace this with your actual retrieval method

            $message .= "\n\nRegards,\n$senderName";
            $headers = "From: Gulf Consult <gulfconsultgck@gmail.com>"; // Replace with your email address
               $message .= "\n\n*Please do not reply to this email if you have further query you can use chat option.";
            // Send the email
            if (mail($to, $subject, $message, $headers)) {
                echo "Email sent to user successfully.";
            } else {
                echo "Failed to send email to user.";
            }
        }
    } else {
        echo "Error inserting solution: " . mysqli_error($conn);
    }
}

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>

<html>
<head>
    <title>Enter Your Response</title>
    <!-- Add your custom CSS styles here -->
    <style>
        body {
            background-color: #f2f2f2; /* Background color */
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
        }
        form {
            text-align: center;
        }
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
        }
        input[type="submit"] {
            background-color: #007BFF; /* Button background color */
            color: #fff; /* Button text color */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3; /* Hover state background color */
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Enter Your Response</h3>
        <form action="solution.php?id=<?php echo $id; ?>" method="POST">
            <!-- Pass the 'id' in the form action URL -->
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <!-- You may need to handle 'email' as well, depending on your logic -->
            <textarea name="solution" rows="10" placeholder="Enter your Response here!"></textarea>
            <br>
            <input type="submit" name="submit_solution" value="Submit Response">
        </form>
    </div>
</body>
</html>

</html>

           
      
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
