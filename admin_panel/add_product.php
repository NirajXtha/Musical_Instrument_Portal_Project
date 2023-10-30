<?php 
include "dbconfig.php";
if (isset($_POST['submit']) && isset($_FILES['image'])) {
	
	
	echo "<pre>";
	print_r($_FILES['image']);
	echo "</pre>";


	$img_name = $_FILES['image']['name'];
	$img_size = $_FILES['image']['size'];
	$tmp_name = $_FILES['image']['tmp_name'];
	$error = $_FILES['image']['error'];

    $product = $_POST['product_name'];
    $type = $_POST['product_type'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
	$detail = $_POST['description'];

	if ($error === 0 && !empty($product) && !empty($type) && !empty($brand) && !empty($price)) {
		if ($img_size > 1250000) {
		    echo '<script> alert("Sorry, your file is too large!"); 
					window.history.back();</script>';
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

				$new_img_name = uniqid("IMG-",true).'.'.$img_ex;
				$img_upload_path = '../images/'.$new_img_name;
				

				// Insert into Database
				$sql = 'INSERT INTO product(img_url,product,p_type,brand,price,detail) VALUES ("'.$new_img_name.'","'.$product.'","'.$type.'","'.$brand.'","'.$price.'","'.$detail.'")';
				$result = mysqli_query($conn,$sql);

                if(!$result){
                    echo '<script> alert("Something went wrong!"); window.history.back();</script>';
					// echo $product . $price . $new_img_name . $type . $brand . $detail;
                }else{
					move_uploaded_file($tmp_name, $img_upload_path);
					echo '<script> alert("Successfully inserted!"); window.history.back();</script>';
                }

		}
	}else {
		
		echo '<script> alert("Unknown error occurred!"); window.history.back();</script>';
	}

}else {
	header("Location: product.php");
}