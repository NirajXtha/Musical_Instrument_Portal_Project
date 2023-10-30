<?php
    session_start();
    include 'dbconfig.php';
    $id = $_GET['id'];
    if(empty($_SESSION['username']) && empty($_SESSION['password'])){
        // header("location: login/login.php");
        echo '<script>
                var login = confirm("Login Frist to continue!");
                if(login == true){
                    location.assign("login/login.php");}
                    else{
                        window.history.back();}
            </script>';
    }
    else{
    
    if(isset($_POST['cart'])){
        $qty = $_POST['quantity'];
        $user = $_SESSION['username'];
        $p = mysqli_query($conn, "SELECT * FROM sale WHERE pid = " . $id);
        if(mysqli_num_rows($p) === 0){
            $q = mysqli_query($conn, "SELECT * from product WHERE pid = " . $id);
            if($q){
                $qq = mysqli_fetch_assoc($q);
                $price = $qq['price'] * $qty;
                
            }
        }
        else{
            $pp = mysqli_fetch_assoc($p);
            $price = $pp['sale_amt'] * $qty;
            
        }
        
        $check = mysqli_query($conn,"SELECT * FROM cart WHERE username = '$user' AND status = 'pending' AND pid = $id");
        if(mysqli_num_rows($check) > 0){
            echo '<script> alert("Already added to cart!"); window.history.back();</script>';
        }else{
            $query = mysqli_query($conn,"INSERT INTO cart(username,pid,qty,price) VALUES('$user','$id',$qty,'$price')");
            if($query){
                echo '<script> alert("Successfully added to cart!"); window.history.back();</script>';
            }
            else{
                echo '<script> alert("Something went wrong!"); window.history.back();</script>';
            }
        }
    }
    }//session else end
?>