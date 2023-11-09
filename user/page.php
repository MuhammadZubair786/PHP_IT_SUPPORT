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



                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                           <!--  <a class="dropdown-item" href="../profile.php">
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

        <!-- Content -->
        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
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

            <!-- Main Content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Page Header -->
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <h3 class="mt-5">Welcome <?php echo $result['name']; ?></h3>
                            <h6 class="font-weight-normal mb-0">Here, you can view the status of your submitted
                                solutions</h6>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row">
                        <!-- Solutions Card -->
                       

                        <!-- Issue Send Card -->
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card card-sm-3">
                                <div class="card-icon bg-success">
                                    <i class="ion ion-record"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Message Send</h4>
                                    </div>
                                    <h6 class="font-weight-normal mb-0">You can view the total number of message you
                                        have submitted.</h6>
                                    <div class="card-body">
                                        <?php
                                        $query = "SELECT * FROM message WHERE email = '" . $_SESSION['email'] . "'";
                                        $result = mysqli_query($conn, $query);
                                        if ($result) {
                                            $row = mysqli_num_rows($result);
                                            echo "<h3>{$row}</h3>";
                                            mysqli_free_result($result);
                                        } else {
                                            echo "0";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Issue Pending Card -->
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card card-sm-3">
                                <div class="card-icon bg-success">
                                    <i class="ion ion-record"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Message Pending</h4>
                                    </div>
                                    <h6 class="font-weight-normal mb-0">You can view the solutions that are awaiting
                                        review and are currently pending.</h6>
                                    <div class="card-body">
                                        <?php
                                        // Replace 'user_email' with the email of the logged-in user
                                        // Replace 'user_email' with the email of the logged-in user
$user_email = $_SESSION['email'];

// Construct the SQL query with a condition for the user's email
$query = "SELECT COUNT(*) AS pending_count FROM message WHERE (mes_type='Pending' OR mes_type='subadmin') AND email='$user_email'";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $pending_count = $row['pending_count'];
    echo "<h3>{$pending_count}</h3>";
    mysqli_free_result($result);
} else {
    echo "0";
}

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Statistics Cards -->

                    <!-- Content goes here -->

<!DOCTYPE html>
<html>
<head>
    <style>
        /* Style for the button */
        #redirectButton {
            position: fixed;
            bottom: 10px;
            right: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Your existing content goes here -->

    <!-- Create the button -->
    <button id="redirectButton">Chat</button>

    <!-- JavaScript to handle the button click event -->
    <script>
        document.getElementById("redirectButton").addEventListener("click", function() {
            // Redirect to index.php when the button is clicked
            window.location.href = "index_chat.php";
        });
    </script>
</body>
</html>

                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- Custom scripts for this page -->
    <script src="js/dashboard.js"></script>
    <script src="js/Chart.roundedBarCharts.js"></script>
</body>

</html>
