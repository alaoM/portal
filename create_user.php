<?php 
require("connect.php");
session_start();
if (!(isset($_SESSION["Code"]) && isset($_SESSION["Position"]))) {
  $Code = $_SESSION["Code"];
  $Position = $_SESSION["Position"];
  header("location:index.php?error=2");
}

if (isset($_POST['submit'])) {

  //very basic validation

 
  //email validation
  if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $error[] = 'Please enter a valid email address';
} else {
  $stmt = $db->prepare('SELECT email FROM users WHERE email = :email');
  $stmt->execute(array(':email' => $_POST['email']));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if(!empty($row['email'])){
    $error[] = 'Email provided is already in use.';
  }

}
//cluster code validation
if (empty($_POST['code'])) {
  $error[] = "Please enter your Code";

}

  //if no errors  created carry on
  if (!isset($error)) {

  

    try {

      //insert into database with a prepared statement
      $stmt = $db->prepare('INSERT INTO users (Code, name, email, Phone_No, Position) VALUES (:code,:name,:email,:phoneNumber,:Position )');
      $stmt->execute(array(

        ':code' => $_POST['code'],
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':phoneNumber' => $_POST['phoneNumber'],
        ':Position' => 'User',

        
        
      ));
      $id = $db->lastInsertId('SN');

      //redirect to index page
      header('Location: create_user.php?action=joined');
      exit;

      

      //else catch the exception and show the error.
    } catch (PDOException $e) {
      $error[] = $e->getMessage();
    }
  }
}

//define page title
$title = 'Register';


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
          <a href="#" class="nav-link">Create Users</a>
        </li>
      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.html" class="brand-link">
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

            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Create Users</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 col-lg-8 border border-black"><?php
                //check for any errors
                if (isset($error)) {
                  foreach ($error as $error) {
                    echo '<p class="btn-danger">' . $error . '</p>';
                  }
                }

                //if action is joined show sucess
                if (isset($_GET['action']) && $_GET['action'] == 'joined') {
                  echo "<p class='btn-success'>Registration successful.<p><br>";
                 
                }
                ?><h2 class="row justify-content-center align-items-center">Register New Admin</h2>
              <form role="form-example" action="" method="post">
             

                <div class="form-group card-footer">

                  <input class="form-control" type="text" name="name" placeholder="Enter Full Name" value="<?php if(isset($error)){ echo $_POST['name']; } ?>"><br>
                  <input class="form-control" type="text" name="phoneNumber" placeholder="Enter Phone Number" value="<?php if(isset($error)){ echo $_POST['phoneNumber']; } ?>"><br>
                  <input class="form-control" type="email" name="email" placeholder="Enter Email" required value="<?php if(isset($error)){ echo $_POST['email']; } ?>"><br>
                  <input class="form-control" type="text" name="code" placeholder="Enter Code" required value="<?php if(isset($error)){ echo $_POST['code']; } ?>"><br>


                  <input type="submit" class="btn btn-primary " name="submit" value="Submit">
                </div>

              </form>

              <hr>


              <!-- /.card -->


              <!-- /.card -->
            </div>
            <!-- /.col -->



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

</body>

</html>