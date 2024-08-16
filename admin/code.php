<?php
// session_start();
// // Redirect to login page if not logged in
// if (!isset($_SESSION['name'])) {
//     header('Location: login.php');
//     exit();
// }

// $con = mysqli_connect('localhost', 'root', 'root@123', 'project');
// if (!$con) {
//     die("Connection failed:" . mysqli_connect_error());
// }

// if (isset($_POST['updateemploye'])) {

//     $id = $_POST['id'];
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $gender = $_POST['gender'];
//     $number = $_POST['number'];
//     $department = $_POST['department'];

//     $query = "UPDATE employe SET name='$name',email='$email',gender='$gender',number='$number',department='$department' where id='$id'  ";

//     $query_run = mysqli_query($con, $query);
    
//     if ($query_run) {
//         $_SESSION['status'] = "Employee Updated successfully";
//         header("location:register.php");
//     } else {
//         $_SESSION['status'] = "Employee Updated failed";
//         header("location:register.php");

//     }
// }

?>

<?php
session_start();
// Redirect to login page if not logged in
if (!isset($_SESSION['name'])) {
    header('Location: login.php');
    exit();
}

$con = mysqli_connect('localhost', 'root', 'root@123', 'project');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['updateemploye'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $number = $_POST['number'];
    $department = $_POST['department'];

    // Validate phone number
    if (!preg_match('/^\d{10}$/', $number)) {
        $_SESSION['status'] = "Phone number must be exactly 10 digits.";
        header("location:register.php");
        exit();
    }

    // Check for unique email
    $email_check_query = "SELECT * FROM employe WHERE email = '$email' AND id != '$id'";
    $email_check_result = mysqli_query($con, $email_check_query);

    if (mysqli_num_rows($email_check_result) > 0) {
        $_SESSION['status'] = "Email already exists.";
        header("location:register.php");
        exit();
    }

    // Check for unique phone number
    $number_check_query = "SELECT * FROM employe WHERE number = '$number' AND id != '$id'";
    $number_check_result = mysqli_query($con, $number_check_query);

    if (mysqli_num_rows($number_check_result) > 0) {
        $_SESSION['status'] = "Phone number already exists.";
        header("location:register.php");
        exit();
    }

    // Update employee data
    $query = "UPDATE employe SET name='$name', email='$email', gender='$gender', number='$number', department='$department' WHERE id='$id'";
    $query_run = mysqli_query($con, $query);
    
    if ($query_run) {
        $_SESSION['status'] = "Employee updated successfully.";
    } else {
        $_SESSION['status'] = "Employee update failed: " . mysqli_error($con);
    }

    header("location:register.php");
}

mysqli_close($con);
?>