<?php
    include "dbconfig.php";
    session_start();
    if(isset($_SESSION['username'])) {
        $user = $_SESSION['username'];
        
        if(isset($_POST['cartPay']) && isset($_FILES['image'])) {
            $img_name = $_FILES['image']['name'];
            $img_size = $_FILES['image']['size'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $error = $_FILES['image']['error'];
            
            $price = 0;
            $sql = mysqli_query($conn,"SELECT * FROM cart WHERE username = '$user' AND status = 'pending'");
            while($p = mysqli_fetch_array($sql)){
               $price = $price + $p['price'];
            }

            $district = $_POST['district'];
            $municipality = $_POST['municipality'];
            $tole = $_POST['tole'];
            $ward = $_POST['ward'];
            $ph = $_POST['ph'];
            $date = date("y-m-d");
            $time = date("H:i:s");

            $allowed_exs = array("jpg", "jpeg", "png");
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    
            if(!preg_match("/^[9]{1}[0-9]{9}$/", $ph)){
                echo 'Please enter a valid phone number';
            } else {
                if ($error === 0) {
                    if ($img_size > 1250000) {
                        echo '<script>alert("Sorry, your file is too large!"); 
                                window.history.back();</script>';
                    }
                    elseif(!in_array($img_ex, $allowed_exs)){
                        echo '<script> alert("Only PNG, JPEG and JPG are allowed extentions!"); 
                        window.history.back();</script>';
                    } else {
                        
                        $new_img_name = uniqid("PAY-", true) . '.' . $img_ex;
                        $img_upload_path = 'payments/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
    
                        // Insert into Database
                        $buy1 = mysqli_query($conn,"UPDATE cart SET status = 'payed', date = '$date', time = '$time' WHERE username = '$user' AND status = 'pending'");
                        $buy = "INSERT INTO c_order (username, date, time, price, district, municipality, tole, ward, ph, payment) 
                                VALUES ('$user', '$date', '$time', '$price', '$district', '$municipality', '$tole', '$ward', '$ph', '$new_img_name')";
                                 
                        if (mysqli_query($conn, $buy)) {
                            $sql = mysqli_query($conn,"SELECT * FROM c_order WHERE date = '$date' AND username = '$user' AND payment = '$new_img_name' AND status = 'pending'");
                            while($row = mysqli_fetch_assoc($sql)){
                                $cid = $row['id'];
                                $sql = mysqli_query($conn, "UPDATE cart SET id = $cid WHERE date = '$date' AND status = 'payed' AND time = '$time' AND username = '$user'");
                                if($sql){
                                    echo '<script> alert("Successfully inserted!"); 
                                location.assign("cart.php#orders");</script>';
                                }
                            }
                            echo '<script> alert("Successfully inserted!"); 
                                location.assign("cart.php#orders");</script>';
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
    
?>