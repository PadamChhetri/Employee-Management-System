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

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
        <div class="row">
            <div class="col-md-12">

            <?php
                     include('message.php');
            ?>

                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">

                        </table>
<?php
 
$conn = mysqli_connect('localhost', 'root', 'root@123', 'project');

if (isset($_GET['id'])) {
    $loan_id = $_GET['id'];

    // Get loan order details
    $sql_loan_order = "SELECT * FROM loan_order WHERE id=$loan_id";
    $result_loan_order = mysqli_query($conn, $sql_loan_order);

    if ($result_loan_order && mysqli_num_rows($result_loan_order) > 0) {
        $row = mysqli_fetch_assoc($result_loan_order);
        $employee_id = $row['employe_id'];
        $employee_name = $row['employee_name'];
        $loan_amount = $row['loan_amount'];
        // $reason = $row['reason'];

        // Insert accepted loan details into loan table
        $sql_loan = "INSERT INTO loan (employe_id,employee_name,loan_amount) 
                     VALUES ('$employee_id', '$employee_name', '$loan_amount')";

        if (mysqli_query($conn, $sql_loan)) {
            // Update loan order status to "Active"
            $sql_update_order = "DELETE FROM loan_order WHERE id=$loan_id";
            if (mysqli_query($conn, $sql_update_order)) {
                 $_SESSION['status']= "Loan approved successfully and added to loan table.";
            } else {
                $_SESSION['status']= "Error updating loan order status: " . mysqli_error($conn);
            }
        } else {
            $_SESSION['status']= "Error approving loan: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['status']="Loan order not found.";
    }
}

mysqli_close($conn);
?>