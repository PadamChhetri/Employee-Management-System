<?php
session_start();
// Redirect to login page if not logged in
if (!isset($_SESSION['name'])) {
    header('Location: login.php');
    exit();
}

$conn = mysqli_connect('localhost', 'root', 'root@123', 'project');

if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    // Check if employee has taken a loan
    $sql_check_loan = "SELECT SUM(loan_amount) AS total_loan FROM loan WHERE employe_id = '$employee_id'";
    $result_check_loan = mysqli_query($conn, $sql_check_loan);
    $row_check_loan = mysqli_fetch_assoc($result_check_loan);
    $total_loan = $row_check_loan['total_loan'];
} 

if (isset($_POST['submit'])) {
    $salary_amount = $_POST['salary_amount'];
    
    // Calculate loan deduction
    if ($total_loan > 0) {
        // Calculate 10% of the salary as loan deduction
        $loan_deduction = $salary_amount * 0.10;

        // Check if remaining loan amount is less than 10%
        if ($loan_deduction > $total_loan) {
            $loan_deduction = $total_loan; // Deduct remaining loan amount
        }
    } else {
        // Employee has no loan, no deduction
        $loan_deduction = 0;
    }

    // Adjust salary amount based on loan deduction
    $final_salary = $salary_amount - $loan_deduction;

    // Delete existing salary record for the employee, if any
    $sql_delete_salary = "DELETE FROM salary WHERE employe_id = '$employee_id'";
    mysqli_query($conn, $sql_delete_salary);

    // Insert new salary into salary table
    $sql_insert_salary = "INSERT INTO salary (employe_id, amount) 
                          VALUES ('$employee_id', '$final_salary')";

    // Update loan table with new loan deduction amount
    $sql_update_loan = "UPDATE loan SET loan_amount = loan_amount - '$loan_deduction' WHERE employe_id = '$employee_id'";

    // Check if loan amount is cleared or 0, then delete record from loan table
    if ($total_loan - $loan_deduction <= 0) {
        $sql_delete_loan = "DELETE FROM loan WHERE employe_id = '$employee_id'";
        mysqli_query($conn, $sql_delete_loan);
    }

    if ($conn ) {
        $_SESSION['status'] = "Salary Added successfully";
        header('location: givesalary.php');
      }
      else{
          $_SESSION['status'] = "Salary Added failed";
          }

    // Use a transaction to ensure all queries are executed together
    mysqli_autocommit($conn, false);
    $error = false;

    if (!mysqli_query($conn, $sql_insert_salary)) {
        $error = true;
    }

    if (!mysqli_query($conn, $sql_update_loan)) {
        $error = true;
    }

    if (!$error) {
        mysqli_commit($conn);
        exit();
    } else {
        mysqli_rollback($conn);
        echo "Error adding salary or updating loan: " . mysqli_error($conn);
    }
    

    mysqli_autocommit($conn, true);
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
                    <h1 class="m-0">Give Salary to Employee</h1>
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
            <h3 class="card-title">Salary - Give Salary to Employee</h3>
            <a href="register.php" class="btn btn-danger btn-sm float-right">Back</a>
      </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="employee_id">Employee ID:</label><br>
                                <input type="text" id="employee_id" value="<?php echo $employee_id; ?>" name="employee_id" readonly>
                            </div>
                            <div class="form-group">
                                <label for="salary_amount">Salary Amount:</label><br>
                                <input type="number" id="salary_amount" name="salary_amount" min="1" required>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit" value="Give Salary" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
mysqli_close($conn);
?>

