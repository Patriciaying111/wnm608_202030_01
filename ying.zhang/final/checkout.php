<?php
require_once "lib/php/helpers.php";
?>

<?php
    $conn = makeConn();

    $cartId = $_GET['cartid'];
    $products = [];
    if($cartId == 'all') {
        $products = makeQuery(
            $conn, 
            "SELECT `products`.id, `products`.image, `products`.name, `products`.price, `cart`.count, `cart`.id AS cartId 
            FROM `cart` INNER JOIN `products` ON `cart`.productId = `products`.id"
        );
    } else {
        $products = makeQuery(
            $conn, 
            "SELECT `products`.id, `products`.image, `products`.name, `products`.price, `cart`.count, `cart`.id AS cartId 
            FROM `cart` INNER JOIN `products` ON `cart`.productId = `products`.id WHERE `cart`.id = ".$cartId
        );
    }

    $length = count($products);
    $total_amount = 0;

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Make Payment</title>

	<!-- meta:vp -->
	<?php include "partials/head.php" ?>
</head>

<body style="font-family: 'Nunito', sans-serif">
    <?php include "partials/header.php" ?>
    <?php include "partials/mobile-header.php" ?>
    
    <div style="width:100%;" class='single-product-container'>
        <div class='row gap'>
            <?php
                for($i = 0; $i < $length; $i++) {
                    $src = $products[$i]->image;
                    $name = $products[$i]->name;
                    $price = $products[$i]->price;
                    $count = $products[$i]->count;
                    $sub_total = $price * $count;
                    $total_amount += $sub_total;
                    # #BF8969

                    echo "
                        <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>
                            <img src='$src' class='product-item-image' width='100%' alt=''>
                        </div>

                        <div class='col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6'>
                            <div style='width:100%>
                                <h3 style=''>$name</h3>
                            </div>

                            <div style='margin-top:32px; width:100%; display:flex; justify-content:space-between;'>
                                <span>Price</span>
                                <strong>$ $price</strong>
                            </div>

                            <div style='width:100%; display:flex; justify-content:space-between;'>
                                <span>Quantity</span>
                                <strong>X $count</strong>
                            </div>

                            <div style='width:100%; display:flex; justify-content:space-between;'>
                                <span>Amount</span>
                                <strong>$ $sub_total</strong>
                            </div>
                        </div>

                        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'
                        style='border:1px solid #ddd; height:1px; margin-top:8px'></div>
                    ";
                }

                echo "
                    <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12' 
                        style='font-size:28px; width:100%; display:flex; justify-content:space-between;'>
                        <span>Total Amount</span>
                        <strong>$ $total_amount</strong>
                    </div>
                ";
            ?>
        </div>

        <div style='width:100%; margin-top:32px;'>
            <form id='makePayment' style='width:100%;'>
                <h2 style=''>
                    SHIPPING DETAILS
                </h2>

                <div class='checkout-item' style='margin-top:32px;'>
                    <strong>Name</strong>
                    <input class='checkout-input' name='name' type='text' required />
                </div>

                <div class='checkout-item' style='margin-top:16px;'>
                    <strong>Email</strong>
                    <input class='checkout-input' name='introduction' type='email' required />
                </div>

                <div class='checkout-item' style=>
                    <strong>Address</strong>
                    <input class='checkout-input' name='address' type='text' required />
                </div>

                <div class='checkout-item'>
                    <strong>City</strong>
                    <input class='checkout-input' name='city' type='text' required />
                </div>

                <div class='checkout-item'>
                    <strong>State</strong>
                    <input class='checkout-input' name='state' type='text' required />
                </div>

                <div class='checkout-item'>
                    <strong>Zip</strong>
                    <input class='checkout-input' name='zip' type='text' required />
                </div>

                <h2 style='margin-top:32px;'>
                    PAYMENT INFORMATION
                </h2>

                <div class='checkout-item'>
                    <strong>CREDIT CARD NUMBER</strong>
                    <input class='checkout-input' name='credit-card-number' type='text' required />
                </div>

                <div class='checkout-item'>
                    <strong>EXPIRATION DATE</strong>
                    <input class='checkout-input' name='exp' type='text' required />
                </div>

                <div class='checkout-item'>
                    <strong>CVV</strong>
                    <input class='checkout-input' name='cvv' type='text' required />
                </div>

                <div style='text-align:right'>
                    <button class='checkout-button' type='submit'>Check Out</button>
                </div>
            </form>
        </div>
    </div>

	<?php include "partials/footer.php" ?>
</body>
</html>