<?php

require_once "../lib/php/helpers.php";

$output = [];

if (!isset($_GET['type'])) {
	$output = ["error"=>"No Type"];
} else {
	switch($_GET['type']) {
		case 'add':
			$conn = makeConn();

			$sql = "INSERT INTO `products` 
			(`id`,`brand`,`name`,`type`,`price`,`image`,`second_image`,`size`,`unit`, `description`,`skin_type`,`concern`,`formulation`,`scent_type`,`key_note`,`other_info`) 
			VALUES (NULL, '{$_POST['brand']}', '{$_POST['name']}', '{$_POST['type']}', '{$_POST['price']}', '{$_POST['image']}',
			'{$_POST['second_image']}','{$_POST['size']}','mL','{$_POST['description']}',
			'{$_POST['skin_type']}','{$_POST['concern']}','{$_POST['formulation']}','{$_POST['scent_type']}',
			'{$_POST['key_note']}','{$_POST['other_info']}');";

			if ($conn->query($sql) === TRUE) {
				$output['result'] = "New record created successfully";
			} else {
				$output['result'] = "Error: " . $conn->error;
			}
			
			$conn->close();
			break;
		
		case 'delete':
			$conn = makeConn();
			$sql = "DELETE FROM `products` WHERE `products`.`id` = {$_POST['id']}";

			if ($conn->query($sql) === TRUE) {
				$output['result'] = "Product successfully deleted";
			} else {
				$output['result'] = "Error: " . $conn->error;
			}

			$conn->close();
			break;
		
		case 'update':
			$conn = makeConn();
			
			#$sql = "UPDATE `products` SET `name` = '{$_POST['name']}', `price` = {$_POST['price']}, `images` = '{$_POST['images']}', `other_images` = '{$_POST['other_images']}', 
			#`best_date` = '{$_POST['best_date']}', `origin` = '{$_POST['origin']}', `weight` = {$_POST['weight']}, `ingredients` = '{$_POST['ingredients']}', `gender` = '{$_POST['gender']}' 
			#WHERE `products`.`id` = {$_POST['id']}";

			$sql = "UPDATE `products` SET `brand`='{$_POST['brand']}',`name`='{$_POST['name']}',`type`='{$_POST['type']}',
			`price`='{$_POST['price']}',`image`='{$_POST['image']}',`second_image`='{$_POST['second_image']}',
			`size`='{$_POST['size']}',`description`='{$_POST['description']}',`skin_type`='{$_POST['skin_type']}',
			`concern`='{$_POST['concern']}',`formulation`='{$_POST['formulation']}',`scent_type`='{$_POST['scent_type']}',
			`key_note`='{$_POST['key_note']}',`other_info`='{$_POST['other_info']}' 
			WHERE `products`.`id` = {$_POST['id']}";

			if ($conn->query($sql) === TRUE) {
				$output['result'] = "Product successfully updated";
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