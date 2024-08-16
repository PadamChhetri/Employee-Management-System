<?php
$conn=mysqli_connect('localhost','root','root@123','project');
if(!$conn) {
	die("Connection failed:".mysqli_connect_error());
}

$insert="INSERT INTO admin
(name,password)
VALUES
('admin','admin123')";
if(mysqli_query($conn,$insert)){
	echo "New record created successfully"."<br>";
}
else{
	echo "Error! ".$insert."<br>";
}
mysqli_close($conn)

?>