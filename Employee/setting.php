<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Redirect to login page if not logged in
if (!isset($_SESSION['name'])) {
    header('Location: login.php');
    exit();
}

$nameError = "";
$emailError = "";
$passwordError = "";
$errorAllMessage = "";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $newPassword = $_POST['new_password'];

    // Validation (you can add more validation rules as needed)
    if (empty($name) || empty($email) || empty($password) || empty($newPassword)) {
        $errorAllMessage = "All fields are required";
    }

    if (empty($errorAllMessage)) {
        // Connect to your database (replace with your database credentials)
        $connection = mysqli_connect('localhost', 'root', 'root@123', 'project');

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve user's current password from the database
        $userId = $_SESSION['id'];
        $query = "SELECT password FROM employe WHERE id = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $storedPassword);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt); // Close the statement

        // Verify if the provided current password matches the stored password
        if (md5($password) != $storedPassword) {
            $passwordError = "Current password is incorrect";
        } else {
            // Update user's information in the database
            $updateQuery = "UPDATE employe SET name = ?, email = ?, password = ? WHERE id = ?";
            $newPasswordHash = md5($newPassword);

            $stmt = mysqli_prepare($connection, $updateQuery);
            mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $newPasswordHash, $userId);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['status'] = "Your information has been updated successfully";
                echo '<script>alert("' . $_SESSION['status'] . '")</script>';
                // header("location: dashboard.php");
            } else {
                $errorAllMessage = "Failed to update information. Please try again.";
            }
            mysqli_stmt_close($stmt); // Close the statement
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
    <title>Settings</title>
    <!-- Include Bootstrap CSS (You can link it from a CDN or download it locally) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Settings</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <?php if (!empty($errorAllMessage)): ?>
                            <div class="alert alert-danger"><?php echo $errorAllMessage; ?></div>
                        <?php endif; ?>

                        <form method="post">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="<?php echo $_SESSION['name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    value="<?php echo $_SESSION['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Current Password</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                                <?php if (!empty($passwordError)): ?>
                                    <span class="text-danger"><?php echo $passwordError; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" id="new_password" name="new_password" class="form-control"
                                    required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>