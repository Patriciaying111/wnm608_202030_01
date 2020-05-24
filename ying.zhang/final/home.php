<?php
require_once "lib/php/helpers.php";
?>

<?php
	$conn = makeConn();
	$products = makeQuery($conn, "SELECT * FROM `products`");
	$length = min(count($products), 4);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cosmetics Store</title>

	<!-- meta:vp -->
    <?php include "partials/head.php" ?>
</head>
<body>
	<?php include "partials/header.php" ?>
	<?php include "partials/mobile-header.php" ?>
	
	<div class='home-container'>
		<div class="view-window" style="background-image:url(img/home001.jpg); display:flex;flex-direction:column;justify-content:center;align-items:center">
			<h1 style='padding-top:200px; text-align:center;color:#fff;'>Handpicked products for you<br/></h1>
			<a href="products.php"><button class='shop-button'>Shop now</button></a>
		</div>

		<div class='intro-container'>
			<div class='row gap'>
				<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>
					<img src='img/home003.jpg' width='100%' height='100%'>
				</div>
				<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6' style='
				display:flex;flex-direction:column;justify-content:center;align-items:center;'>
					<h2 style='text-align:center;'>Cosmetics Products</h2>
					<p style='letter-space:0.6; font-size:16px'>
						Our shop handpicked a bunch of skincare, fragrance and makeup products 
						by professional makeup artists. You will no longer be shopping in a sea of products, 
						but only the best quality here.
					</p>
				</div>
			</div>
		</div>

		<div class='view-window' style="background-image:url('img/home002.jpg')"></div>

		<div class='feature-container'>
			<h3 style='font-size:20px;'>Feature products</h3>
			<div class='row gap'>
				<?php
					for($i = 0; $i < $length; $i++) {
						$price = $products[$i]->price;
						$name = $products[$i]->name;
						$src = $products[$i]->image;
						$id = (string)($products[$i]->id);
						
						echo "
							<div style='text-align:center' class='col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3'>
								<a class='product-wrapper' href='product_item.php?id=$id'>
									<div style='text-align:left'><img src='$src' alt='' class='home-product-image'></div>
									<div class='home-product-description'>
										<div class='product-name'>$name</div>
									</div>
								</a>
							</div>
						";
					}
				?>
			</div>
			
			<div style='text-align:center; margin-top:16px'>
				<a href="products.php"><button class='shop-button' style='width:200px'>Shop all products</button></a>
			</div>
		</div>
	</div>
	  
	<?php include "partials/footer.php" ?>
</body>
</html>