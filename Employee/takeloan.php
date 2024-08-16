<?php
session_start();
include('includes/topbar.php');

if (!isset($_SESSION["email"])) {
    header("Location: employee-login.php");
    exit();
}

$connection = mysqli_connect('localhost', 'root', 'root@123', 'project');

if (!$connection) {
    die("Connection failed:" . mysqli_connect_error());
}

$employee_id = $_SESSION['id'];
$employee_name = $_SESSION['name'];

// Check if employee already has a loan
$sql_check_loan = "SELECT * FROM loan WHERE employe_id = '$employee_id'";
$sql_check_loanorder = "SELECT * FROM loan_order WHERE employe_id = '$employee_id'";

$result_check_loan = mysqli_query($connection, $sql_check_loan);
$result_check_loanOrder = mysqli_query($connection, $sql_check_loanorder);

$loan_status = "";
if (mysqli_num_rows($result_check_loan) > 0 || mysqli_num_rows($result_check_loanOrder) > 0) {
    $loan_status = "You have already taken a loan.";
}

if (isset($_POST['submit'])) {
    $loan_amount = $_POST['loan_amount'];
    $reason = $_POST['reason'];

    $sql = "INSERT INTO loan_order (employe_id, employee_name, loan_amount, reason) 
            VALUES ('$employee_id', '$employee_name', '$loan_amount', '$reason')";

    $result = mysqli_query($connection, $sql);

    if ($result) {
        $_SESSION['status'] = "Loan order successfully submitted.";
    } else {
        $_SESSION['status'] = "Loan registration failed: " . mysqli_error($connection);
    }

    mysqli_close($connection);
    header("Location: dashboard.php"); // Redirect to dashboard or any other page
    exit();
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Loan</title>
    <!-- Include your stylesheets here -->
    <script>
        window.onload = function() {
            <?php if (!empty($loan_status)): ?>
                alert("<?php echo $loan_status; ?>");
                window.location.href = 'dashboard.php';
            <?php endif; ?>
        };
    </script>
</head>
<body>
    <?php 
    if(isset($_SESSION['status'])): 
    ?>
        <div style="color: green;">
        <?php
         echo $_SESSION['status']; 
        ?>
        </div>
        <?php 
        unset($_SESSION['status']); 
        ?>
    <?php endif; ?>

    <?php if (empty($loan_status)): ?>
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
                            <!-- Breadcrumb -->
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
                            <h3 class="card-title">Take Loan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body"></div>

                        <form method="post" action="">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Employee ID:</label>
                                    <input type="text" id="employee_id" name="employee_id" class="form-control" placeholder="id" value="<?php echo $_SESSION['id']; ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="loan_amount">Loan Amount:</label>
                                    <input type="number" id="loan_amount" name="loan_amount" class="form-control" placeholder="Amount" required>
                                </div>

                                <div class="form-group">
                                    <label for="reason">Reason:</label>
                                    <textarea id="reason" name="reason" rows="4" cols="50" class="form-control" placeholder="Reason" required></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Submit Loan Application" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>

<?php
include('includes/header.php');
include('includes/sidebar.php');
?>
