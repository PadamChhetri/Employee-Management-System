<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: employe-login.php');
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
                    <h1 class="m-0">My Loan</h1>
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
                                    <th>loan ID</th>
                                    <th>Employee Name</th>
                                    <th>Loan Amount</th>
                                    <th>Action</th>
                                    <th>Pay Now</th>
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

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

    $id = $_SESSION['id'];
    if($id){
    // SQL to fetch loan details based on ID
    $sql = "SELECT * FROM loan WHERE employe_id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>
        <tr>
        <td>
            <?php echo $row['loan_id']; ?>
        </td>
        <td>
            <?php echo $row['employee_name']; ?>
        </td>
        <td>
            <?php echo $row['loan_amount']; ?>
            <?php $_SESSION['loan_amount'] = $row['loan_amount']; ?>
        </td>
        <td>
            <?php echo $row['approved_date']; ?>
        </td>
        <td>
           <a href="http://localhost/SummerProject/Employee/esewa/esewa.php"><input type="button" name="Paynow" value="Pay Now"></a> 
        </td>

    </tr>

    
        <?php
    } else {
        echo "Loan not found.";
    }
} else {
    echo "Loan ID is missing in the URL parameter.";
}

mysqli_close($conn);
?>