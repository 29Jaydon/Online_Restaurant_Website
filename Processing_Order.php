<?php
// Retriving the order
$ChickenBunny = $_POST["ChickenBunny"];
$quantity_1 = $_POST["quantity_1"];

$MuttonBunny = $_POST["MuttonBunny"];
$quantity_2 = $_POST["quantity_2"];

$LambBreyani = $_POST["LambBreyani"];
$quantity_3 = $_POST["quantity_3"];

$MuttonBreyani = $_POST["MuttonBreyani"];
$quantity_4 = $_POST["quantity_4"];

$VegBreyani = $_POST["VegBreyani"];
$quantity_5 = $_POST["quantity_5"];

$Sandwich = $_POST["Sandwich"];
$quantity_6 = $_POST["quantity_6"];

$Samosas = $_POST["Samosas"];
$quantity_7 = $_POST["quantity_7"];

$Coke = $_POST["Coke"];
$quantity_8 = $_POST["quantity_8"];

$Fanta = $_POST["Fanta"];
$quantity_9 = $_POST["quantity_9"];

$Water = $_POST["Water"];
$quantity_10 = $_POST["quantity_10"];

$userId=$_POST["user_id"];

// connecting to the database
$host = "localhost";
$dbname = "suriyans_db";
$username = "root";
$password = "";

$conn = mysqli_connect($host,$username,$password,$dbname);

// to check for database connectivity issues
if (mysqli_connect_errno()){
	die("Connection failed:" . mysqli_connect_error());
}

// Inserting order into database
$sql_1 = "INSERT INTO shopping_cart (user_id)
		VALUES(?)";
		
$stmt_1 = mysqli_stmt_init($conn);

if (! mysqli_stmt_prepare($stmt_1, $sql_1)){
	die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt_1, "i",$userId);

mysqli_stmt_execute($stmt_1);

echo "<h2>Your shopping cart has been created</h2><br>";
