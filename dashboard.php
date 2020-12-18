<?php
session_start();
if (isset($_SESSION["Code"]) && isset($_SESSION["Position"])) {
  $Code = $_SESSION["Code"];
  $Position = $_SESSION["Position"];
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grant Disbursment Portal</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
  </head>

  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
      <!-- Navbar -->

      <?php //require("nav_bar.php") 
      ?>

      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Dashboard</a>
          </li>
        </ul>

        <!-- Right navbar links -->

      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <?php require("side_bar.php") ?>

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
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <section class="content">

              <?php
              if ($Position == 'Admin') {
              ?>
                <!-- Info boxes -->
                <div class="row">
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-upload"></i></span>

                      <div class="info-box-content">
                        <a href="import.php">
                          <!-- <span class="info-box-text">-</span> -->
                          <h4 class="info-box-number">
                            Upload Record
                          </h4>
                        </a>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-fadded elevation-1"><i class="fas fa-eye"></i></span>

                      <div class="info-box-content">
                        <a href="view_record.php">
                          <!--   <span class="info-box-text">-</span> -->
                          <h4 class="info-box-number">View Record</h4>
                        </a>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  
                  <!-- fix for small devices only -->
                  <div class="clearfix hidden-md-up"></div>

                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                      <div class="info-box-content">
                        <a href="generate.php">
                          <!-- <span class="info-box-text">-</span> -->
                          <h5 class="info-box-number">Generate Bank Schedule</h5>
                        </a>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user"></i></span>

                      <div class="info-box-content">
                        <a href="create_user.php">
                          <!-- <span class="info-box-text">-</span> -->
                          <h5 class="info-box-number">Create Users</h5>
                        </a>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <?php
                  require('connect.php');
                  $SqlSales = mysqli_query($connection, "SELECT * FROM `users`") or die(mysqli_error($connection));
                  $Sales = mysqli_affected_rows($connection);

                  ?>

                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                      <div class="info-box-content">
                        <h5 class="info-box-text">Members</h5>
                        <h6 class="info-box-number"><?php echo $Sales; ?></h6>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <?php
              }elseif ($Position == 'User') {
              ?>
                <!-- Info boxes -->
                <div class="row">
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-upload"></i></span>

                      <div class="info-box-content">
                        <a href="import.php">
                          <!-- <span class="info-box-text">-</span> -->
                          <h4 class="info-box-number">
                            Upload Record
                          </h4>
                        </a>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  
                  
                  

                 
                  
                  <!-- /.col -->
                  <?php
                  require('connect.php');
                  $SqlSales = mysqli_query($connection, "SELECT * FROM `users`") or die(mysqli_error($connection));
                  $Sales = mysqli_affected_rows($connection);

                  ?>

                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                      <div class="info-box-content">
                        <h5 class="info-box-text">Members</h5>
                        <h6 class="info-box-number"><?php echo $Sales; ?></h6>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

              <?php
              } elseif ($Position == 'COORDINATOR') {
              ?>


                <!-- Default box -->
                <div class="card card-solid">

                  <?php
                  require("connect.php");
                  $sqlsellect = mysqli_query($connection, "SELECT * FROM `users` WHERE `Code`='$Code'") or die(mysqli_error($connection));
                  //$sqlrun=mysqli_query($connection, $sqlsellect);
                  while ($listAdmin = mysqli_fetch_array($sqlsellect)) {
                  ?>
                    <div class="card-body pb-0">
                      <div class="row d-flex align-items-stretch">
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                          <div class="card bg-light">
                            <div class="card-header text-muted border-bottom-0">
                              <?php echo $listAdmin['Position']; ?>
                            </div>
                            <div class="card-body pt-0">
                              <div class="row">
                                <div class="col-7">
                                  <h2 class="lead"><b><?php echo $listAdmin['Name']; ?></b></h2>
                                  <p class="text-muted text-sm"><b>Bank: </b> <?php echo $listAdmin['Bank']; ?>
                                    <br>
                                    <b>Account Number: </b> <?php echo $listAdmin['Account_No']; ?> </p>
                                  <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: <?php echo $listAdmin['Address']; ?></li>
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: <?php echo $listAdmin['Phone_No']; ?></li>
                                  </ul>
                                </div>
                                <div class="col-5 text-center">
                                  <?php
                                  if (($listAdmin['Photo'] != '')) {
                                  ?>
                                    <img src="uploads/<?php echo $listAdmin['Photo']; ?>" alt="user-avatar" class="img-circle img-fluid" height="150" width="150">
                                  <?php
                                  } else {
                                  ?>
                                    <img src="dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
                                  <?php
                                  }
                                  ?>
                                </div>
                              </div>
                            </div>
                            <div class="card-footer">
                              <div class="text-right">
                                <a href="#" class="btn btn-sm bg-teal">
                                  <i class="fas fa-comments"></i>
                                </a>
                                <a href="photo_upload.php?SN=<?php echo $listAdmin['Serial']; ?>" class="btn btn-sm btn-primary">
                                  <?php
                                  if ($listAdmin['Photo'] != '') {
                                  ?>
                                    <i class="fas fa-user"></i> Change Passport
                                  <?php
                                  } else {
                                  ?>
                                    <i class="fas fa-user"></i> Upload Passport
                                  <?php
                                  }
                                  ?>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  <?php } ?>
                  <div class="card-footer">
                    <nav aria-label="Contacts Page Navigation">-</nav>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->

              <?php } ?>

            </section>



        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      <?php require("footer.php") ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js"></script>
  </body>

  </html>
<?php
} else {
  header("location:index.php?error=2");
} ?>