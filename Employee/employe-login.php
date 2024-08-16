<?php
include('includes/header.php');
?>

<?php
session_start();
$conn = mysqli_connect('localhost', 'root', 'root@123', 'project');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // var_dump($email,$password);

    $newpassword = md5($password);
    
    $sql = "SELECT * FROM employe WHERE email = '$email' AND password = '$newpassword'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); // Fetch the row as an associative array

        $_SESSION['email'] = $email;
        $_SESSION['id'] = $row['id']; // Store the ID in the session

        // You can also store other details if needed, like name:
        $_SESSION['name'] = $row['name'];
        
        echo "<script>alert('Logged In successfully')
        setTimeout(function(){
            window.location.href=\"dashboard.php\"
        },10);
        </script>";
      
    } else {
        $_SESSION['status']="Login failed. Invalid email or password.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="login.css">

<div class="section">
    <div class="container">
        <div class="row justify-content-center">

            <div class="com-md-5 my-5">

                <div class="card my-5">
                    <?php
                    include('message.php');
                    ?>
                    <div class="card-header bg-light">
                        <h5>Employee Login Form</h5>
                    </div>
                    <div class="card-body">


                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>


                            <hr>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <hr>

                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>