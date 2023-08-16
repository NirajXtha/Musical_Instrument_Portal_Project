<?php
    include_once 'nav.php';
    include 'dbconfig.php';
    if(empty($_GET)){
        echo '<script>window.history.back()</script>';
    }
    if(empty($_SESSION)){
        echo '<script>
            var login = confirm("To purchase this item you must login first. Login?");
            if(login == true){
                location.assign("login/login.php");
            }
            else{
                location.assign("index.php");
            }
        </script>';
    }
    $user = $_SESSION['username'];
    $id = $_GET['id'];
    $type = $_GET['type'];
    if(isset($_POST['cart'])){
        header('location:view_product.php?id='.$id);
    }
    if($type == 'product'){
        //To purchase
        include 'payForm.php';

        
    }
    if($type == 'cart'){
        include 'cartForm.php';
    }
    if($type == 'rent'){
        $sql = mysqli_query($conn,"SELECT * FROM rent WHERE rid = '$id'");
        $row = mysqli_fetch_array($sql);
        if($row['username'] == ''){
            include 'rentForm.php';
        }else{?>
            <script>
                alert("This set of instruments are not available right now! Try other sets of instrument instead.");
                    location.assign('rent.php');
                
            </script>
       <?php }
    }
    
    
    include_once 'footer.php';
?>