<?php
session_start();
use Phppot\DataSource;
if(isset($_SESSION["Code"]) && isset($_SESSION["Position"])){
	$Code=$_SESSION["Code"];
	$Position=$_SESSION["Position"];
?>

<?php
if(isset($_POST['submit'])) {
	require_once("ConnectDB.php");
 
	// Verify file format as CSV
	$filename = $_FILES['csv']['name'];
	$extension = explode('.', $filename);
	$extension = array_pop($extension);
        
        // Check whether "Skip 1st line" is checked, if checked- set $flag
        $flag = (!isset($_POST['skipLine'])) ? true : false;
 
	if (strtolower($extension) == "csv") {
		// Get DSN connection to database
		$db = ConnectDB::getConnection();
		
		$AA=strtolower($UserState);
		
		// Define Sql query, in case of duplicate key it will update the row
		//$sql = "INSERT INTO sales (SN, price, quantity) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE product_id=VALUES(product_id),price=VALUES(price),quantity=VALUES(quantity)";
		
		$sql = "INSERT INTO $AA (SN,First_Name,Age,Gender,Bank,Account_No,BVN,Phone_No,Location,Project,Amount,Segment_Name)VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
		ON DUPLICATE KEY UPDATE SN=VALUES(SN),First_Name=VALUES(First_Name),Age=VALUES(Age),Gender=VALUES(Gender),Bank=VALUES(Bank),Account_No=VALUES(Account_No),BVN=VALUES(BVN),
		Phone_No=VALUES(Phone_No),Location=VALUES(Location),Project=VALUES(Project),Amount=VALUES(Amount),Segment_Name=VALUES(Segment_Name)";
                
                
		// Prepare Sql query to be executed
		$stmt = $db->prepare($sql);
                
		// Define row count variable to get total number of rows inserted
		$rowCount = 0;
		
		// Get temp name and open file
		$temp_name = $_FILES['csv']['tmp_name'];
		$file_handle = fopen($temp_name, 'r');
                
		// Loop through the file and get contents into an array using fgetcsv 
		while (($items = fgetcsv($file_handle, 1200, ',')) !== FALSE) {
 
			// If $flag is set then skip first line and unset $flag
			if($flag) { $flag = false; continue; }
                        
                        // Execute prepared query
			$stmt->execute($items);
 
			// Add 1 to total number of rows inserted
                        $rowCount++;
		
		//Additional UPDATE
	//	$Beneficiary_Id = $UserState."/". $LGCode."/".$SegmentCode.$rowCount;
      //     $SqlBen=mysqli_query($connection, "UPDATE `$AA` SET `Beneficiary_Id` = '$Beneficiary_Id', `Segment_Name`='$UserSeg', `State`='$UserState', `LGA`='$UserLG', `Regitered_By` = '$UserEmail' WHERE `sno` = '$rowCount' LIMIT 1") or die(mysqli_error($connection));
 
		}
 
		// Close the opened file
		fclose($file_handle);
		
		// Set success message
		$msg = "<div class=\"alert alert-info\"><strong>Success!</strong> Successfully inserted $rowCount row(s).</div>";
 
	} else {
 
	// Set error message if the file is not .csv
	$msg = "<div class=\"alert alert-info\"><strong>Oops!</strong> Not a CSV file.</div>";
	}	 	 
}

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
<script src="jquery-3.2.1.min.js"></script>


	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->

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
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Upload Record</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php
	require('side_bar.php');
	?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Upload Record</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Upload Record</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Upload CSV to database!</h5>
                <br >

    <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
        </div>
    <div class="outer-scontainer">
			
				<!-- Display error/success message -->
				<?=(isset($msg)) ? $msg : ""?>
				
				<form action="" method="post" enctype="multipart/form-data">
				    <div class="form-group">
					<label for="csv">Select CSV file to upload:</label>
					<input type="file" name="csv" id="csv" class="form-control">
				    </div>
				    <!-- <div class="checkbox">
					<label><input type="checkbox" checked name="skipLine" value="skipLine"> Skip first line (if column names)</label>
				    </div> -->
				    <button type="submit" name="submit" class="btn btn-default">Upload CSV</button>
				</form>


              </div>
            </div>

            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
<?php require('footer.php'); ?></div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
<?php
}else{
header("location:index.php?error=2");
} ?>