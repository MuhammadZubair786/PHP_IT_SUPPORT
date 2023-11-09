<!--name fetch in top -->

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
            break; // Exit the loop after finding the matching email
        }
    }
} else {
    // Handle the case where the user is not logged in
    echo "User is not logged in.";
}
?>

<!-- message send to admin -->
<?php
include 'config.php';

// Handle marking messages as complete
if (isset($_POST['Delete'])) {
    $id = $_POST['id'];
    $sql = "UPDATE message SET mes_type='complete' WHERE id ='$id'";
    if (mysqli_query($conn, $sql)) {
        // Additional actions after marking as complete can be added here
    }
}

// Handle forwarding messages
if (isset($_POST['frwrd'])) {
    $id = $_POST['id'];
    $sql = "UPDATE message SET mes_type='subadmin' WHERE id ='$id'";
    if (mysqli_query($conn, $sql)) {
        // Additional actions after forwarding can be added here
    }
}



// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!-- table data fetch -->
<?php
include 'config.php';


// Ensure the user is logged in and the user_id is set
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];



$select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
if (mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
    print_r($fetch);  // Add this line to debug
}

  
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
        <div class="row">
            <div class="col-12">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Client Issue's Pending Details</h4>
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
                                        <th>Action</th>
                                        <th>Forward</th>
                                    </tr>
                                    <?php
                                    include('config.php'); // Include your database connection

                                    // Initialize the sequence counter
                                    $sequence = 1;

                                    // Check if a search query is provided
                                    if (isset($_GET['search'])) {
                                        $search = $_GET['search'];
                                        // Modify your SQL query to search by name or email
                                        $sql = "SELECT * FROM message WHERE mes_type='pending' AND (name LIKE '%$search%' OR email LIKE '%$search%')";
                                    } else {
                                        $sql = "SELECT * FROM message WHERE mes_type='pending'";
                                    }

                                    $result = mysqli_query($conn, $sql);

                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $sequence; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['department']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo substr($row['mes'], 0, 20) . ' ...'; ?> <input type="hidden" id="mes_<?php echo $row['id']; ?>" value="<?php echo $row['mes'];?>"></td>
                                                <td>
                                                    <a href="details.php?id=<?php echo $row['id']; ?>">
                                                        <button class="btn btn-primary mt-" type="button">Detail</button>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="solution.php?id=<?php echo $row['id']; ?>" class="btn btn-success mb-2 mt-2">Solution</a>
                                                </td>
                                                <td>
                                                    <form action="" method="POST" onsubmit="return confirm('Are you sure you want to forward this message?');">
                                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                        <button class="btn btn-info mt-2 mb-3" type="submit" name="frwrd">Forward</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                            $sequence++; // Increment the sequence counter
                                        }
                                    } else {
                                        echo "Query failed: " . mysqli_error($conn);
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
    function showAlert() {
        alert('Message forwarded to subadmin');
    }
</script>




<script>
function showSolutionInput(id) {
    var solutionInput = document.getElementById('solutionInput_' + id);
    solutionInput.classList.toggle('d-none');
}
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $(".show-button").click(function(){
        $(this).next(".solution-input").toggleClass("d-none");
    });
});
</script>
               
    <!-- end wrapper -->
      
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

