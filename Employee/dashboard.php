<?php

session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['email'])) {
    header('Location: employe-login.php');
    exit();
}
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">

                </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
    <!-- Page content -->
    <div class="content">
        <h2>Welcome,<br> <?php echo $_SESSION["name"]; ?></h2>
    </div> 
    </div></div>
</body>
</html>
