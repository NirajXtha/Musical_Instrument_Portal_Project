<?php
    session_start();
    include_once 'dbconfig.php';
    if(!empty($_SESSION['username']) && !empty($_SESSION['password'])){
        $user = $_SESSION['username'];
        $sql = mysqli_query($conn,"SELECT * FROM users WHERE username = '$user'");
            while($result = mysqli_fetch_array($sql)){
                if($result['user_type'] != 'user'){
                    session_destroy();
                    header('location: login/login.php');
                }
            }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muse</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">

    <!-- Link to css -->
    <link rel="stylesheet" href="index.css?v1">
</head>
<body>
 
 <!-- Top Navbar -->
 <header>
        <div class="navbar">
            <img src="images/logo.png" alt="">
            <a href="index.php">Home</a>
            <a href="all.php">Products</a>
            <a href="all.php?type=brands">Brands</a>
            <a href="rent.php">Rental</a>
            <a href="#contactus">Contact Us</a>
            <?php
                
                if(!empty($_SESSION['username'])){
                    
                    echo strtoupper($_SESSION['username']);
                    echo '<form action="logout.php" method="post">
                    <input type="submit" value="LogOut" name="logout" class="logout-btn">
             </form>';
                }
                
                else{
                    echo '<a href="login/login.php">LogIn/ Sign Up</a>';
                }
            ?>
            <a href="cart.php">🛒</a>
        </div>
</header>