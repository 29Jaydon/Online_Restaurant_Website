<?php
	if($_SERVER["REQUEST_METHOD"]=== "POST"){

	// Connection to the database connection file
	$conn = require __DIR__ . "/Database_Connection.php";

	// Retrieving users information
	$sql = sprintf("SELECT * FROM  user_info WHERE email = '%s'",
					$conn-> real_escape_string($_POST["Email"]));
					
	$result = $conn->query($sql);
	$user = $result->fetch_assoc();
	
	// Checking Password and creating a session variable 
	if($user){
		if(password_verify($_POST["Password"],$user["password"])){
			session_start();
			$_SESSION["user_id"] = $user["user_id"];
			header("Location: Welcome_Page.php");
			exit;
		}
	}
	$AdminName="ADMIN101@gmail.com";
	$AdminPass="ADMIN@101";
	if($_POST["Password"] == $AdminPass && $_POST["Email"] == $AdminName){
		header("Location: Admin_Reports.php");
		exit;
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<link href="Registration_Form_StyleSheet.css" rel="stylesheet" >
</head>
<body>
	<img src="Images/Website_Banner_Edited_1.png" class="Website_Banner">
	<div class="Questions">
		<form method="post">
			<label for="Email">Email Address</label>
			<input type="text" id="Email" name="Email">
			
			<label for="Password">Password</label>
			<input type="text" id="Password" name="Password"><br>
			
			<button>Login</button>
		</form>
		<p>If you don't have an account yet, you can <a href="Registration_Form.html">create one here</a>.</p>
		<p>If you want to see our menu without creating an account or loging in <a href="Menu.html"> Click here</a>.</p>
	</div>
</body>
</html>