<?php
require_once "lib/php/helpers.php";
?>

<?php
	$conn = makeConn();
	$cart_products = makeQuery(
		$conn, 
		"SELECT `products`.id, `products`.image, `products`.name, `products`.price, `cart`.count, `cart`.id AS cartId 
		FROM `cart` INNER JOIN `products` ON `cart`.productId = `products`.id WHERE `status`='unpaid'"
	);
	$length = count($cart_products);
	$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cart</title>

	<!-- meta:vp -->
	<?php include "partials/head.php" ?>
</head>

<body style="height:auto;">
	<?php include "partials/header.php" ?>
	<?php include "partials/mobile-header.php" ?>

	<div class='cart-container'>
		<div style="display:flex; width:100%; justify-content:center;">
			<div style="width:70%; border:1px solid #ddd; padding:2%; margin-top:24px">
				<div class='cart-navbar row'>
					<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>Products</div>
					<div class='col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2'>Price</div>
					<div class='col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2'>Quantity</div>
					<div class='col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2'>Admin</div>
				</div>
				
				<?php
					$total = 0.0;
					for($i = 0; $i < $length; $i++) {
						$name = $cart_products[$i]->name;
						$src = $cart_products[$i]->image;
						$price = $cart_products[$i]->price;
						$count = $cart_products[$i]->count;
						$total += $price * $count;
						$cartId = $cart_products[$i]->cartId;
						# <a href='checkout.php?cartid=$cartId'><button class='cart-admin-button' style='color:#fff; background-color:#F2798F'>Check out</button></a>
						# <button class='cart-admin-button' style='color:#F2798F; background-color:#fff' onClick='deleteCart($cartId)'>Delete</button>
						echo "
							<div class='row' style='margin-top:16px; align-items:center;'>
								<div class='row gap col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6' style='align-items:center'>
									<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>
										<img src='$src' class='cart-image' alt=''>
									</div>
									<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>$name</div>
								</div>
								<div class='col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2'>$ $price</div>
								<div class='col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2'>X $count</div>
								<div class='col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2'>
									<a style='cursor:pointer; text-decoration:none;color:#000;' onClick='deleteCart($cartId)'>Delete</a>
								</div>
							</div>

							<div style='border:1px solid #ddd; height:1px; margin-top:16px'></div>
						";
					}

					echo "
						<div style='margin-top:16px; text-align:right;'>
							<h3>Total: $ $total</h3>
						</div>
					";
				?>

				<div style="margin-top:16px; text-align:right">
					<a href="checkout.php?cartid=all"><button class='cart-admin-button' style='width:130px; height:40px; color:#fff; background-color:#000'>Check all</button></a>
					<a href="products.php"><button class='cart-admin-button' style='width:130px; height:40px; color:#000; background-color:#f5e7df'>Cancel</button></a>
				</div>
			</div>
		</div>
	</div>

	<?php include "partials/footer.php" ?>
</body>
</html>