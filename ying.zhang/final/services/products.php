<?php

require_once "../lib/php/helpers.php";

$output = [];

if (!isset($_GET['type'])) {
	$output = ["error"=>"No Type"];
} else {
	switch($_GET['type']) {
		case 'all':
			$conn = makeConn();
			
			$output['result'] = 
			makeQuery(
				$conn,
				"SELECT `products`.id, `products`.image, `products`.price, `products`.name FROM `products`"
			);

			$conn->close();
			break;
		
		case 'type1':
			$conn = makeConn();
			
			$output['result'] =
			makeQuery(
				$conn,
				"SELECT `products`.id, `products`.image, `products`.name, `products`.price FROM `products` WHERE type = 1"
			);

			$conn->close();
			break;

		case 'type2':
			$conn = makeConn();
			
			$output['result'] =
			makeQuery(
				$conn,
				"SELECT `products`.id, `products`.image, `products`.name, `products`.price FROM `products` WHERE type = 2"
			);

			$conn->close();
			break;
		
		case 'type3':
			$conn = makeConn();
			
			$output['result'] =
			makeQuery(
				$conn,
				"SELECT `products`.id, `products`.image, `products`.name, `products`.price FROM `products` WHERE type = 3"
			);

			$conn->close();
			break;
		
		case 'sort':
			$conn = makeConn();
			$field = $_GET['field'];
			$query = "";

			if($field == 'earliest') {
				$query = "SELECT `products`.id, `products`.image, `products`.price, `products`.name FROM `products` ORDER BY `products`.id ASC";
			} else if($field == 'latest') {
				$query = "SELECT `products`.id, `products`.image, `products`.price, `products`.name FROM `products` ORDER BY `products`.id DESC";
			} else if($field == 'least-expensive') {
				$query = "SELECT `products`.id, `products`.image, `products`.price, `products`.name FROM `products` ORDER BY `products`.price ASC";
			} else if($field == 'most-expensive') {
				$query = "SELECT `products`.id, `products`.image, `products`.price, `products`.name FROM `products` ORDER BY `products`.price DESC";
			} else {
				$conn->close();
				break;
			}

			$output['result'] =
			makeQuery(
				$conn, $query
			);

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