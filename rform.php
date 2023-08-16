<?php
session_start();
include "dbconfig.php";

if(isset($_SESSION['username']) && isset($_GET['id']) && isset($_GET['price'])) {
    $id = $_GET['id'];
    $price = $_GET['price'];
    $user = $_SESSION['username'];
    
    if(isset($_POST['pay']) && isset($_FILES['image'])) {
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        $hours = $_POST['hour'];
        $total_price = $price * $hours;
        $date = $_POST['date'];
        $time = $_POST['time'];
        $district = $_POST['district'];
        $municipality = $_POST['municipality'];
        $tole = $_POST['tole'];
        $ward = $_POST['ward'];
        $ph = $_POST['ph'];

        if(!preg_match("/^[9]{1}[0-9]{9}$/", $ph)){
            echo 'Please enter a valid phone number';
        } else {
            if ($error === 0) {
                if ($img_size > 1250000) {
                    echo '<script> alert("Sorry, your file is too large!"); 
                            window.history.back();</script>';
                } else {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $new_img_name = uniqid("PAY-", true) . '.' . $img_ex;
                    $img_upload_path = 'payments/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    // Insert into Database
                    $rent = "INSERT INTO r_order (username, rid, date, time, hrs, r_price, district, municipality, tole, ward, ph, payment) 
                                VALUES ('$user', '$id', '$date', '$time', '$hours', '$total_price', '$district', '$municipality', '$tole', '$ward', '$ph', '$new_img_name')";
                    $rent = "UPDATE rent SET username = '$user' WHERE rid = '$id'";
                    
                    if (mysqli_multi_query($conn, $rent)) {
                        echo '<script> alert("Successfully inserted!"); 
                            location.assign("cart.php#rent");</script>';
                    } else {
                        echo '<script> alert("Something went wrong!"); 
                            window.history.back();</script>';
                    }
                }
            } else {
                echo '<script> alert("Unknown error occurred!"); 
                    window.history.back();</script>';
            }
        }
    } else {
        echo 'Form submission error.';
    }
} else {
    echo 'Invalid or missing session data or parameters.';
}
?>
