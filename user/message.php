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

<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $department = $_POST['department'];
        $phone = $_POST['phone'];

    $email = $_POST['email'];
    $mes = $_POST['mes'];


 date_default_timezone_set('Asia/Karachi');


    // Use the correct datetime format
    $date = date('Y-m-d H:i:s A' );

    // Use prepared statement to prevent SQL injection
    $insert = "INSERT INTO message (name, department, phone, email, mes, time, mes_type)
               VALUES (?, ?, ?,  ?, ?,?, 'pending')";

    $stmt = mysqli_prepare($conn, $insert);
    mysqli_stmt_bind_param($stmt, 'ssssss', $name, $department,  $phone, $email, $mes, $date);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        ?>
        <script type="text/javascript">
            // Display a confirmation message
            if (confirm('Are you sure you want to send your issue?')) {
                // Redirect to a success page or display a success message
                
            } else {
                // Redirect to a different page or take some other action if the user cancels
            }
        </script>
        <?php
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
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
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-10 col-xl-8 mb-4 mb-xl-0">
                 
                




          <div class="main-content">
        <section class="section">
          

            <div class="card card-primary">
              <div class="card-header"><h4>Kindly provide a brief description of your's Message</h4></div>

              <div class="card-body">
                <form method="POST" action="">
                  <div class="row">
                     
                    <div class="form-group col-10">
                      <label for="name">Name</label>
                      <input id="name" type="text" class="form-control" name="name" value="<?php echo $result["name"];?>" >
                    </div>
                     <div class="form-group col-10">
                      <label for="department">Department</label>
                      <input id="department" type="text" class="form-control" name="department" value="<?php echo $result["depart"];?>" >
                    </div>
                    <!--  <div class="form-group col-12">
                      <label for="phone">Phone</label>
                      <input id="phone" type="number" class="form-control" name="phone" value="<?php echo $result["phone"];?>">
                    </div> -->
                      <div class="form-group col-10">
                      <label for="email">Email</label>
                      <input id="email" type="email" class="form-control" name="email"  value="<?php echo $result["email"];?>" >
                    </div>
                     <div class="form-group col-10">
                      <label for="phone">Phone</label>
                      <input id="phone" type="text" class="form-control" name="phone"  value="<?php echo $result["phone"];?>" >
                    </div>
              
                 <div class="form-group col-10">
                      <label for="mes"> Enter Your Issue</label>
                      <!-- <input id="frist_name" type="text" class="form-control" name="message" autofocus > -->
                      <textarea class="form-control"  rows="4" cols="50" name="mes" autofocus></textarea>
                    </div>
              
      
                  </div>



<style>
  .small-button {
    width: 200px; /* Adjust the width as needed */
    height: 60px; /* Adjust the height as needed */
  }
</style>





                  <div style="text-align: center;">
  <button type="submit" name="submit" class="btn btn-primary btn-sm">
    Send
  </button>
</div>

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