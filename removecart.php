<?php
session_start();
include_once 'dbconfig.php';
    if(isset($_POST['rem'])){
        $id = $_GET['id'];
        $user = $_SESSION['username'];
        $sql = mysqli_query($conn,"DELETE from cart where pid = $id AND username = '$user'");
        if($sql){
            echo '<script> alert("Successfully Removed From Cart!"); window.history.back();</script>';
        }
        else{
            echo '<script> alert("Something went wrong!"); window.history.back();</script>';
        }
    }
?>