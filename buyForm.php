<?php
session_start();
include "dbconfig.php";

if(isset($_SESSION['username']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $_SESSION['username'];
    
    // Get product price
    $sql = mysqli_query($conn, "SELECT * FROM product WHERE pid = '$id'");
    $price = 0;
    
    while($row = mysqli_fetch_assoc($sql)) {
        $check = mysqli_query($conn, "SELECT * FROM sale WHERE pid = $id");
        $price = mysqli_num_rows($check) == 0 ? $row['price'] : mysqli_fetch_assoc($check)['sale_amt'];
    }
    
    if(isset($_POST['pay']) && isset($_FILES['image'])) {
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        // Get form data
        $district = $_POST['district'];
        $municipality = $_POST['municipality'];
        $tole = $_POST['tole'];
        $ward = $_POST['ward'];
        $ph = $_POST['ph'];
        $date = date('y-m-d');

        $allowed_exs = array("jpg", "jpeg", "png");
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

        // Validate phone number
        if(!preg_match("/^[9]{1}[0-9]{9}$/", $ph)) {
            echo '<script> 
                alert("Please enter a valid phone number!"); 
                window.history.back();
            </script>';
        } else {
            if ($error === 0) {
                if ($img_size > 1250000) {
                    echo '<script> 
                        alert("Sorry, your file is too large!"); 
                        window.history.back();
                    </script>';
                } 
                elseif(!in_array($img_ex, $allowed_exs)) {
                    echo '<script> 
                        alert("Only PNG, JPEG and JPG are allowed extensions!"); 
                        window.history.back();
                    </script>';
                } else {
                    // Process image upload
                    $new_img_name = uniqid("PAY-", true) . '.' . $img_ex;
                    $img_upload_path = 'payments/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    // Insert into Database
                    $buy = "INSERT INTO orders (username, pid, date, price, district, municipality, tole, ward, ph, payment) 
                            VALUES ('$user', '$id', '$date', '$price', '$district', '$municipality', '$tole', '$ward', '$ph', '$new_img_name')";
                            
                    if (mysqli_query($conn, $buy)) {
                        echo '<script> 
                            alert("Successfully inserted!"); 
                            location.assign("cart.php#orders");
                        </script>';
                    } else {
                        echo '<script> 
                            alert("Something went wrong!"); 
                            window.history.back();
                        </script>';
                    }
                }
            } else {
                echo '<script> 
                    alert("Unknown error occurred!"); 
                    window.history.back();
                </script>';
            }
        }
    } else {
        echo '<div class="error-message">Form submission error.</div>';
    }
} else {
    echo '<div class="error-message">Invalid or missing session data or parameters.</div>';
}
?>
