<?php
       include_once 'dbconfig.php';
       if(empty($_SESSION['username']) && empty($_SESSION['password'])){
              header("location: index.php");
              exit();
       }else{
              $sql = mysqli_query($conn,"SELECT * FROM users WHERE user_type = 'admin'");
              while($result = mysqli_fetch_array($sql)){
                     if($_SESSION['password'] != $result['password'] && $_SESSION['username'] != $result['username']){
                            header("location: index.php");
                            exit();
                            
                     }
              }
       }
?>