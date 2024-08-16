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

<?php

$nameError = "";
$passwordError = "";
$emailError = "";
$errorAllMessage = "";

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
                            <thead>
                                <tr>
                                    <!-- <th>Id</th> -->
                                    <th>Name</th>
                                    <th>Loan Amount</th>
                                    <th>Status</th>
                                    <th>Approved Date</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $conn = mysqli_connect('localhost', 'root', 'root@123', 'project');


                                
                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }
                                $sql = "SELECT * FROM loan";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    foreach ($result as $row) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['employee_name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['loan_amount']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['status']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['approved_date']; ?>
                                            </td>
                                            <!-- <td>
                                                <a href="insertloan.php ?id=<?php echo $row['id']; ?>"
                                                    class="btn btn-primary btn-sm" ?>Provide Loan</a>
                                            </td> -->
                                        </tr>
                                        <?php
                                    }
                                } else {
                                 
                                        echo "No Records found.";
                                       }
                                    ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
