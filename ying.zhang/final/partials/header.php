<?php
    require_once(__DIR__.'/../lib/php/helpers.php');
?>

<?php
	// TODO: 
	$conn = makeConn();
    $cart_infos = makeQuery(
        $conn, 
        "SELECT * FROM `cart` INNER JOIN `products` ON `cart`.productId = `products`.id WHERE `status`='unpaid'"
    );

    $total = 0;
    for($i = 0; $i < count($cart_infos); $i++) {
        $total += $cart_infos[$i]->count;
    }

	$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/gridsystem.css">
    <link rel="stylesheet" type="text/css" href="css/storetheme.css">
</head>
<body style='height:120px;'>
    <div style="width:100vw;">
        <header class="navbar">
            <div class="row" style="height:100%; align-items:center;">
                <div class='col-xs-12 col-sm-12 col-md-6 col-lg-8 col-xl-8' style="display:flex; align-items:center">
                    <a href="home.php" style="display:flex; align-items:center">
                        <img src="img/logo.png" width='80px' height='100px' />
                    </a>
                </div>

                <div class='col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4' style="display:flex; justify-content:flex-end;">
                    <h3><a href="products.php">Products</a></h3>
                    <h3><a href="about.php">About</a></h3>
                    <?php
                        if($total > 0) {
                            echo "
                                <h3 style='display:flex;align-items:center'>
                                    <a href='cart.php'>Cart</a>
                                    <button class='cart-number' style='padding:0px;'>$total</button>
                                </h3>
                            ";
                        } else {
                            echo "
                                <h3><a href='cart.php'>Cart</a></h3>
                            ";
                        }
                    ?>
                    <h3><a href="admin.php">Admin</a></h3>
                </div>
            </div>
        </header>
    </div>
</body>
</html>