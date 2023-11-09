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
      

          
          <!-- chat tab ends -->
       
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Welcome</span>
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
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pending Message</h4>
                        </div>
                        <div class="card-body">
                            <!-- Search Form -->
                            <form method="GET" class="mb-3">
                                        <div class="form-row align-items-center">
                                            <div class="col-auto">
                                                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." style="width: 150px;">
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                            </div>
                                        </div>
                                    </form>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Solution</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    include('config.php'); // Include your database connection

                                    // Initialize the sequence counter
                                    $sequence = 1;

                                    // Check if a search query is provided
                                    if (isset($_GET['search'])) {
                                        $search = $_GET['search'];
                                        // Modify your SQL query to search by name
                                        $sql = "SELECT * FROM message WHERE (mes_type='subadmin' OR mes_type='pending') AND name LIKE '%$search%'";
                                    } else {
                                        $sql = "SELECT * FROM message WHERE mes_type='subadmin' OR mes_type='pending'";
                                    }

                                    $rzlt = mysqli_query($conn, $sql);

                                    if ($rzlt) {
                                        while ($row = mysqli_fetch_assoc($rzlt)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $sequence; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['department']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo substr($row['mes'], 0, 15) . ' ...'; ?></td>
                                                <td>
                                                    <a href="solution.php?id=<?php echo $row['id']; ?>" class="btn btn-success mb-2 mt-2">Solution</a>
                                                </td>
                                                <td>
                                                    <a href="detail.php?id=<?php echo $row['id']; ?>">
                                                        <button class="btn btn-primary mt-" type="submit" name="">Detail</button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            $sequence++; // Increment the sequence counter
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




           
               <script>
    function showFullMessage(id) {
        var fullMessage = document.getElementById('mes_' + id).value;
        alert(fullMessage); // Display the full message in an alert
        // You can also open a modal or a new page to display the full message
    }
</script>
            

<script>
    function showSolutionInput(issueId) {
        var solutionInput = document.getElementById("solutionInput_" + issueId);
        solutionInput.classList.remove('d-none');
    }
</script>


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

