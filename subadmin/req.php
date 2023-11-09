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
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="password.php">
    <i class="fa fa-lock text-primary"></i> Change Password
</a>
              
             <a class="dropdown-item" href="logout.php">
    <i class="ti-power-off text-primary"></i>
    Logout
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
        <div class="main-content">
            <section class="section">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Client Issue's Details</h4>
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
                                                <th>Details</th>
                                                <th>Status</th>
                                            </tr>
                                            <?php
                                            include('config.php'); // Include your database connection

                                            // Initialize the sequence counter
                                            $sequence = 1;

                                            // Check if a search query is provided
                                            if (isset($_GET['search'])) {
                                                $search = $_GET['search'];
                                                // Modify your SQL query to search by name or email
                                                $sql = "SELECT * FROM message WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
                                            } else {
                                                $sql = "SELECT * FROM message";
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
                                                        <td><?php echo substr($row['mes'], 0, 20) . ' ...'; ?> <input type="hidden" id="mes_<?php echo $row['id']; ?>" value="<?php echo $row['mes']; ?>"></td>
                                                        <td>
                                                            <a href="details.php?id=<?php echo $row['id']; ?>">
                                                                <button class="btn btn-primary mt-" type="button">Detail</button>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $mesType = $row['mes_type'];
                                                            $buttonClass = '';

                                                            // Check the mes_type value and set the button class accordingly
                                                            if ($mesType === 'solve') {
                                                                $buttonClass = 'btn btn-success';
                                                            } elseif ($mesType === 'subadmin') {
                                                                $mesType = 'pending'; // Change the mes_type value to 'pending'
                                                                $buttonClass = 'btn btn-danger'; // Set the button class to 'btn-danger'
                                                            } elseif ($mesType === 'pending') {
                                                                $buttonClass = 'btn btn-danger';
                                                            }
                                                            ?>

                                                            <button class="<?php echo $buttonClass; ?>"><?php echo $mesType; ?></button>
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
            </section>
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
    function confirmDelete(button) {
        if (confirm("Are you sure you want to delete this Message?")) {
            // If the user confirms, submit the form
            button.closest("form").submit();
        } else {
            // If the user cancels, prevent form submission
            event.preventDefault(); // This line prevents the default form submission behavior
        }
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


