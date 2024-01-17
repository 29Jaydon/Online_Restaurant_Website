<?php

session_start();

if(isset($_SESSION["user_id"])){

// Connection to the database connection file
	$conn = require __DIR__ . "/Database_Connection.php";

	$sql ="SELECT * FROM user_info WHERE user_id = {$_SESSION["user_id"]} ";
					
	$result = $conn->query($sql);
	$user = $result->fetch_assoc();
	}

// Selecting and inserting  items into the cart table in the databse
if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   $user_id = $user['user_id'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE p_name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'You already have this product in your cart';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, p_name, price, image, quantity)
	  VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'The product has been successfully added to your cart';
   }

};

// creating conditions for the functions of the shopping cart
if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE c_id = '$update_id'") or die('query failed');
   $message[] = 'The quantity has been successfully updated';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE c_id = '$remove_id'") or die('query failed');
   header('location: Welcome_Page.php');
}
  
if(isset($_GET['delete_all'])){
	$user_id = $user['user_id'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:Welcome_Page.php');
}

?>

<!DOCTYPE html>
<html>

<!------------------Welcome Message--------------------->
<head>
	<title>Welcome Page </title>
	<meta charset="UTF-8">
	<link href="Menu_StyleSheet_5.css" rel="stylesheet" >
</head>
		<img src="Images/Website_Banner_Edited_1.png" class="Website_Banner">
	
	<?php if (isset($user)):?>
		<h4>Welcome back <?= htmlspecialchars($user["first_name"])?></h4>
		<p>Please view our hearty meals and tasty treats in the menu below.<br>
		Please your your shopping cart at the end of the page<br>
		Or click the button to log out: 
		<a href="Login_Page.php" onclick= "return confirm('Are you sure that you want to logout')">
			<button type="button" class= "logoutBtn">Log Out</button>
		</a></p>
	<?php endif; ?>
	

<!------------------Menu Section--------------------->
<h1>Our Menu</h1>
<div class="Product">
	<div class="MainContainer">
		<h2>Bunny Chows</h2>
		<div class="BunniesContainer">
					<?php
						$select_product = mysqli_query($conn, "SELECT * FROM product_info WHERE (category ='bunny');") or die('query failed');
						if(mysqli_num_rows($select_product) > 0){	
						while($fetch_product = mysqli_fetch_assoc($select_product)){
					?>
					<div class="ProductBox">
						<form method="post" class="box" action="">
							<img src="Images/<?php echo $fetch_product['image']; ?>" class="ProductImageBrey">
							<div class="Description">
								 <div class="name"><?php echo $fetch_product['name']; ?></div>
								 <div class="price">R<?php echo $fetch_product['price']; ?></div>
								 <label for="number">Quantity:</label>
								 <input type="number" min="1" name="product_quantity" value="1">
								 <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
								 <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>" class="p_name">
								 <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
								 <input type="submit" value="add to cart" name="add_to_cart" class="btn">
							</div>
						</form>
					</div>
						 
				<?php
					};
				};
				?>
		</div>
	
		<h2>Assorted Breyanis </h2>
		<div class= "BreyaniContainer">
			<?php
				$select_product = mysqli_query($conn, "SELECT * FROM product_info WHERE (category ='beryani');") or die('query failed');
				if(mysqli_num_rows($select_product) > 0){	
				while($fetch_product = mysqli_fetch_assoc($select_product)){
			?>
				<div class="ProductBox">
					<form method="post" class="box" action="">
						<img src="Images/<?php echo $fetch_product['image']; ?>" class="ProductImageBrey">
						<div class="Description">
							 <div class="name"><?php echo $fetch_product['name']; ?></div>
							 <div class="price">R<?php echo $fetch_product['price']; ?></div>
							 <label for="number">Quantity:</label>
							 <input type="number" min="1" name="product_quantity" value="1">
							 <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
							 <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>" class="p_name">
							 <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
							 <input type="submit" value="add to cart" name="add_to_cart" class="btn">
						</div>
					 </form>
				</div>			 
			<?php
				};
			};
			?>
		</div>
		
		<h2>Light Meals and Finger foods</h2>
		<div class= "LightMealsContainer">
			<?php
				$select_product = mysqli_query($conn, "SELECT * FROM product_info WHERE (category ='fingerfood');") or die('query failed');
				if(mysqli_num_rows($select_product) > 0){	
				while($fetch_product = mysqli_fetch_assoc($select_product)){
			?>
				<div class="ProductBox">
					<form method="post" class="box" action="">
						<img src="Images/<?php echo $fetch_product['image']; ?>" class="ProductImageBrey">
						<div class="Description">
							 <div class="name"><?php echo $fetch_product['name']; ?></div>
							 <div class="price">R<?php echo $fetch_product['price']; ?></div>
							 <label for="number">Quantity:</label>
							 <input type="number" min="1" name="product_quantity" value="1">
							 <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
							 <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>" class="p_name">
							 <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
							 <input type="submit" value="add to cart" name="add_to_cart" class="btn">
						</div>
					 </form>
				</div>			 
			<?php
				};
			};
			?>
		</div>

		
		<h2>beverages</h2>
		<div class= "BevContainer">
		<?php
				$select_product = mysqli_query($conn, "SELECT * FROM product_info WHERE (category ='bev');") or die('query failed');
				if(mysqli_num_rows($select_product) > 0){	
				while($fetch_product = mysqli_fetch_assoc($select_product)){
			?>
				<div class="ProductBox">
					<form method="post" class="box" action="">
						<img src="Images/<?php echo $fetch_product['image']; ?>" class="ProductImageBrey">
						<div class="Description">
							 <div class="name"><?php echo $fetch_product['name']; ?></div>
							 <div class="price">R<?php echo $fetch_product['price']; ?></div>
							 <label for="number">Quantity:</label>
							 <input type="number" min="1" name="product_quantity" value="1">
							 <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
							 <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>" class="p_name">
							 <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
							 <input type="submit" value="add to cart" name="add_to_cart" class="btn">
						</div>
					</form>
				</div>			 
			<?php
				};
			};
			?>
		</div><br>
	</div>
</div>
<!------------------Shopping Cart--------------------->	
<h4> Your Shopping Cart </h4>

<div class="shopping-cart">
   <table>
      <thead>
         <th>Image</th>
         <th>Product Name</th>
         <th>Price</th>
         <th>Quantity</th>
         <th>Total Price</th>
         <th>Action</th>
      </thead>
      <tbody>
      <?php
		 $user_id = $user['user_id'];
		 $cart_info = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
		 $total_price = 0;
		 if(mysqli_num_rows($cart_info) > 0){
			while($fetch_cart_info = mysqli_fetch_assoc($cart_info)){
      ?>
         <tr>
            <td><img src="Images/<?php echo $fetch_cart_info['image']; ?>" height="100"></td>
            <td><?php echo $fetch_cart_info['p_name']; ?></td>
            <td>R<?php echo $fetch_cart_info['price']; ?></td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart_info['c_id']; ?>">
                  <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart_info['quantity']; ?>">
                  <input type="submit" name="update_cart" value="update" class="option-btn">
               </form>
            </td>
            <td>R<?php echo $sub_total = ($fetch_cart_info['price'] * $fetch_cart_info['quantity']); ?></td>
            <td><a href="Welcome_Page.php?remove=<?php echo $fetch_cart_info['c_id']; ?>" class="delete-btn" 
				onclick="return confirm('Are you sure that you want to remove item from cart?');">Remove Item</a></td>
         </tr>
      <?php
         $total_price = $total_price + $sub_total;
            }
         }else{
            echo "<tr><td>Your Cart is Empty</td></tr>";
         }
      ?>
      <tr class="table-bottom">
         <td colspan="4">Total Price:</td>
         <td>R<?php echo $total_price; ?></td>
         <td><a href="Welcome_Page.php?delete_all=<?php echo $user_id; ?>" onclick="return confirm('Are you sure that you want to DELETE ENTIRE CART?');"
			class="delete-btn <?php echo ($total_price > 1)?'':'disabled'; ?>">Delete all</a></td>
      </tr>
   </tbody>
   </table>

   <a href="Checkout.html" >
		<button type="button" class= "PlaceOrderBtn">Place order</button>
	</a>

</div>

</html>
	


