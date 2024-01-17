<?php
$conn = require __DIR__ . "/Database_Connection.php";

$sql_user = mysqli_query($conn,"SELECT * FROM user_info")or die('query_1 failed');

$select_cart = mysqli_query($conn, "SELECT * FROM `cart`") or die('query_2 failed');

$select_Address = mysqli_query($conn, "SELECT * FROM `delivery_address`") or die('query_2 failed');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome Page </title>
	<meta charset="UTF-8">
	<link href="Global_Stylesheet.css" rel="stylesheet" >
	<style>
		table, th, td {
		  border: 1px solid black;
		}
	</style>
</head>
	<img src="Images/Website_Banner_Edited_1.png" class="Website_Banner">
	<h2>Admin Report</h2>
<div>
	
	<table>
	<h1>Registered users</h1>
      <thead>
		 <th>ID</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Phone Number</th>
         <th>Email</th>
      </thead>
      <tbody>
		<?php
			if(mysqli_num_rows($sql_user) > 0){
			// output data of each row
			while($fetch_UserInfo = mysqli_fetch_assoc($sql_user)) {
		?>
		<tr>
			<td><?php echo $fetch_UserInfo['user_id']; ?></td>
            <td><?php echo $fetch_UserInfo['first_name']; ?></td>
			<td><?php echo $fetch_UserInfo['last_name']; ?></td>
			<td><?php echo $fetch_UserInfo['phone_number']; ?></td>
			<td><?php echo $fetch_UserInfo['email']; ?></td>	
		</tr>
		<?php
			}
		}
		?>
	   </tbody>
	 </table>
</div>		

<div>	
	<h1>Delivery Address</h1>
	<table>
      <thead>
		 <th>Address ID</th>
         <th>User ID</th>
         <th>Unit Number</th>
         <th>Street Name</th>
         <th>Suburb</th>
		 <th>City</th>
      </thead>
      <tbody>
		<?php
			if(mysqli_num_rows($select_Address ) > 0){
			// output data of each row
			while($fetch_CartInfo = mysqli_fetch_assoc($select_Address)) {
		?>
		<tr>
			<td><?php echo $fetch_CartInfo['address_id']; ?></td>
            <td><?php echo $fetch_CartInfo['user_id']; ?></td>
			<td><?php echo $fetch_CartInfo['unit_num']; ?></td>
			<td><?php echo $fetch_CartInfo['street_name']; ?></td>
			<td><?php echo $fetch_CartInfo['suburb']; ?></td>
			<td><?php echo $fetch_CartInfo['city'] ?></td>
		</tr>
		<?php
			}
		}
		?>
		</tbody>
	</table>
</div>

<div>	
	<h1>Orders</h1>
	<table>
      <thead>
		 <th>Cart ID</th>
         <th>User ID</th>
         <th>Product</th>
         <th>Quantity</th>
         <th>Price per unit</th>
		 <th>Total Price</th>
		 <th>Delivered</th>
      </thead>
      <tbody>
		<?php
			if(mysqli_num_rows($select_cart ) > 0){
			// output data of each row
			while($fetch_CartInfo = mysqli_fetch_assoc($select_cart)) {
		?>
		<tr>
			<td><?php echo $fetch_CartInfo['c_id']; ?></td>
            <td><?php echo $fetch_CartInfo['user_id']; ?></td>
			<td><?php echo $fetch_CartInfo['p_name']; ?></td>
			<td><?php echo $fetch_CartInfo['quantity']; ?></td>
			<td><?php echo $fetch_CartInfo['price']; ?></td>
			<td><?php echo $fetch_CartInfo['price']* $fetch_CartInfo['quantity']; ?></td>
			<td><form><input type="checkbox" id="delivered" name="delivered" value="yes"></form></td>
		</tr>
		<?php
			}
		}
		?>
		</tbody>
	</table>
</div>