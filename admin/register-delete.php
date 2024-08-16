<?php 
$id = $_GET['id'];
$conn = mysqli_connect('localhost', 'root', 'root@123', 'project');

// Check if the employee has taken a loan
$loan_query = "SELECT * FROM loan WHERE employe_id = '$id'";
$result = mysqli_query($conn, $loan_query);

if(mysqli_num_rows($result) > 0) {
    echo "<script>alert('This employee has taken a loan and cannot be deleted');
        setTimeout(function(){
            window.location.href=\"register.php\";
        }, 10);
        </script>";
} else {
    // No loan records found, proceed with deletion
    // First, delete corresponding records from the salary table
    $salary_query = "DELETE FROM salary WHERE employe_id = '$id'";
    mysqli_query($conn, $salary_query);

    // Then, delete the employee record from the employe table
    $employee_query = "DELETE FROM employe WHERE id = '$id'";
    mysqli_query($conn, $employee_query);

    if(mysqli_affected_rows($conn) >= 1){
        echo "<script>alert('Employee Deleted successfully');
            setTimeout(function(){
                window.location.href=\"register.php\";
            }, 10);
            </script>";
    } else {
        echo "Data delete failed: " . mysqli_error($conn);
    }
}
?>
