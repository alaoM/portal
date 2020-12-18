<?php
session_start();
error_reporting();

use Phppot\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();
if (!(isset($_SESSION["Code"]) && isset($_SESSION["Position"]))) {
    $Code = $_SESSION["Code"];
    $Position = $_SESSION["Position"];
    header("location:index.php?error=2");
}

if (isset($_POST["import"])) {

    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {

        $file = fopen($fileName, "r");

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {

            /*  $userId = "";
            if (isset($column[0])) {
                $userId = mysqli_real_escape_string($conn, $column[0]);
            } */
            $Serial = "";
            if (isset($column[0])) {
                $Serial = mysqli_real_escape_string($conn, $column[0]);
            }
            $Code = "";
            if (isset($column[1])) {
                $Code = mysqli_real_escape_string($conn, $column[1]);
            }

            $Name = "";
            if (isset($column[2])) {
                $Name = mysqli_real_escape_string($conn, $column[2]);
            }
            $Age = "";
            if (isset($column[3])) {
                $Age = mysqli_real_escape_string($conn, $column[3]);
            }

            $Address = "";
            if (isset($column[4])) {
                $Address = mysqli_real_escape_string($conn, $column[4]);
            }
            $Bank = "";
            if (isset($column[5])) {
                $Bank = mysqli_real_escape_string($conn, $column[5]);
            }

            $Account_No = "";
            if (isset($column[6])) {
                $Account_No = mysqli_real_escape_string($conn, $column[6]);
            }

            $Position = "";
            if (isset($column[7])) {
                $Position = mysqli_real_escape_string($conn, $column[7]);
            }

            $Phone_No = "";
            if (isset($column[8])) {
                $Phone_No = mysqli_real_escape_string($conn, $column[8]);
            }
            $sql = "SELECT Name FROM users where Name = '$Name' ";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            if ((!empty($row['Name'])) && ($row['Name'] = $Name)) {
                $error[] = "$Code" . " already submitted.";
            }
            $sql = "SELECT Code FROM users WHERE Code = '$Code' ";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            if ($row > 6) {
                $error[] = "$Code" . " already submitted.";
            }
            if (!isset($error)) {
                $sqlInsert = "INSERT  into users (Serial, Code,Name,Age,Address,Bank, Account_No, Position, Phone_No)
                   values (?,?,?,?,?,?,?,?,?)";
                $paramType = "sssssssss";
                $paramArray = array(
                    $Serial,
                    $Code,
                    $Name,
                    $Age,
                    $Address,
                    $Bank,
                    $Account_No,
                    $Position,
                    $Phone_No
                );
                $insertId = $db->insert($sqlInsert, $paramType, $paramArray);

                if (!empty($insertId)) {
                    $type = "success";
                    $message = "CSV Data Imported into the Database";
                } else {
                    $message = "Problem in Importing CSV Data";
                    $type = "error";
                }
            }
        }
    }
}

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
    <script type="text/javascript">
        $(document).ready(function() {
            $("#frmCSVImport").on("submit", function() {

                $("#response").attr("class", "");
                $("#response").html("");
                var fileType = ".csv";
                var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");

                if (!regex.test($("#file").val().toLowerCase())) {
                    $("#response").addClass("error");
                    $("#response").addClass("btn-danger");
                    $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
                    return false;
                }
                return true;
            });
        });
    </script>
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
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Import Records</a>
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
                            <h1>DataTables</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Import Records</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-md-6 col-lg-8 border border-black">
                            <div id="response" class="<?php if (!empty($type)) {
                                                            echo $type . " btn btn-success";
                                                        } ?>">
                                <?php
                                if (isset($error)) {
                                    foreach ($error as $error) {
                                        echo '<p class="btn-danger">' . $error . '</p>';
                                    }
                                }
                                if (!empty($message)) {
                                    echo $message;
                                } ?>
                            </div>
                            <form class="form-example" action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">

                                <div class="card-body">

                                    <div class="card-footer">
                                        <label for="exampleInputEmail1">Import Multiple files on a go. </label><br>
                                        <p>Please note, all files must be in .CSV Format</P>
                                        <input type="file" name="file" id="file" accept=".csv">

                                        <button type="submit" id="submit" name="import" class="btn btn-primary btn-customized">Import</button>
                                    </div>
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