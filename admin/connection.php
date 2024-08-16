<?php
// create connecrion 
$conn=mysqli_connect('localhost','root','root@123');

//check connection
if (!$conn) {
	die("connection failed: ".
		mysqli_connect_error());
}
else{
	echo "connected";
}
// create database 
$sql = "CREATE DATABASE project";
if (mysqli_query($conn,$sql)) {
	echo "Database created successfully";
}else{
	echo "Error creating database ";
}
mysqli_close($conn);
?>  
