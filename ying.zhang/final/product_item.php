<?php
require_once "lib/php/helpers.php";
?>

<?php
    $conn = makeConn();

    $products = makeQuery($conn, "SELECT * FROM `products` WHERE id = ".$_GET['id']);
    $product = $products[0];

    $other_products = makeQuery($conn, "SELECT * FROM `products` WHERE id != ".$_GET['id']);

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <?php
        echo "
            <title>$product->name</title>
        ";
    ?>

	<!-- meta:vp -->
	<?php include "partials/head.php" ?>

</head>

<body style="font-family: 'Nunito', sans-serif">
    <?php include "partials/header.php" ?>
    <?php include "partials/mobile-header.php" ?>

	<div style="width:100%;" class='row gap single-product-container'>
        <div class='row gap col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6' style="margin-top:16px;">
            <div style='width:100%'>
                <?php
                    $src1 = $product->image;
                    # $src2 = $product->image;
                    echo "
                        <img id='image-1' src='$src1' class='product-item-image' width='100%' alt=''>
                    ";
                ?>
            </div>

            <!--
            <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                <?php
                    /*
                    $src1 = $product->image;
                    $src2 = $product->image;
                    $id1 = '1';
                    $id2 = '2';

                    echo "
                        <div style='display:flex; justify-content:flex-start'>
                            <div>
                                <img onClick='switchImage($id1)' src='$src1' class='small-product-image' alt=''>
                            </div>
                            <div style='margin-left:16px'>
                                <img onClick='switchImage($id2)' src='$src2' class='small-product-image' alt=''>
                            </div>
                        </div>
                    ";
                    */
                ?>
            </div>
            -->
        </div>
        
        <div class='row gap col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6' style='margin-top:16px'>
            <?php
                // #B4CED9 light blue
                // #188AB2 deep blue
                // #BF8969 yellow

                echo "
                    <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12' style='padding:0;font-size:20px; font-weight:600;'>
                        $product->name
                    </div>
                    <div>
                        <div style='line-height:2;'>$product->size$product->unit</div>
                        <div style='line-height:2;'>$$product->price</div>
                    </div>
                    <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                        <button onClick='addCart()' class='cart-button'>Add to Cart</button>
                    </div>
                    <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12' style=''>
                        <h3 style=''>Description</h3>
                        <div style='color:#000'>$product->description</div>
                    </div>
                ";
                
                if($product->skin_type) {
                    echo "
                        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                            <h3 style=''>Skin Type</h3>
                            <div style='color:#000'>$product->skin_type</div>
                        </div>
                    ";
                }

                if($product->concern) {
                    echo "
                        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                            <h3 style=''>Skin Concern</h3>
                            <div style='color:#000'>$product->concern</div>
                        </div>
                    ";
                }

                if($product->formulation) {
                    echo "
                        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                            <h3 style=''>Skin Concern</h3>
                            <div style='color:#000'>$product->formulation</div>
                        </div>
                    ";
                }

                if($product->scent_type) {
                    echo "
                        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                            <h3 style=''>Scent Type</h3>
                            <div style='color:#000'>$product->scent_type</div>
                        </div>
                    ";
                }

                if($product->key_note) {
                    echo "
                        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                            <h3 style=''>Key Note</h3>
                            <div style='color:#000'>$product->key_note</div>
                        </div>
                    ";
                } 
            ?>
        </div>
    </div>
    
    <div style='text-align:center; font-size:20px; font-weight:600'>You may be also interested in</div>

    <div class='row gap single-product-container' style='margin-top:0px'>
        <?php
            $length = min(count($other_products), 3);
            for($i = 0; $i < $length; $i++) {
                $price = $other_products[$i]->price;
                $name = $other_products[$i]->name;
                $src = $other_products[$i]->image;
                $id = (string)($other_products[$i]->id);
                
                echo "
                    <div style='text-align:center' class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'>
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

    <?php include "partials/footer.php" ?>
</body>
</html>