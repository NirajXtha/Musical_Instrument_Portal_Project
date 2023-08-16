<?php

    // Start the session
    session_start();

    include 'dbconfig.php';

    if (!empty($_SESSION)){
        $sql = mysqli_query($conn,"SELECT * FROM users WHERE user_type = 'user'");
            while($result = mysqli_fetch_array($sql)){
                    if($_SESSION['password'] != $result['password'] && $_SESSION['username'] != $result['username']){
                        header("location: ../index.php");
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form">
    <h1>Login</h1>
    <form method="POST" action="login.php" enctype="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <?php

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $username = $_POST['username'];
                $password = md5($_POST['password']);
                
                    $sql = "SELECT username, password FROM users WHERE username = '$username' AND password = '$password'";
        
                    $result = mysqli_query($conn, $sql);
        
                    if(mysqli_num_rows($result) === 0){
                        echo "Incorrect username or password. Please try again later!";
                    }
                    else{
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;
                        $_SESSION['user_type'] = "user";
                        setcookie('username', 'password', time() + (86400 * 30), '/'); // Cookie valid for 30 days
                        header("location: ../index.php");
                        exit();
                    }
                }
        
            
        
        ?>
        <br>
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
            <br>
        <center><button type="submit">Log In</button></center>
    </form>
    </div>
</body>
</html>
