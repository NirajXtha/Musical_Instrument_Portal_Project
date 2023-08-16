<?php
    session_start();
    include 'dbconfig.php';
    include_once 'check_session.php';

    if(empty($_GET)){
        header('location: admin.php');
        exit();
    }
    $type = $_GET['type'];
    $id = $_GET['id'];
    if($type == 'rent'){
        $sql = mysqli_query($conn,"UPDATE r_order SET status = 'approved' WHERE id = $id");
        if($sql){
            echo '<script>alert("Successfully Approved"); location.assign("rental.php")</script>';
        }
        else{
            echo '<script>alert("Something Went Wrong!"); location.assign("rental.php")</script>';
        }
    }
    if($type == 'order'){
        $sql = mysqli_query($conn,"UPDATE orders SET status = 'approved' WHERE order_id = $id");
        if($sql){
            echo '<script>alert("Successfully Approved"); location.assign("orders.php")</script>';
        }
        else{
            echo '<script>alert("Something Went Wrong!"); location.assign("orders.php")</script>';
        }
    }
    if($type == 'cart'){
        $sql = mysqli_query($conn,"UPDATE c_order SET status = 'approved' WHERE id = $id");
        if($sql){
            echo '<script>alert("Successfully Approved"); location.assign("orders.php")</script>';
        }
        else{
            echo '<script>alert("Something Went Wrong!"); location.assign("orders.php")</script>';
        }
    }
?>