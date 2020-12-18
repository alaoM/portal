<?php
session_start();
if(isset($_POST['Login'])){
		require('connect.php');
		$CPCode = $_POST['CPCode'];
		$CPCode = stripslashes($CPCode);
		$CPCode = mysqli_real_escape_string($connection, $CPCode);
		//$username = md5($username);
				
		$password=$_POST['Password'];
		$password = stripslashes($password);
		$password = mysqli_real_escape_string($connection, $password);
		//$password=md5($password);
		
			
		
$sqlquerry="SELECT * FROM `users` WHERE `Code`='$CPCode' && `Phone_No`='$password' LIMIT 1";
			$sqlrun=mysqli_query($connection, $sqlquerry);
			$sqlCount=mysqli_affected_rows($connection);
			
				if($sqlCount==1){
						while($access=mysqli_fetch_array($sqlrun)){

							$_SESSION["Name"]=$access['Name'];
							$_SESSION["Code"]=$access['Code'];
							$_SESSION["Status"]=$access['Status'];
							$_SESSION["Password"]=$access['Password'];
							$_SESSION["Phone_No"]=$access['Phone_No'];
							$_SESSION["Position"]=$access['Position'];
							$_SESSION["Account_No"]=$access['Account_No'];
							$_SESSION["Registered_By"]=$access['Registered_By'];
							$_SESSION["Status"]=$access['Status'];
							//$_SESSION["Change_Password"]=$access[Change_Password];
							
							//$UserState=$_SESSION["State"];
											
							//Taking Logs							
								//$myFile = $_SESSION["First_Name"]." ".$_SESSION["Surname"]." ".$_SESSION["Other_Name"].".txt"; 
								$myFile ="Logo.jpeg"; 
								$fh = fopen($myFile, 'a+') or die("can't open file"); 
								//$stringData =date("D, d F Y H:I:s"); 
						fwrite($fh, " || New Record | ". $_SESSION["Name"]." with Phone Number ".$_SESSION["Phone_No"]." Logs in On ".date("D, d M Y H:i:s")); 
								fclose($fh);
						            header('location:dashboard.php');
						}//end of whileloop
				}else {
					header('location:index.php?error=1');
				}
			
		
}elseif(isset($_POST['Change'])){
		require("connection/connect.php");
		
		$username = $_SESSION['Email_Address'];
		//$username = stripslashes($username);
		//$username = mysqli_real_escape_string($connection, $username);
		//$username = md5($username);
				
		$password=$_POST['Password'];
		$password = stripslashes($password);
		$password = mysqli_real_escape_string($connection, $password);
		//$password=md5($password);
		
		
		$sqlUpdate= mysqli_query($connection, "UPDATE `users` SET `Password` = '$password', `Change_Password`='0' WHERE `users`.`Email_Address` = '$username'") or die(mysqli_error($connection));
		header("location:index.php?Change_Succ");
		
}else {
			header('location:index.php?error=2');
		}
?>