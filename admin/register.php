<?php
session_start();
// Redirect to login page if not logged in
if (!isset($_SESSION['name'])) {
    header('Location: login.php');
    exit();
}

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<?php 

$nameError="";
$passwordError="";
$emailError="";
$errorAllMessage="";

?>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
      
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<div class="container">
  <div class="row">
    <div class="col-md-12">

    <!-- to show message of update and add -->
    <?php
       include('message.php');
    ?>

  <div class="card">
      <div class="card-header">
            <h3 class="card-title">Registered Employees</h3>
            <a href="register_add.php" data-target="#AddEmployeModal" class="btn btn-primary btn-sm float-right">Add Employe</a>
      </div>
              <!-- /.card-header -->
      <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">

                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>Date of Joining</th>
                    <th>Dept</th>
                    <th>Post</th>
                    <th>Gender</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php 

                    $conn=mysqli_connect('localhost','root','root@123','project');
                     if(!$conn){
	                    die("Connection failed: ".mysqli_connect_error());
                      }
                      $sql="SELECT * FROM employe";
                      $result=mysqli_query($conn, $sql);

                      if(mysqli_num_rows($result)>0)
                      { 
                        foreach($result as $row){
                          ?>

                          
                        <tr>
		                      <td><?php echo $row['id'];?></td>
		                      <td><?php echo $row['name'];?></td>
	                        <td><?php echo $row['email'];?></td>
	                        <td><?php echo $row['date_of_joining'];?></td>
                          <td><?php echo $row['department'];?></td>
	                        <td><?php echo $row['post'];?></td>
	                        <td><?php echo $row['gender'];?></td>
	                        <td><?php echo $row['number'];?></td>
	                        <!-- <td><?php //echo $row['salary'];?></td> -->
                         <td>
                          <a href="register-edit.php ?id=<?php echo $row['id'];?>" class="btn btn-primary btn-sm"?>edit</a>
	                        <a href="register-delete.php ?id=<?php echo $row['id'];?>" class="btn btn-danger  btn-sm"?>delete</a>
                         </td>
                        </tr>
                        <?php
                        }
                      }
                      else{
                       echo "No Records found.";
                      }
                      ?> 
              </tbody>
          </table>
                
      </div>
    </div>
    </div>   
  </div>
</div>

</div>





<?php
include('includes/footer.php');
?>