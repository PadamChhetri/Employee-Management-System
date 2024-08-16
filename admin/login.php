<?php
include('includes/header.php');
?>

<?php
session_start();


$conn=mysqli_connect('localhost','root','root@123','project');


if(isset($_POST['login']))
{
    $name=$_POST['name'];
    $password=$_POST['password'];

    $sql = "SELECT * FROM admin WHERE name = '$name' AND password = '$password'";

	$result = mysqli_query($conn,$sql);
	$row = mysqli_num_rows($result);
	if($row==1){

		$_SESSION['name']=$name;
        // $_SESSION['status']="Logged In successfully";
        echo "<script>alert('Logged In successfully')
        setTimeout(function(){
            window.location.href=\"index.php\"
        },10);
        </script>";
        
		// header('location:index.php');
	}
	else{
		$_SESSION['status']="Access Denied";
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
                        <h5>Admin Login Form</h5>
                    </div>
                    <div class="card-body">

                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="name">
                            </div>


                            <hr>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="password">
                            </div>

                            <div class="form-group">
                                <button type="submit" name="login" class="btn btn-primary btn-block" >Login</button>
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

