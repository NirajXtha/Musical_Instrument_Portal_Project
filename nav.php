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
            <button id="theme-toggle" class="theme-toggle">
                <svg class="sun-icon" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.65 0-3 1.35-3 3s1.35 3 3 3 3-1.35 3-3-1.35-3-3-3zm0-2V4c0-.55-.45-1-1-1s-1 .45-1 1v3c0 .55.45 1 1 1s1-.45 1-1zm0 14v-3c0-.55-.45-1-1-1s-1 .45-1 1v3c0 .55.45 1 1 1s1-.45 1-1zm6.36-12.64l-2.12 2.12c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0l2.12-2.12c.39-.39.39-1.02 0-1.41-.39-.39-1.02-.39-1.41 0zM4.93 19.07l2.12-2.12c.39-.39.39-1.02 0-1.41-.39-.39-1.02-.39-1.41 0l-2.12 2.12c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0zM20 12h-3c-.55 0-1 .45-1 1s.45 1 1 1h3c.55 0 1-.45 1-1s-.45-1-1-1zM7 12H4c-.55 0-1 .45-1 1s.45 1 1 1h3c.55 0 1-.45 1-1s-.45-1-1-1z"/>
                </svg>
                <svg class="moon-icon" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M12 3c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9c0-.46-.04-.92-.1-1.36-.98 1.37-2.58 2.26-4.4 2.26-3.03 0-5.5-2.47-5.5-5.5 0-1.82.89-3.42 2.26-4.4-.44-.06-.9-.1-1.36-.1z"/>
                </svg>
            </button>
        </div>
</header>