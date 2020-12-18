<?php
session_start();
$UserEmail=$_SESSION['Email_Address'];
$Date=date("Y-m-d");

if(isset($_POST['Sales'])){
	require("../connection/connect.php");

	// Define $myusername and $mypassword
$Date=date("Y-m-d");

		$Pump_Id=$_POST['Pump_Id'];
		$Pump_Id = stripslashes($Pump_Id);
		$Pump_Id = mysqli_real_escape_string($connection, $Pump_Id);

		$Open_Bal=$_POST['Open_Bal'];
		$Open_Bal = stripslashes($Open_Bal);
		$Open_Bal = mysqli_real_escape_string($connection, $Open_Bal);

		$Close_Bal=$_POST['Close_Bal'];
		$Close_Bal = stripslashes($Close_Bal);
		$Close_Bal = mysqli_real_escape_string($connection, $Close_Bal);

		$Staff_Name=$_POST['Staff_Name'];
		$Staff_Name = stripslashes($Staff_Name);
		$Staff_Name = mysqli_real_escape_string($connection, $Staff_Name);

		$Product=$_POST['Product'];
		$Product = stripslashes($Product);
		$Product = mysqli_real_escape_string($connection, $Product);

		$Cash=$_POST['Cash'];
		$Cash = stripslashes($Cash);
		$Cash = mysqli_real_escape_string($connection, $Cash);

	
		$SqlPrice=mysqli_query($connection, "SELECT * FROM `price` WHERE `Product`='$Product' ORDER BY `SN` DESC LIMIT 1") OR die(mysqli_error($connection));
		$Price=mysqli_fetch_array($SqlPrice);
		
		$Price=$Price['Amount'];
		
		$Litre=($Close_Bal - $Open_Bal);
		
		$Amount=($Litre * $Price);
		
	$sql="INSERT INTO `sales` (`Pump_Id`, 
								`Product`,
								`Staff_Name`,
								`Open_Reading`, 
								`Closing_Reading`, 
								`Pump_Price`, 
								`Litre`,
								`Cash`, 
								`Amount`, 
								`Date`, 
								`Registered_By`) 
						VALUES ('$Pump_Id',
								'$Product',
								'$Staff_Name',
								'$Open_Bal',
								'$Close_Bal',
								'$Price',
								'$Litre',
								'$Cash',
								'$Amount',
								'$Date',
								'$UserEmail'
								)";
		if(mysqli_query($connection, $sql) or die(mysqli_error($connection))){
			header("location:table.php?Action=Successful");
		}else{
			header("location:index.php?Error");
		}
	}elseif(isset($_POST['Bank_Deposite'])){
	require("../connection/connect.php");

	// Define $myusername and $mypassword
$Date=date("Y-m-d");

		$D_Date=$_POST['D_Date'];
		$D_Date = stripslashes($D_Date);
		$D_Date = mysqli_real_escape_string($connection, $D_Date);

		$Staff_Name=$_POST['Staff_Name'];
		$Staff_Name = stripslashes($Staff_Name);
		$Staff_Name = mysqli_real_escape_string($connection, $Staff_Name);

		$Bank=$_POST['Bank'];
		$Bank = stripslashes($Bank);
		$Bank = mysqli_real_escape_string($connection, $Bank);

		$Account_Name=$_POST['Account_Name'];
		$Account_Name = stripslashes($Account_Name);
		$Account_Name = mysqli_real_escape_string($connection, $Account_Name);

		$Account_No=$_POST['Account_No'];
		$Account_No = stripslashes($Account_No);
		$Account_No = mysqli_real_escape_string($connection, $Account_No);

		$Teller_Id=$_POST['Teller_Id'];
		$Teller_Id = stripslashes($Teller_Id);
		$Teller_Id = mysqli_real_escape_string($connection, $Teller_Id);

		$Amount=$_POST['Amount'];
		$Amount = stripslashes($Amount);
		$Amount = mysqli_real_escape_string($connection, $Amount);


	$sql="INSERT INTO `bank_deposite` (`Teller_Date`, 
	                                    `Bank`, 
	                                    `Teller_Id`, 
	                                    `Account_No`, 
	                                    `Amount`, 
	                                    `Depositor`, 
	                                    `Account_Name`) 
	                           VALUES ('$D_Date', 
	                                    '$Bank', 
	                                    '$Teller_Id', 
	                                    '$Account_No', 
	                                    '$Amount', 
	                                    '$Staff_Name', 
	                                    '$Account_Name')";
		if(mysqli_query($connection, $sql) or die(mysqli_error($connection))){
			header("location:bank_deposite.php?Action=Successful");
		}else{
			header("location:index.php?Error");
		}
	}elseif(isset($_POST['Supply'])){
	require("../connection/connect.php");

	// Define $myusername and $mypassword
		$Quantity=$_POST['Quantity'];
		$Quantity = stripslashes($Quantity);
		$Quantity = mysqli_real_escape_string($connection, $Quantity);

		$Product=$_POST['Product'];
		$Product = stripslashes($Product);
		$Product = mysqli_real_escape_string($connection, $Product);

		$Hullage=$_POST['Hullage'];
		$Hullage = stripslashes($Hullage);
		$Hullage = mysqli_real_escape_string($connection, $Hullage);

		$Driver=$_POST['Driver'];
		$Driver = stripslashes($Driver);
		$Driver = mysqli_real_escape_string($connection, $Driver);

		$Vehiecle =$_POST['Vehiecle'];
		$Vehiecle = stripslashes($Vehiecle);
		$Vehiecle = mysqli_real_escape_string($connection, $Vehiecle);

		
	$sql="INSERT INTO `stock` (`Quantity`,
	                              `Product`, 
	                              `Hullage`, 
	                              `Driver_Name`, 
	                              `Vehiecle_No`, 
	                              `Date`, 
							      `Register_By`) 
						VALUES ('$Quantity',
								'$Product',
								'$Hullage',
								'$Driver',
								'$Vehiecle',
								'$Date',
								'$UserEmail'
								)";
		if(mysqli_query($connection, $sql) or die(mysqli_error($connection))){
			header("location:index.php?Action=Successful");
		}else{
			header("location:index.php?Error");
		}
	}elseif(isset($_POST['Dispense'])){
	require("../connection/connect.php");

	// Define $myusername and $mypassword
		$Quantity=$_POST['Quantity'];
		$Quantity = stripslashes($Quantity);
		$Quantity = mysqli_real_escape_string($connection, $Quantity);

		$Product=$_POST['Product'];
		$Product = stripslashes($Product);
		$Product = mysqli_real_escape_string($connection, $Product);

		$Company=$_POST['Company'];
		$Company = stripslashes($Company);
		$Company = mysqli_real_escape_string($connection, $Company);

		$Reciever=$_POST['Reciever'];
		$Reciever = stripslashes($Reciever);
		$Reciever = mysqli_real_escape_string($connection, $Reciever);

		$Pump_Id =$_POST['Pump_Id'];
		$Pump_Id = stripslashes($Pump_Id);
		$Pump_Id = mysqli_real_escape_string($connection, $Pump_Id);

		$Staff_Name =$_POST['Staff_Name'];
		$Staff_Name = stripslashes($Staff_Name);
		$Staff_Name = mysqli_real_escape_string($connection, $Staff_Name);


	$sql="INSERT INTO `sales` (`Pump_Id`, 
								`Product`,
								`Staff_Name`,
								`Litre`,
								`Company`,
								`Reciever`,
								`Date`, 
								`Registered_By`) 
						VALUES ('$Pump_Id',
								'$Product',
								'$Staff_Name',
								'$Quantity',
								'$Company',
								'$Reciever',
								'$Date',
								'$UserEmail'
								)";
		if(mysqli_query($connection, $sql) or die(mysqli_error($connection))){
		   	$sql="INSERT INTO `company_sales` (`Company`, 
		                                    `Product`, 
		                                    `Reciever`, 
		                                    `Pump_Id`, 
		                                    `Staff_Name`, 
		                                    `Quantity`, 
		                                    `Date`, 
		                                    `Registered_By`) 
        		                        VALUES ('$Company',
        		                                '$Product',
        		                                '$Reciever',
        		                                '$Pump_Id',
        		                                '$Staff_Name',
        		                                '$Quantity',
        		                                '$Date',
        		                                '$UserEmail'
        		                                )";
		    		if(mysqli_query($connection, $sql) or die(mysqli_error($connection))){
			            header("location:index.php?Action=Successful");
		    		}
		}else{
			header("location:index.php?Error");
		}
	}elseif(isset($_POST['Expensis'])){
	require("../connection/connect.php");

	// Define $myusername and $mypassword
		$Amount=$_POST['Amount'];
		$Amount = stripslashes($Amount);
		$Amount = mysqli_real_escape_string($connection, $Amount);

		$Discription =$_POST['Discription'];
		$Discription = stripslashes($Discription);
		$Discription = mysqli_real_escape_string($connection, $Discription);

		
	$sql="INSERT INTO `expensis` (`Amount`,
	                              `Discription`, 
	                              `Date`, 
							      `Register_By`) 
						VALUES ('$Amount',
								'$Discription',
								'$Date',
								'$UserEmail'
								)";
		if(mysqli_query($connection, $sql) or die(mysqli_error($connection))){
			header("location:index.php?Action=Successful");
		}else{
			header("location:index.php?Error");
		}
	}elseif(isset($_POST['Company'])){
	require("../connection/connect.php");

	// Define $myusername and $mypassword
		$CName=$_POST['CName'];
		$CName = stripslashes($CName);
		$CName = mysqli_real_escape_string($connection, $CName);

		$CAddress =$_POST['CAddress'];
		$CAddress = stripslashes($CAddress);
		$CAddress = mysqli_real_escape_string($connection, $CAddress);

		
	$sql="INSERT INTO `company` (`Name`,
	                              `Address`, 
	                              `Date`, 
							      `Registered_By`) 
						VALUES ('$CName',
								'$CAddress',
								'$Date',
								'$UserEmail'
								)";
		if(mysqli_query($connection, $sql) or die(mysqli_error($connection))){
			header("location:index.php?Action=Successful");
		}else{
			header("location:index.php?Error");
		}
	}elseif(isset($_POST['Deposite'])){
	require("../connection/connect.php");

	// Define $myusername and $mypassword
		$DName=$_POST['DName'];
		$DName = stripslashes($DName);
		$DName = mysqli_real_escape_string($connection, $DName);

		$Product =$_POST['Product'];
		$Product = stripslashes($Product);
		$Product = mysqli_real_escape_string($connection, $Product);

		$Amount =$_POST['Amount'];
		$Amount = stripslashes($Amount);
		$Amount = mysqli_real_escape_string($connection, $Amount);

			$SqlPrice=mysqli_query($connection, "SELECT * FROM `price` WHERE `Product`='$Product' ORDER BY `SN` DESC LIMIT 1") OR die(mysqli_error($connection));
			$ProductP=mysqli_fetch_array($SqlPrice);
			$ProductPrice=$ProductP['Amount'];


        $ProductQuantity=($Amount/$ProductPrice);
        
		
	$sql="INSERT INTO `deposite` (`Name`,
	                              `Product`, 
	                              `Price`, 
	                              `Amount`, 
	                              `Quantity`, 
	                              `Date`, 
							      `Registered_By`) 
						VALUES ('$DName',
								'$Product',
								'$ProductPrice',
								'$Amount',
								'$ProductQuantity',
								'$Date',
								'$UserEmail'
								)";
		if(mysqli_query($connection, $sql) or die(mysqli_error($connection))){
			header("location:index.php?Action=Successful");
		}else{
			header("location:index.php?Error");
		}
	}elseif(isset($_POST['Submit_Pump'])){
	require("../connection/connect.php");

	// Define $myusername and $mypassword
		$Pump_Id=$_POST['Pump_Id'];
		$Pump_Id = stripslashes($Pump_Id);
		$Pump_Id = mysqli_real_escape_string($connection, $Pump_Id);

		
	$sql="INSERT INTO `pump` (`Name`,
	                           `Date`,
							`Registered_By`) 
						VALUES ('$Pump_Id',
								'$Date',
								'$UserEmail'
								)";
		if(mysqli_query($connection, $sql) or die(mysqli_error($connection))){
			header("location:index.php?Action=Successful");
		}else{
			header("location:index.php?Error");
		}
	}elseif(isset($_POST['Submit_Price'])){
	require("../connection/connect.php");

	// Define $myusername and $mypassword
		$Pump_Id=$_POST['Pump_Id'];
		$Pump_Id = stripslashes($Pump_Id);
		$Pump_Id = mysqli_real_escape_string($connection, $Pump_Id);

		$Product=$_POST['Product'];
		$Product = stripslashes($Product);
		$Product = mysqli_real_escape_string($connection, $Product);

		
	$sql="INSERT INTO `price` (`Amount`, 
							`Product`,
							`Date`,
							`Registered_By`) 
						VALUES ('$Pump_Id',
								'$Product',
								'$Date',
								'$UserEmail'
								)";
		if(mysqli_query($connection, $sql) or die(mysqli_error($connection))){
			header("location:index.php?Action=Successful");
		}else{
			header("location:index.php?Error");
		}
	}elseif(isset($_POST['Submit_Staff'])){
	require("../connection/connect.php");

	// Define $myusername and $mypassword
		$First_Name=$_POST['First_Name'];
		$First_Name = stripslashes($First_Name);
		$First_Name = mysqli_real_escape_string($connection, $First_Name);

		$Last_Name=$_POST['Last_Name'];
		$Last_Name = stripslashes($Last_Name);
		$Last_Name = mysqli_real_escape_string($connection, $Last_Name);

		$Phone_No=$_POST['Phone_No'];
		$Phone_No = stripslashes($Phone_No);
		$Phone_No = mysqli_real_escape_string($connection, $Phone_No);

		$Email_Address=$_POST['Email_Address'];
		$Email_Address = stripslashes($Email_Address);
		$Email_Address = mysqli_real_escape_string($connection, $Email_Address);

		
	$sql="INSERT INTO `staff` (`First_Name`, 
							`Last_Name`,
							`Phone_No`,
							`Email_Address`,
							`Date`,
							`Registered_By`) 
						VALUES ('$First_Name',
								'$Last_Name',
								'$Phone_No',
								'$Email_Address',
								'$Date',
								'$UserEmail'
								)";
		if(mysqli_query($connection, $sql) or die(mysqli_error($connection))){
			header("location:index.php?Action=Successful");
		}else{
			header("location:index.php?Error");
		}
	}