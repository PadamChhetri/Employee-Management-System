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


    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

     


          <div class="col-lg col">
             <?php
                    include('message.php');
                 ?>


            <!--  small box -->
            <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
              <?php              
                $conn=mysqli_connect('localhost','root','root@123','project');
                $query= "Select id FROM employe ORDER BY id";

                $query_run= mysqli_query($conn,$query);

                $row=mysqli_num_rows($query_run);

                echo '<h1>' .$row. '</h1>';
                ?>
            
                <p>Total Registration</p>
              </div>
              <div class="icon">
                
                <i class="ion ion-bag"></i>
              </div>
        
            </div>
          </div> 

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <?php
            include('message.php');
             ?>
            <!-- small box -->
            <div class="small-box bg-warning">
              
              <div class="inner">
              
              <div class="com-md-12">
                
               </div>
                <h3>  </h3>
                <p>Employee Registration</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="register.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div><!-- /.container-fluid -->
    </section>
 </div>


