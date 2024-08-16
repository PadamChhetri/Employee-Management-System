<?php
session_start();
// Redirect to login page if not logged in
if (!isset($_SESSION['name'])) {
  header('Location: login.php');
  exit();
}
include ('includes/header.php');
include ('includes/topbar.php');
include ('includes/sidebar.php');
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
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active"> Edit - Register Employees </li>
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
          <div class="card-header">
            <h3 class="card-title">Edit - Register Employees</h3>
            <a href="register.php" class="btn btn-danger btn-sm float-right">Back</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">

                <form method="post" action="code.php">

                  <div class="modal-body">
                    <?php
                    $con = mysqli_connect('localhost', 'root', 'root@123', 'project');
                    if (!$con) {
                      die("Connection failed: " . mysqli_connect_error());
                    }


                    if (isset($_GET['id'])) {
                      $id = $_GET['id'];
                      $query = "SELECT * FROM employe WHERE id = '$id'";
                      $query_run = mysqli_query($con, $query);


                      if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $row) {
                          ?>

                          <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                          <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="<?php echo $row['name'] ?>" class="form-control"
                              placeholder="name">
                          </div>

                          <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" value="<?php echo $row['email'] ?>" class="form-control"
                              placeholder="email">
                          </div>

                          <div class="form-group">
                            <label for="">Gender</label>
                            <select name="gender" class="form-control">
                              <option value="Male" <?php echo ($row['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                              <option value="Female" <?php echo ($row['gender'] == 'Female') ? 'selected' : '' ?>>Female
                              </option>
                              <option value="Other" <?php echo ($row['gender'] == 'Other') ? 'selected' : '' ?>>Other</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="number">Phone Number</label>
                            <input type="number" name="number" value="<?php echo $row['number'] ?>" class="form-control"
                              placeholder="phone number" maxlength="10" minlength="10" pattern="\d{10}" required>
                          </div>

                          <div class="form-group">
                            <label for="">Department</label>
                            <input type="text" name="department" value="<?php echo $row['department'] ?>" class="form-control"
                              placeholder="department">
                          </div>

                          <?php
                        }
                      } else {
                        echo "<h4>No Record Found.!</h4>";
                      }
                    }
                    ?>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" name="updateemploye" class="btn btn-info">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>