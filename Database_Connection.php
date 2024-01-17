<?php	
// connecting to the database
$host = "localhost";
$dbname = "suriyans_db";
$username = "root";
$password = "";

$conn = mysqli_connect($host,$username,$password,$dbname);

// to check for database connectivity issues
if (mysqli_connect_errno()){
	die("Connection To database has failed:" . mysqli_connect_error());
}

return $conn;
?>