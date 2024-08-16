<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="img/download.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Himshikhar school</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="img/admin.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $_SESSION["name"]; ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="#" class=" ">
            <p>
              Dashboard
            </p>
          </a>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>My Details</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="takeloan.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Take Loan</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="myloan.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p> My Loan</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="setting.php" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Setting</p>
          </a>
        </li>

        </a>
        </li>
      </ul>
      </li>
  </div>
  <!-- /.sidebar -->
</aside>