<?php

require_once "../lib/php/helpers.php";

$output = [];

if (!isset($_GET['type'])) {
	$output = ["error"=>"No valid method"];
} else {
	switch($_GET['type']) {
		case 'search':
			$productId = (int)$_POST['id'];
			$conn = makeConn();
			$output['result'] = makeQuery(
				$conn,
				"SELECT * FROM `cart` WHERE productId = ".$productId
			);
			$conn->close();
			break;
			
		case 'add':
			$conn = makeConn();

			$sql = "INSERT INTO `cart` (`id`, `productId`, `count`, `status`) VALUES (NULL, '{$_POST['id']}', '{$_POST['count']}', 'unpaid')";

			if ($conn->query($sql) === TRUE) {
				$output['result'] = "Successfully added to cart";
			} else {
				$output['result'] = "Error: " . $conn->error;
			}

			$conn->close();
			break;
		
		case 'update':
			$conn = makeConn();

			$sql = "UPDATE `cart` SET `count` = ".$_POST['count']." WHERE productId = ".$_POST['id'];
			
			if ($conn->query($sql) === TRUE) {
				$output['result'] = "Successfully added to cart";
			} else {
				$output['result'] = "Error: " . $conn->error;
			}

			$conn->close();
			break;
		
		case 'delete':
			$conn = makeConn();
			$sql = "DELETE FROM `cart` WHERE `cart`.`id` = {$_POST['cartId']}";

			if ($conn->query($sql) === TRUE) {
				$output['result'] = "Successfully deleted cart";
			} else {
				$output['result'] = "Error: " . $conn->error;
			}

			$conn->close();
			break;
		
		case 'make-payment':
			// currently equal to delete cart item
			$conn = makeConn();
			$sql = "";

			if($_POST['cartid'] === 'all') {
				$sql = "DELETE FROM `cart`";
			} else {
				$sql = "DELETE FROM `cart` WHERE `cart`.`id` = {$_POST['cartid']}";
			}

			if ($conn->query($sql) === TRUE) {
				$output['result'] = "Successfully make payment";
			} else {
				$output['result'] = "Error: " . $conn->error;
			}

			$conn->close();
			break;

		default: break;
	}
}

echo json_encode(
	$output,
	JSON_UNESCAPED_UNICODE |
	JSON_NUMERIC_CHECK
);