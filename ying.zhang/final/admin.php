<?php
    require_once "lib/php/helpers.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
    <?php include "partials/head.php" ?>
    <script src="js/admin.js"></script>
</head>

<body style="height:auto; font-family: 'Nunito', sans-serif">
    <?php include "partials/admin-header.php" ?>
    <?php include "partials/mobile-admin-header.php" ?>

	<div class="admin-container">
		<div class="card">
			<?php
			if(isset($_GET['type'])) {
                if($_GET['type'] == 'add') {
                    echo "
                        <div class='user'>
                            <form id='addProduct'>
                                <h2 style='text-align:center; font-size:24px'>New Product</h2>
                        
                                <div class='admin-product-row'>
                                    <strong>Brand<span style='color:red'>&nbsp;&nbsp;*</span></strong>
                                    <input class='admin-input' name='brand' type='text' value='CLARINS' required />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Name<span style='color:red'>&nbsp;&nbsp;*</span></strong>
                                    <input class='admin-input' name='name' type='text' value='CLARINS Extra-Firming Wrinkle Control Firming Day Cream SPF 15 ' required />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Type<span style='color:red'>&nbsp;&nbsp;*</span></strong>
                                    <input class='admin-input' name='type' type='text' value='3' required />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Price<span style='color:red'>&nbsp;&nbsp;*</span></strong>
                                    <input class='admin-input' name='price' type='number' step='1' value='87' required />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Image<span style='color:red'>&nbsp;&nbsp;*</span></strong>
                                    <input class='admin-input' name='image' type='text' value='img/015.jpg' required />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Second Image</strong>
                                    <input class='admin-input' name='second_image' type='text' value='img/015.jpg' />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Size (mL)<span style='color:red'>&nbsp;&nbsp;*</span></strong>
                                    <input class='admin-input' name='size' step='0.1' type='number' value='50' required />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Description<span style='color:red'>&nbsp;&nbsp;*</span></strong>
                                    <input class='admin-input' name='description' type='text'  value='A day cream that provides a complete firming action thanks to kangaroo flower extract—a new plant discovery known for its regenerating power to visibly lift and minimize wrinkles.' required />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Skin Type</strong>
                                    <input class='admin-input' name='skin_type' type='text'  value='Normal, Oily, Combination, Dry, and Sensitive' />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Skin Concern</strong>
                                    <input class='admin-input' name='concern' type='text'  value='' />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Formulation</strong>
                                    <input class='admin-input' name='formulation' type='text'  value='Cream' />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Scent Type</strong>
                                    <input class='admin-input' name='scent_type' type='text'  value='Loss of firmness and elasticity, Fine lines and wrinkles, and Uneven skin tone' />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Key Note</strong>
                                    <input class='admin-input' name='key_note' type='text'  value='' />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Comment</strong>
                                    <input class='admin-input' name='other_info' type='text'  value='' />
                                </div>

                                <button type='submit' class='admin-submit-button'>Add Product</button>
                            </form>
                        </div>
                    ";
                } else if($_GET['type'] == 'delete') {
                    $conn = makeConn();
                    $products = makeQuery($conn, "SELECT * FROM `products` WHERE id = ".$_GET['id']);
                    $product_info = $products[0];
                    $id = $product_info->id;
                    $conn->close();

                    echo "
                        <h2 style='font-size:24px; text-align:center'>Delete Product $product_info->name?</h2>
                        <div style='width:100%; display: flex; justify-content:flex-end;'>
                            <button onClick='deleteProduct($id)' class='admin-delete-button' style='margin-right:16px; background-color:#000; color:#fff'>Yes</button>
                            <button onClick='backToAll()' class='admin-delete-button' style='background-color:#f5e7df; color:#000;'>No</button>
                        </div>
                    ";
                } else if($_GET['type'] == 'edit') {
                    $conn = makeConn();
                    $products = makeQuery($conn, "SELECT * FROM `products` WHERE id = ".$_GET['id']);
                    if(count($products) > 0) {
                        $product_info = $products[0];
                        $id = $product_info->id;
                        $conn->close();

                        echo "
                            <h2 style='font-size:24px; text-align:center'>Edit $product_info->name</h2>

                            <form id='updateProduct'>
                                <div class='admin-product-row'>
                                    <strong>Brand<span style='color:red'>&nbsp;&nbsp;*</span></strong>
                                    <input class='admin-input' name='brand' type='text' value='$product_info->brand' required />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Name<span style='color:red'>&nbsp;&nbsp;*</span></strong>
                                    <input class='admin-input' name='name' type='text' value='$product_info->name' required />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Type<span style='color:red'>&nbsp;&nbsp;*</span></strong>
                                    <input class='admin-input' name='type' type='text' value='$product_info->type' required />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Price<span style='color:red'>&nbsp;&nbsp;*</span></strong>
                                    <input class='admin-input' name='price' type='number' step='1' value='$product_info->price' required />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Image<span style='color:red'>&nbsp;&nbsp;*</span></strong>
                                    <input class='admin-input' name='image' type='text' value='$product_info->image' required />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Second Image</strong>
                                    <input class='admin-input' name='second_image' type='text' value='$product_info->second_image' />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Size (mL)<span style='color:red'>&nbsp;&nbsp;*</span></strong>
                                    <input class='admin-input' name='size' type='number' step='0.1' value='$product_info->size' required />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Description<span style='color:red'>&nbsp;&nbsp;*</span></strong>
                                    <input class='admin-input' name='description' type='text'  value='$product_info->description' required />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Skin Type</strong>
                                    <input class='admin-input' name='skin_type' type='text'  value='$product_info->skin_type' />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Skin Concern</strong>
                                    <input class='admin-input' name='concern' type='text'  value='$product_info->concern' />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Formulation</strong>
                                    <input class='admin-input' name='formulation' type='text'  value='$product_info->formulation' />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Scent Type</strong>
                                    <input class='admin-input' name='scent_type' type='text' value='$product_info->scent_type' />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Key Note</strong>
                                    <input class='admin-input' name='key_note' type='text' value='$product_info->key_note' />
                                </div>

                                <div class='admin-product-row'>
                                    <strong>Comment</strong>
                                    <input class='admin-input' name='other_info' type='text' value='$product_info->other_info' />
                                </div>
                                
                                <div style='margin-top:32px; width:100%; display: flex; justify-content:flex-end;'>
                                    <button class='admin-delete-button' style='margin-right:16px; background-color:#000; color:#fff'>Update</button>
                                    <button type='button' onClick='backToAll()' class='admin-delete-button' style='background-color:#f5e7df; color:#000'>Back</button>
                                </div>
                            </div>
                            </form>
                        ";
                    }
                } 
            }  else {
                $conn = makeConn();
                $products = makeQuery($conn, "SELECT * FROM `products` ORDER BY `id`");
                $length = count($products);

                echo "
                    <h2 style='text-align:center;font-size:24px;color:#000'>Product List</h2>
                ";

                for($i = 0; $i < $length; $i++) {
                    $price = $products[$i]->price;
                    $name = $products[$i]->name;
                    $src = $products[$i]->image;
                    $id = (string)($products[$i]->id);

                    echo "
                        <div class='admin-product-column row gap'>
                            <div class='col-xs-6 col-ls-6 col-md-3 col-lg-3 col-xl-3'>$name</div>
                            <div class='col-xs-6 col-ls-6 col-md-3 col-lg-3 col-xl-3'>$ $price</div>
                            <div class='col-xs-6 col-ls-6 col-md-3 col-lg-3 col-xl-3'>
                                <a href='?type=edit&id=$id'>[ Edit ]</a>
                            </div>
                            <div class='col-xs-6 col-ls-6 col-md-3 col-lg-3 col-xl-3'>
                                <a href='?type=delete&id=$id'>[ Delete ]</a>
                            </div>
                        </div>
                        <hr />
                    ";
                }
            }
            ?>
		</div>
    </div>
    
    <?php include "partials/footer.php" ?>
</body>
</html>