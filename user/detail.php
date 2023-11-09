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
            echo "Welcome " . $result['name'];
            break; // Exit the loop after finding the matching email
        }
    }
} else {
    // Handle the case where the user is not logged in
    echo "User is not logged in.";
}
?>
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
<a class="dropdown-item" href="../logout.php">
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
            <a class="nav-link" href="message.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Message</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="solution.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Solution</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
        <div id="page-wrapper">

            <div class="row">
    <!-- Page Header -->
    <div class="col-lg-12">
        <h3 class="page-header">
            <div>Solution and Message Details</div>
        </h3>
    </div>
    <!--End Page Header -->
</div>

      

<div class="main-content">
    <section class="section">
        

       <?php
        include('config.php'); // Include the database connection

        if (isset($_GET['id'])) {
            $userId = $_GET['id'];


            // Query to fetch message details based on ID
            $messageQuery = "SELECT * FROM `message` WHERE id = '$userId'";
            $messageResult = $conn->query($messageQuery);

            $mem=$messageResult->fetch_assoc();
            echo "<script>";
            echo "console.log('userId:', " . json_encode($mem.$id) . ");";
           
            echo "</script>";
            $check=$mem['id'];
            // Query to fetch solution details based on ID
            $solutionQuery = "SELECT * FROM `solutions` WHERE issue_id = '$check'";
            $solutionResult = $conn->query($solutionQuery);
            echo "<script>";
            echo "console.log('userId:', " . ($userId) . ");";
           
            echo "</script>";
            
            if ($solutionResult->num_rows > 0 && $messageResult->num_rows > 0) {
                $solution = $solutionResult->fetch_assoc();
                

                echo "<script>";
    echo "console.log('Solution:', " . json_encode($solution) . ");";
    echo "console.log('Message:', " . json_encode($mem) . ");";
    echo "</script>";
                // Display the solution and message details
                 
               echo '<h3>Issue: </h3>';
                echo '<p>Name: ' . $mem['name'] . '</p>';
                echo '<p>Email: ' . $mem['email'] . '</p>';
                echo '<p>Message: ' . $mem['mes'] . '</p>';

                 echo '<h3>Response:</h3>';
                  
                echo '<p>Solution: ' . $solution['solution'] . '</p>';
                echo '<p>Regards: ' . $solution['name'] . '</p>';
            } else {
                echo 'Details will show when an admin send you a Response.';
            }
        } else {
            echo 'Invalid request.';
        }
        ?>
    </section>
</div>






           


            

              







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