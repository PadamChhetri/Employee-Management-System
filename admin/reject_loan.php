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
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">

                    <!-- <li><a href="logout.php" class="btn">Logout</a></li> -->
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

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php

$conn = mysqli_connect('localhost', 'root', 'root@123', 'project');

if (isset($_GET['id'])) {
    $loan_id = $_GET['id'];

    // Update loan order status to "Rejected"
    $sql = "DELETE FROM loan_order WHERE id=$loan_id";

    if (mysqli_query($conn, $sql)) {
        echo "Loan order rejected successfully.";
    } else {
        echo "Error rejecting loan order: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>