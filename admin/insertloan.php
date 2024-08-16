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

<!-- Content Wrapper. Contains page content -->

<?php
if (isset($_POST['submit'])) {
    $connection = mysqli_connect('localhost', 'root', 'root@123', 'project');

    if (!$connection) {
        die("Connection failed:" . mysqli_connect_error());
    }

    $employee_id = $_POST['id'];
    $loan_amount = $_POST['loan_amount'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = $_POST['reason'];

    // Properly quote the string values in the SQL query
    $sql = "INSERT INTO loan (employe_id, loan_amount, start_date, end_date, reason) 
            VALUES ('$employee_id', '$loan_amount', '$start_date', '$end_date', '$reason')";

    $result = mysqli_query($connection, $sql);

    if ($result) {
        $_SESSION['status'] = "Loan Added successfully";
    } else {
        $_SESSION['status'] = "Loan registration failed: " . mysqli_error($connection);
    }

    mysqli_close($connection);
    // header("location:insertloan.php");
		// header('location:index.php');

    exit();
}
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
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"> Loan provider Employees </li>
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
                    <div class="card-header">
                        <h3 class="card-title">Edit - Register Employees</h3>
                        <a href="register.php" class="btn btn-danger btn-sm float-right">Back</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form method="post" action="">
                                    <div class="modal-body">
                                        <?php

                                        $con = mysqli_connect('localhost', 'root', 'root@123', 'project');
                                        if (!$con) {
                                            die("Connection failed: " . mysqli_connect_error());
                                        }
                                        if (isset($_GET['id'])) {
                                            $id = $_GET['id'];
                                            $query = "SELECT * FROM employe where id = '$id'";
                                            $query_run = mysqli_query($con, $query);

                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $row) {
                                                    ?>
                                                    <div class="form-group">
                                                        <label for="">ID</label>
                                                        <input type="text" name="id" value="<?php echo $row['id'] ?>"
                                                            class="form-control" placeholder="name" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Name</label>
                                                        <input type="text" name="name" value="<?php echo $row['name'] ?>"
                                                            class="form-control" placeholder="name" readonly>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label for="loan_amount">Loan Amount:</label>
                                                        <input type="number" id="loan_amount" name="loan_amount" required><br><br>

                                                        <label for="start_date">Start Date:</label>
                                                        <input type="date" id="start_date" name="start_date" required><br><br>

                                                        <label for="end_date">End Date:</label>
                                                        <input type="date" id="end_date" name="end_date" required><br><br>

                                                        <label for="reason">Reason:</label><br>
                                                        <textarea id="reason" name="reason" rows="4" cols="50"></textarea><br><br>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>


                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" name="submit" class="btn btn-info">Give Loan</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>