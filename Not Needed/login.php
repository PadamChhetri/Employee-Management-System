<?php 
session_start();
$message="";
if (isset($_POST['submit'])) {
	$con = mysqli_connect('localhost','root','root@123','project') or die('unable to connect');
	$name = $_POST['name'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM employe WHERE name = '$name' AND password = '$password'";

	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($result);
	$stored_name=$row["name"];
	$stored_pass=$row["password"];


	if ($name == $stored_name) {
		if($password == $stored_pass){
			header("location:index.html");
		}
		else {
			echo("invalid password");
		}
	}
	else{
		echo("invalid username");
	}

	}
	else {
		$errorr[] = 'Wrong Email/Username or password!';
	}


	
if (isset($_SESSION['id'])) {
	header("location:admin_page.php");
	exit();
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

<body>
	<div class='container'>
	<div class="box form-box">
	<header>Login</header>
	
<form method="post" action="">
	<div class="field input">
	     <label>name:</label>
	      <input type="text" name="name">
	</div>
	
	<div class="field input">
	    	<label>password:</label>
	        <input type="password" name="password">
	</div>

	<div class="field">
			<input type="submit" class="btn" name="submit" value="Login">
	</div>
 
	<div class="links">
	Don't have a account?<a href="signup.php">signup</a> 

	</div>
</form>
</div>
</div>	
</body>
</html>