<?php
session_start();
// Redirect to login page if not logged in
if (!isset($_SESSION['name'])) {
    header('Location: login.php');
    exit();
}

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Loan Orders</h1>
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
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Loan Amount</th>
                                    <th>Reason</th>
                                    <th>Status</th>
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

// Fetch all loan orders
$sql = "SELECT * FROM loan_order";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {


    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['employe_id'] . "</td>";
        echo "<td>" . $row['employee_name'] . "</td>";
        echo "<td>" . $row['loan_amount'] . "</td>";
        echo "<td>" . $row['reason'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>";
        echo "<a href='approve_loan.php?id=" . $row['id'] . "'>Approve</a> | ";
        echo "<a href='reject_loan.php?id=" . $row['id'] . "'>Reject</a>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No loan orders found.";
}

?>