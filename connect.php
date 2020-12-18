<?php
ob_start();
$host="localhost"; // Host 
$username="root";
//$username="shinnin1_cw"; // Mysql username
$password = "";
//$password="Cyberlock12*"; // Mysql password
$db_name="shinnin1_cw"; // Database name


// Connect to server and select databse.
$connection = mysqli_connect("$host", "$username", "$password")or die("cannot connect");
//mysqli_select_db($connection, $db_name) or die("cannot select DB");
mysqli_select_db($connection,'shinnin1_cw');
if(!$connection){
	    die("Database Connection Failed" . mysqli_error());
	}

// Check connection
if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 ?>


<?php
ob_start();



//database credentials
//define('DBHOST','localhost');        // This should work if not try ip website address or define path to your database
///define('DBUSER','shinnin1_cw'); // Database username most often with the database prefix_username if not try username
//define('DBPASS','Cyberlock12*');        // Database Password
//define('DBNAME', 'shinnin1_cw');   // Database name most often with the database prefix_databasename if not try databasename


//database credentials
define('DBHOST','localhost');        // This should work if not try ip website address or define path to your database
define('DBUSER','root'); // Database username most often with the database prefix_username if not try username
define('DBPASS','');        // Database Password
define('DBNAME', 'shinnin1_cw');   // Database name most often with the database prefix_databasename if not try databasename




try {

	//create PDO connection
	//$db2 = mysqli_connect("localhost", "shinnin1_cw", "Cyberlock12*", "shinnin1_cw");
	$db2 = mysqli_connect("localhost", "root", "", "shinnin1_cw");
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}
//include the user class, pass in the database connection
include('classes/user.php');
include('classes/phpmailer/mail.php');
$user = new User($db);

?>
