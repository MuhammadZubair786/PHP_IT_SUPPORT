

<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $mes = $_POST['mes'];

   echo $date = date('Y-m-d H:i:s'); // Use the correct datetime format

    // Use prepared statement to prevent SQL injection
    $insert = "INSERT INTO message (name, department, phone, email, mes, time, mes_type)
               VALUES ( ?, ?, ?, ?, ?, ?, 'pending')";

    $stmt = mysqli_prepare($conn, $insert);
    mysqli_stmt_bind_param($stmt, 'ssssss', $name, $department, $phone, $email, $mes, $date);
    
    if (mysqli_stmt_execute($stmt)) {
        ?>
        <script type="text/javascript">
            alert('Your message Has Been Sent To admin Successfully');
        </script>
        <?php
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}
?>




<?php
session_start(); // Start the session

include 'config.php';
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id' AND account_type = 'user'") or die('Query failed: ' . mysqli_error($conn));

    if (mysqli_num_rows($select) > 0) {
        $fetch = mysqli_fetch_assoc($select);
    } else {
        // Handle case where user data is not found
        $fetch = array(); // Initialize an empty array to prevent further warnings
    }
} else {
    // Handle case where user is not logged in
    $fetch = array(); // Initialize an empty array
}

// Set default values if data is not available
$user_image = isset($fetch['image']) ? 'uploaded_img/' . $fetch['image'] : 'images/default-avatar.png';
$user_name = isset($fetch['name']) ? $fetch['name'] : 'Unknown User';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Admin</title>
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
              <img src="images/im.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="../profile.php">
    <i class="ti-user text-primary"></i> Profile
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
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>

          
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
              <span class="menu-title">Issue</span>
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
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                 
                




          <div class="main-content">
        <section class="section">
          

            <div class="card card-primary">
              <div class="card-header"><h4>Kindly provide a brief description of your's Message</h4></div>

              <div class="card-body">
                <form method="POST" action="">
                  <div class="row">
                     
                    <div class="form-group col-12">
                      <label for="name">Name</label>
                      <input id="name" type="text" class="form-control" name="name" autofocus >
                    </div>
                     <div class="form-group col-12">
                      <label for="department">Department</label>
                      <input id="department" type="text" class="form-control" name="department" autofocus >
                    </div>
                     <div class="form-group col-12">
                      <label for="phone">Phone</label>
                      <input id="phone" type="number" class="form-control" name="phone" autofocus >
                    </div>
                      <div class="form-group col-12">
                      <label for="email">Email</label>
                      <input id="email" type="email" class="form-control" name="email"  autofocus >
                    </div>
              
                 <div class="form-group col-12">
                      <label for="mes"> Enter Your Issue</label>
                      <!-- <input id="frist_name" type="text" class="form-control" name="message" autofocus > -->
                      <textarea class="form-control"  rows="4" cols="50" name="mes" autofocus></textarea>
                    </div>
              
      
                  </div>

                  <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">
                      Send
                    </button>
                  </div>
                </form>
              </div>
            </div>
                

        </section>
      </div>

            
            </div>
                
            </div>
        </div>




            
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


<style type="text/css">
    /* Sample CSS for the provided HTML structure */
.main-content {
    padding: 20px;
}

.section {
    margin-bottom: 20px;
}

.section-header {
    background-color: #f2f2f2;
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.card {
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.card-icon {
    color: white;
    padding: 15px;
    border-radius: 50%;
    font-size: 24px;
}

.card-wrap {
    padding: 15px;
}

.card-header h4 {
    margin: 0;
    font-size: 18px;
    color: #333;
}

.card-body h3 {
    margin: 0;
    font-size: 28px;
    color: #333;
}

</style>