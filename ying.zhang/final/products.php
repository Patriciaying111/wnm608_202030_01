<?php
require_once "lib/php/helpers.php";
?>

<?php
	$conn = makeConn();
	$products = makeQuery($conn, "SELECT * FROM `products`");
	$length = count($products);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cosmetics Store product list</title>

	<? include "partials/head.php" ?>
</head>
<body style="height:auto;">
	<?php include "partials/header.php" ?>
	<?php include "partials/mobile-header.php" ?>
	
	<div class='all-products-container'>
		<div class='row gap'>
			<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 search-bar'>
				<input placeholder="Search your product" class="product-search" />
			</div>

			<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 row gap' style="margin-top:16px">
				<div class='col-xs-6 col-sm-6 col-md-3 col-lg-2 col-xl-2'>
					<button class='filter-button' onClick="search('all')">All</button>
				</div>

				<div class='col-xs-6 col-sm-6 col-md-3 col-lg-2 col-xl-2'>
					<button class='filter-button' onClick="search('type1')">Skin Care</button>
				</div>
				
				<div class='col-xs-6 col-sm-6 col-md-3 col-lg-2 col-xl-2'>
					<button class='filter-button' onClick="search('type2')">Fragrance</button>
				</div>
				
				<div class='col-xs-6 col-sm-6 col-md-3 col-lg-2 col-xl-2'>
					<button class='filter-button' onClick="search('type3')">Makeup</button>
				</div>

				<div class='col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4' class='sort-container'>
					<select class='sort-filter' onChange="changeSort(this.value)">
						<option value='earliest'>Earliest</option>
						<option value='latest'>Latest</option>
						<option value='least-expensive'>Least expensive</option>
						<option value='most-expensive'>Most expensive</option>
					</select>
				</div>
			</div>
			
			<div style="margin-top:32px" class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
				<div style="color:#188AB2" class="row gap small" id="all-result">
					<?php
						for($i = 0; $i < $length; $i++) {
							$price = $products[$i]->price;
							$name = $products[$i]->name;
							$src = $products[$i]->image;
							$id = (string)($products[$i]->id);
							
							echo "
								<div style='text-align:center; padding:16px 0 16px 0;' class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'>
									<a class='product-wrapper' href='product_item.php?id=$id'>
										<div style='text-align:left'><img src='$src' alt='' class='product-image'></div>

										<div class='product-description'>
											<div class='product-name'>$name</div>
											<div class='product-price'>$ $price</div>
										</div>
									</a>
								</div>
							";
						}
					?>
				</div>

				<div class="row gap small" id="search-result"></div>
			</div>
		</div>
	</div>

	<?php include "partials/footer.php" ?>

</body>
</html>

