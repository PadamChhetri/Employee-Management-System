<?php
session_start();
// Redirect to login page if not logged in
if (!isset($_SESSION['name'])) {
    header('Location: login.php');
    exit();
}

include ('includes/header.php');
include ('includes/topbar.php');
include ('includes/sidebar.php');
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">

             <!-- to show message of update and add -->
    <?php
       include('message.php');
    ?>
    
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<?php
$conn = mysqli_connect('localhost', 'root', 'root@123', 'project');

// Query to fetch all data from the employees table
$sql = "SELECT e.id, e.name, e.email, s.amount 
        FROM employe e 
        LEFT JOIN salary s ON e.id = s.employe_id";
$result = mysqli_query($conn, $sql);

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {

    // Loop through each row of the result set
    while ($row = mysqli_fetch_assoc($result)) {
       
        echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['amount'] . "</td>";
                echo "<td><a href='give_salary.php?id=" . $row['id'] . "'>Give Salary</a></td>";
                echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No employees found.";
}

mysqli_close($conn);
?>

