<?php
session_start();
$Code=$_SESSION['Code'];
$SN=$_POST['SN'];
$msg = ""; 

// If upload button is clicked ... 
if (isset($_POST['upload'])) { 

	$filename = $_FILES["fileToUpload"]["name"];
	$filename = $Code.'_'.$SN.'_'.$filename;
	
	$tempname = $_FILES["fileToUpload"]["tmp_name"];	 
	$folder = "uploads/".$filename; 
		
	require('connect.php');
	//$db = mysqli_connect("localhost", "cw", "Lockitup@1ce", "photos"); 

		// Get all the submitted data from the form 
		//$sql = "INSERT INTO image (filename) VALUES ('$filename')"; 
		$sql="UPDATE `users` SET `Photo` = '$filename' WHERE `Serial` = '$SN' LIMIT 1 ";

		// Execute query 
		mysqli_query($connection, $sql); 
		
		// Now let's move the uploaded image into the folder: image 
		if (move_uploaded_file($tempname, $folder)) { 
			$msg = "Image uploaded successfully";
			header('location:dashboard.php');
			exit();
		}else{ 
			$msg = "Failed to upload image"; 
	}  
//$result = mysqli_query($db, "SELECT * FROM image"); 
}else{
	header('location:logout.php');
}
?>
