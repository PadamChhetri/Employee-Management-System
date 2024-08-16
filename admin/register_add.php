<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['name'])) {
    header('Location: login.php');
    exit();
}

$nameError = "";
$passwordError = "";
$emailError = "";
$genderError = "";
$numberError = "";
$dateError = "";
$errorAllMessage = "";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $post = $_POST['post'];
    $gender = $_POST['gender'];
    $number = $_POST['number'];
    $qualification = $_POST['qualification'];
    $date_of_joining = $_POST['date_of_joining'];

    $newpassword = md5($password);

    // Check for empty fields
    if (empty($name) || empty($password) || empty($email) || empty($department) || empty($post) || empty($gender) || empty($number) || empty($qualification) || empty($date_of_joining)) {
        $errorAllMessage = "All Fields need to be filled up!!";
    }

    if (empty($name)) {
        $nameError = "Name is empty";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Email is not valid";
    }

    if (strlen($password) < 8) {
        $passwordError = "Password must be at least 8 characters long";
    }

    if (empty($gender)) {
        $genderError = "Gender is not selected";
    }

    if (!is_numeric($number) || strlen($number) != 10) {
        $numberError = "Number must be a 10-digit number";
    }

    // Validate date_of_joining
    $current_date = date("Y-m-d");
    if ($date_of_joining > $current_date) {
        $dateError = "Date of joining cannot be in the future";
    }

    if (empty($errorAllMessage) && empty($dateError)) {
        $connection = mysqli_connect('localhost', 'root', 'root@123', 'project');

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $check_query = "SELECT * FROM employe WHERE email = ?";
        $stmt = mysqli_prepare($connection, $check_query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $_SESSION['status'] = "Employee with this email already exists";
            header('Location: register.php');
            exit();
        } else {
            $insert_query = "INSERT INTO employe (name, password, email, department, post, gender, number, qualification, date_of_joining)
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($connection, $insert_query);
            mysqli_stmt_bind_param($stmt, "sssssssss", $name, $newpassword, $email, $department, $post, $gender, $number, $qualification, $date_of_joining);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['status'] = "Employee Added successfully";
                header('location: register.php');
                exit();
            } else {
                $_SESSION['status'] = "Employee registration failed";
            }
        }
        mysqli_close($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Employees</h3>
                    <a href="register.php" class="btn btn-danger btn-sm float-right">Back</a>
                </div>
                <div class="card-body">

                    <form method="post" action="">

                        <div class="modal-body">
                            <!-- Other form fields -->
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="name" required>
                                <?php echo "<span style='color:red;'>$nameError</span>"; ?>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="password" required>
                                <?php echo "<span style='color:red;'>$passwordError</span>"; ?>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="email" required>
                                <?php echo "<span style='color:red;'>$emailError</span>"; ?>
                            </div>
                            <div class="form-group">
                                <label for="">Gender</label><br>
                                <input type="radio" name="gender" value="Male" required> Male
                                <input type="radio" name="gender" value="Female" required> Female
                                <input type="radio" name="gender" value="Other" required> Other
                                <?php echo "<span style='color:red;'>$genderError</span>"; ?>
                            </div>
                            <div class="form-group">
                                <label for="">Number</label>
                                <input type="text" name="number" class="form-control" placeholder="number" required>
                                <?php echo "<span style='color:red;'>$numberError</span>"; ?>
                            </div>
                            <div class="form-group">
                                <label for="">Qualification</label>
                                <select name="qualification" class="form-control" required>
                                    <option value="">Select Qualification</option>
                                    <option value="High School">High School</option>
                                    <option value="Associate Degree">Associate Degree</option>
                                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                                    <option value="Master's Degree">Master's Degree</option>
                                    <option value="Doctorate">Doctorate</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Department</label>
                                <select name="department" class="form-control" required>
                                    <option value="">Select Department</option>
                                    <option value="IT">IT</option>
                                    <option value="Finance">Finance</option>
                                    <option value="HR">HR</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Operation">Operation</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Post</label>
                                <select name="post" class="form-control" required>
                                    <option value="">Select Post</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Assistant">Assistant</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Date of Joining</label>
                                <input type="date" name="date_of_joining" class="form-control" required>
                                <?php echo "<span style='color:red;'>$dateError</span>"; ?>
                            </div>
                            <?php if ($errorAllMessage != ""): ?>
                                <div class="alert alert-danger">
                                    <?php echo $errorAllMessage; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
