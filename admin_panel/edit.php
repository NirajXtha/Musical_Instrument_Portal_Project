<?php
session_start();
    include 'dbconfig.php';
    include_once 'check_session.php';
    if(empty($_GET)){
        echo '<script>alert("No entry!"); window.history.back();</script>';
    }
    
    $id = $_GET['pid'];
    if($_GET['action'] == "Delete"){
        $sql = mysqli_query($conn,"DELETE FROM product WHERE pid = $id");
        if($sql){
            echo '<script>alert("Deleted Successfully!"); window.history.back();</script>';
        }
        else{
            echo '<script>alert("Something Went Wrong!"); window.history.back();</script>';
        }
    }
    else{
    $sql = mysqli_query($conn, "Select * FROM product WHERE pid = '$id'");
    $row = mysqli_fetch_assoc($sql);
    $pid = $row['pid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale</title>
    <style>
        *{
            font-size: 17px;
        }
        body{
            display: flex;
            /* flex-direction: column; */
            justify-content: center;
            margin-top: 25px;
            background-image: url(../images/g3.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }
        a{
            color: white;
            font-weight: 600;
            font-size: 18px;
            
        }
        .container{
            /* border: 1px solid; */
            width: 60%;
            background: transparent;
            backdrop-filter: blur(20px);
            padding: 25px;
            border-radius: 40px;
            color: white;
        }
        .sub{
            /* border: 1px solid; */
            padding: 10px;
            display: grid;
            grid-template-columns: 55% 45%;
        }
        .sub img{
            border-radius: 25px;
            width: 100%;
        }
        .sub-cat{
            /* border: 1px solid; */
            padding: 20px 25px 10px;
        }
        input{
            width: 100%;
            height: 25px;
            padding: 0 5px;
            border-radius: 5px;
        }
        .btn{
            /* margin-left: 30px; */
            width: 80px;
            height: 2.2em;
            cursor: pointer;
            border: 1px solid;
            border-radius: 8px;
        }
        .btn:hover{
            background-color: #CC313D;
            color: antiquewhite;
            border: 1px solid red;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="product.php">&#8592; Back</a>
        <div class="sub">
            <img src="../images/<?=$row['img_url']?>" alt="Picture">
            <div class="sub-cat">
            <form action="edit.php?pid=<?=$pid?>&action=edit" method="post">
                <h2>Product: <input type="text" name="product" value="<?=$row['product']?>"></h2>
                <h3>Type: <input type="text" name="type" value="<?php echo $row['p_type'];?>"></h3>
                <h3>Brand: <input type="text" name="brand" value="<?php echo $row['brand'];?>"></h3>
                <h3>Price: <input type="number" name="amt" value="<?php echo $row['price'];?>"></h3>
                <h3>Change Image: <input type="file" name="img"></h3>
                <input type="submit" name="edit" value="Edit" class="btn">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
    if(isset($_POST['edit'])){
        if(empty($_POST['product']) && empty($_POST['brand']) && empty($_POST['type']) && empty($_POST['amt'])){
            echo '<script>alert("Cannot be left empty")</script>';
        }
        else{
            $p = $_POST['product'];
            $t = $_POST['type'];
            $b = $_POST['brand'];
            $a = $_POST['amt'];
            $id = $_GET['pid'];
            if(empty($_FILES['img'])){
                $q = mysqli_query($conn,'Update product set product = "'.$p.'", p_type = "'.$t.'", brand = "'.$b.'", price = '.$a.' WHERE pid = '.$id);
                if($q){
                    echo '<script>alert("Successfully Updated!"); window.history.back();</script>';
                }
                else{
                    echo '<script>alert("Something Went Wrong!"); window.history.back();</script>';
                }
            }else{
                $img_name = $_FILES['my_image']['name'];
	            $img_size = $_FILES['my_image']['size'];
                $tmp_name = $_FILES['my_image']['tmp_name'];
                $error = $_FILES['my_image']['error'];

                if ($error === 0) {
                    if ($img_size > 1250000) {
                        echo '<script> alert("Sorry, your file is too large!"); 
                                window.history.back();</script>';
                    }else {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            
                            $new_img_name = uniqid("IMG-",true).'.'.$img_ex;
                            $img_upload_path = '../images/'.$new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
            
                            $q = mysqli_query($conn,"Update product set img_url = $new_img_name, product = $p, p_type = $t, brand = $b, price = $a WHERE pid = $id");           
                            if(!$q){
                                echo '<script> alert("Something went wrong!"); window.history.back();</script>';
                            }
                            echo '<script> alert("Successfully updated!"); window.history.back();</script>';
                            
            
                    }
                }else {
                    
                    echo '<script> alert("Unknown error occurred!"); window.history.back();</script>';
                }
                
            }
        }
        
    }
    }
?>