<div class="main-panel">
        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                 




   <div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
            <?php
include('config.php'); // Include the database connection

// Initialize variables
$query = "SELECT * FROM `users` WHERE account_type = 'admin' OR account_type = 'subadmin'";
$result = $conn->query($query);
$noRecordsFound = false; // Flag to check if no records are found

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the search query from the form
    $searchQuery = $_POST['search'];

    // Create a SQL query to retrieve matching users
    $query = "SELECT * FROM `users` WHERE (account_type = 'admin' OR account_type = 'subadmin') AND name LIKE '%$searchQuery%'";

    $result = $conn->query($query);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    // Check if no records are found
    if ($result->num_rows === 0) {
        $noRecordsFound = true;
    }
}

// Display the search form
echo '<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                    <div class="card-body">
                            <form method="post">
                                <input type="text" name="search" id="search" placeholder="Enter name">
                                <input type="submit" name="submit" value="Search">
                            </form>
                        <div class="card-header">
                            <h4>Live Chat</h4>
                        </div>
<p class="logout">
    <a id="exit" href="page.php">
        <span class="close-button">&#10006;</span> <!-- &#10006; is the HTML entity for the X symbol -->
    </a>
</p>
                        <div class="card-body">
                            
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Chat</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

// Initialize a variable to keep track of the sequence number
$sequence = 1;

// Output the data in the table rows
while ($row = $result->fetch_assoc()) {
    // Determine the status text based on the online_status column
    // Check if "online_status" key exists in the array before accessing it
    if (isset($row['online_status'])) {
        // Access the "online_status" key
        $statusText = ($row['online_status'] == 'online') ? 'Online' : 'Offline';
    } else {
        // Handle the case where "online_status" key is not set
        $statusText = 'Unknown'; // Set a default value or handle it as needed
    }

    echo '<tr>
        <td>' . $sequence . '</td>
        <td>' . $row['name'] . '</td>
        <td>' . $row['email'] . '</td>
        <td>' . $statusText . '</td>
        <td><a href="chat.php?id=' . $row['id'] . '" class="btn btn-primary">Chat</a></td>
    </tr>';

    $sequence++; // Increment the sequence number
}

// Display "No records found" message if no records are found
if ($noRecordsFound) {
    echo '<tr><td colspan="5">No records found.</td></tr>';
}

echo '</tbody></table></div></div></div></div></div></div></div></section></div>';
?>



            </div>
        </div>
    </div>
</div>

</div>


<style type="text/css">
    /* Add some padding to the table cells */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #ccc;
        padding: 8px;
    }

    /* Style the table header */
    th {
        background-color: #f2f2f2;
        text-align: left;
    }

    /* Style alternating rows */
    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Style the "Chat" button */
    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 5px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        cursor: pointer;
        border-radius: 4px;
    }

    /* Style the "Chat" button on hover */
    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Add a style for highlighted text */
.highlighted {
    background-color: yellow; /* You can change the highlight color */
    font-weight: bold;
}
<style>
    /* Style the search form */
    form {
        margin-bottom: 20px;
    }

    /* Style the table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    /* Style the table header */
    th {
        background-color: #f2f2f2;
        text-align: left;
        padding: 10px;
    }

    /* Style the table rows */
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Style the "No records found" message */
    .no-records {
        font-style: italic;
        color: #888;
    }
.close-button {
    font-size: 18px;
    padding: 5px 10px;
    background-color: #f44336; /* Choose your desired background color */
    color: white;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
      float: right;
}

.close-button:hover {
    background-color: #d32f2f; /* Change the background color on hover if desired */
}


</style>
