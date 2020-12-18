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
    <title>Record</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="index.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">View Record</a>
          </li>
        </ul>

      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <?php require('side_bar.php'); ?>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>DataTables</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">View Record</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row ">

              <div class="">
                <form role="form-example" action="" method="post">


                  <div class="card-footer">
                    <h5 for="exampleInputEmail1">Fetch All Records</h5><br>
                    <input type="submit" class="btn btn-primary" name="All" value="Generate Report">
                  </div>


                </form>
              </div>
              <hr>
              <form role="form-example" action="" method="post">
                <div class=" card-footer">
                  <label for="exampleInputEmail1">Fetch with CP Code</label><br>
                  <input class="" type="text" name="CP_Code" placeholder="Enter CP Code" required id="CP_Code"><br>

                  <input type="submit" class="btn btn-primary" name="Search" value="Search">
                </div>

              </form>
            </div>

            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
     <!--  </div>

      </section>
    </div>
    </div> -->

    <?php
    if (isset($_POST['Search'])) {
      require("connect.php");

      $CP_Code = $_POST['CP_Code'];
      $CP_Code = stripslashes($CP_Code);
      $CP_Code = mysqli_real_escape_string($connection, $CP_Code);

      $SqlTable = mysqli_query($connection, "SELECT * FROM users WHERE Code='$CP_Code' AND Position <> 'Admin' AND Position <> 'User' ORDER BY Code ASC") or die(mysqli_error($connection));

    ?>
      <div class="col-12">

        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>SN</th>
                  <th>Code</th>
                  <th>Name(s)</th>
                  <th>Age</th>
                  <th>Address</th>
                  <th>Bank</th>
                  <th>Account No</th>
                  <th>Position</th>
                  <th>Phone No.</th>
                  <th>Photo</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($Record = mysqli_fetch_array($SqlTable)) {
                ?>
                  <tr>
                    <td><?php echo $Record['Serial']  ?></td>
                    <td><?php echo $Record['Code']  ?></td>
                    <td><?php echo $Record['Name']  ?></td>
                    <td><?php echo $Record['Age']  ?></td>
                    <td><?php echo $Record['Address']  ?></td>
                    <td><?php echo $Record['Bank']  ?></td>
                    <td><?php echo $Record['Account_No']  ?></td>
                    <td><?php echo $Record['Position']  ?></td>
                    <td><?php echo $Record['Phone_No']  ?></td>
                    <td>

                      <?php
                      if ($Record['Photo'] == '') {
                      ?>
                        <i class="btn btn-danger">No Available<i />
                        <?php
                      } else {
                        ?>
                          <i class="btn btn-success"><a href="#" target="_blank">Available</a><i />
                          <?php
                        }
                          ?>

                    </td>
                    <td>
                      <a href="editrecord.php?SN=<?php echo $Record['Serial']; ?>" class="ion-android-cancel">Delete</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>SN</th>
                  <th>Code</th>
                  <th>Name(s)</th>
                  <th>Age</th>
                  <th>Address</th>
                  <th>Bank</th>
                  <th>Account No</th>
                  <th>Position</th>
                  <th>Phone No.</th>
                  <th>Photo</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->

    <?php } elseif (isset($_POST['All'])) { ?>

      <div class="col-12">

        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
          </div>

          <?php
          require("connect.php");
          $SqlTable = mysqli_query($connection, "SELECT * FROM users WHERE  Position <> 'Admin' AND Position <> 'User'  ORDER BY 'Code' ASC") or die(mysqli_error($connection));

          ?>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>SN</th>
                  <th>Code</th>
                  <th>Name(s)</th>
                  <th>Age</th>
                  <th>Address</th>
                  <th>Bank</th>
                  <th>Account No</th>
                  <th>Position</th>
                  <th>Phone No.</th>
                  <th>Photo</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($Record = mysqli_fetch_array($SqlTable)) {
                ?>
                  <tr>
                    <td><?php echo $Record['Serial']  ?></td>
                    <td><?php echo $Record['Code']  ?></td>
                    <td><?php echo $Record['Name']  ?></td>
                    <td><?php echo $Record['Age']  ?></td>
                    <td><?php echo $Record['Address']  ?></td>
                    <td><?php echo $Record['Bank']  ?></td>
                    <td><?php echo $Record['Account_No']  ?></td>
                    <td><?php echo $Record['Position']  ?></td>
                    <td><?php echo $Record['Phone_No']  ?></td>
                    <td>

                      <?php
                      if ($Record['Photo'] == '') {
                      ?>
                        <i class="btn btn-danger">No Available<i />
                        <?php
                      } else {
                        ?>
                          <i class="btn btn-success"><a href="#" target="_blank">Available</a><i />
                          <?php
                        }
                          ?>

                    </td>
                    <td>
                      <a href="editrecord.php?SN=<?php echo $Record['Serial']; ?>" class="ion-android-cancel">Delete</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>SN</th>
                  <th>Code</th>
                  <th>Name(s)</th>
                  <th>Age</th>
                  <th>Address</th>
                  <th>Bank</th>
                  <th>Account No</th>
                  <th>Position</th>
                  <th>Phone No.</th>
                  <th>Photo</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->


    <?php } ?>
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require('footer.php'); ?>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
      $(function() {
        $("#example1").DataTable({
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>
  </body>

  </html>
<?php
} else {
  header("location:index.php?error=2");
} ?>