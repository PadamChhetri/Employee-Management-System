<?php 

$nameError="";
$passwordError="";
$emailError="";
$errorAllMessage="";

?>


<?php
	if(isset($_POST['submit'])){
    
		// $id = $_POST['id'];
		$name = $_POST['name'];
		$password = $_POST['password'];
        $email = $_POST['email'];
        $salary = $_POST['salary'];

		$newpassword = md5($password);
		// echo($newpassword);

		if ( empty($name) || empty($password)  || empty($email) || empty($salary)){
			$errorAllMessage ="All Fields needs to be filled up!!";
		}

		if(empty($name)){
			$nameError="name is empty";
		}


		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$emailError="Email is not valid";
		}

		if(strlen($password)<8){
			$passwordError="password must be at least 8 character long";

		}

		else{
			// create connection
			$connection=mysqli_connect('localhost','root','root@123','project');
		
		//check connection
		if (!$connection) {
			die("Connection failed: ".
			mysqli_connect_error() );
		}
		$sql = "INSERT INTO employe(name,password,email,salary)
				VALUES ('$name','$newpassword','$email','$salary')";
		if (mysqli_query($connection, $sql)) {
			echo "New record inserted successfully";
		}
		else{
		echo "Error: ";
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
	<title>Register</title>
</head>
<link rel="stylesheet" href="login.css">

<body>
	<div class='container'>
	<div class="box form-box">
	<header>signup</header>
	
<form method="post" action="">
	
<!-- <div class="field input">
 	   <label>Employe id</label>
	   <input type="text" name="id">
</div> -->

	<div class="field input">
	     <label>name:</label>
	      <input type="text" name="name">
		  <?php echo  "<span style='color:red; '>".  $nameError.  "</span>" ?>

	</div>
	
	<div class="field input">
	    	<label>password:</label>
	        <input type="password" name="password">
			<?php echo  "<span style='color:red; '>".  $passwordError.  "</span>" ?>

	</div>

 	<div class='field input'>
		<label>email</label>
		<input type="text" name="email">
		<?php echo  "<span style='color:red; '>".  $emailError.  "</span>" ?>

	</div>

	<div class='field input'>
		<label>salary</label>
		<input type="salary" name="salary">
    </div>


<?php
 echo "<span style='color:red; '>". $errorAllMessage ."</span>";
?>
	<div class="field">
			<input type="submit" class="btn" name="submit" value="Signup">
	</div>
 
	<div class="links">
	 Have a account?<a href="login.php">Login</a> 

	</div>
</form>
</div>
</div>	



</body>
</html>