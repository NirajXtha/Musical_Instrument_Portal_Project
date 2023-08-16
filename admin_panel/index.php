<?php

    session_start();
    include 'dbconfig.php';
    if(!empty($_SESSION['username']) && !empty($_SESSION['password'])){
        $sql = mysqli_query($conn,"SELECT * FROM users WHERE user_type = 'admin'");
            while($result = mysqli_fetch_array($sql)){
                if($_SESSION['password'] == $result['password'] && $_SESSION['username'] == $result['username']){
                    header("location: admin.php");
                    exit();
                }
            }
    }
    ?>

    



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        <?php include "../login/style.css"; ?>
    </style>
</head>
<body>
    <div class="form">
    <h1>Admin Login</h1>
    <form method="POST" action="index.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <?php

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $username = $_POST['username'];
                $password = md5($_POST['password']);

                $sql = "SELECT username, password, user_type FROM users WHERE username = '$username' AND password = '$password' AND user_type = 'admin'";
        
                $result = mysqli_query($conn, $sql);
        
                if(mysqli_num_rows($result) === 0){
                    echo "Incorrect username or password. Please try again later!";
                }
                else{
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    setcookie($username, $password, time() + (86400 * 30)); // Cookie valid for 30 days
                    header('location: admin.php');
                    exit();
                }
            }
        
        ?>
        <br>
        
            <br>
        <center><button type="submit">Log In</button></center>
    </form>
    </div>
</body>
</html>
