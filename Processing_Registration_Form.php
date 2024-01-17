<?php
// Attributes of the users table
$Fname = $_POST["Fname"];
$Lname = $_POST["Lname"];
$PhoneNum = $_POST["PhoneNum"];
$Email = $_POST["Email"];
$Password = $_POST["Password"];

// Attributes of the address table
$UnitNUm = $_POST["UnitNUm"];
$StreetName = $_POST["StreetName"];
$Suburd = $_POST["Suburb"];
$City = $_POST["City"];

// creating hash value for the password
$Password_hash= password_hash($Password, PASSWORD_DEFAULT);

// Connection to the database connection file
$conn = require __DIR__ . "/Database_Connection.php";

// Creating the prepared statment for the attributes of the user_info table
$sql_1 = "INSERT INTO user_info (first_name, last_name, phone_number, email, password)
		VALUES(?,?,?,?,?)";
		
$stmt_1 = mysqli_stmt_init($conn);

if (! mysqli_stmt_prepare($stmt_1, $sql_1)){
	die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt_1, "sssss",$Fname, $Lname, $PhoneNum, $Email,$Password_hash);

mysqli_stmt_execute($stmt_1);

echo "<h2>Thank you for filling out the registration form</h2>
		<p>Your personal information has been Saved Successfuly.</p>";

//Creating the prepared statment for the attributes of the delivery_address table
$sql_UserId= "SELECT user_id  FROM user_info where(first_name= '$Fname' and last_name = '$Lname')";
$result = $conn->query($sql_UserId);
$user_id = $result->fetch_assoc();
		
$sql_2 = "INSERT INTO delivery_address (user_id , unit_num, street_name, suburb, city)
		VALUES(?,?,?,?,?)";
		
$stmt_2 = mysqli_stmt_init($conn);

if (! mysqli_stmt_prepare($stmt_2, $sql_2)){
	die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt_2, "issss",$user_id["user_id"] ,$UnitNUm, $StreetName, $Suburd, $City);

mysqli_stmt_execute($stmt_2);

echo "<p>Your Delivery information has been Saved Successfuly.<br><br>
		To proccedd to the login page <a href='Login_Page.php'>click here</a></p>";

?>
