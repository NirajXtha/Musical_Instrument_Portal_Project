<?php
session_start();
    include 'dbconfig.php';
    include_once 'check_session.php';
    $id = $_GET['pid'];
    
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
            
            padding: 35px;
        }
        input[type="number"]{
            width: auto;
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
        <a href="sale.php">&#8592; Back</a>
        <div class="sub">
            <img src="../images/<?=$row['img_url']?>" alt="Picture">
            <div class="sub-cat">
                <h2><?=$row['product']?></h2>
                <h3>Type: <?=$row['p_type']?></h3>
                <h3>Brand: <?=$row['brand']?></h3>
                <h3>Rs. <?=$row['price']?></h3>
                <form action="addsale.php?pid=<?=$pid?>" method="post">
                    <?php
                    $q = mysqli_query($conn,"SELECT * FROM sale WHERE pid = '$id'");
                    $res = mysqli_fetch_assoc($q);
                        if(mysqli_num_rows($q) > 0){
                            echo '<h3>Sale amount: Rs. ' . $res['sale_amt'] . '</h3>';
                            echo '<input type="submit" value="Remove" name="delete" class="btn">';
                        }
                        else{
                            echo '<input type="number" name="amt" id=""><br><br>
                                <input type="submit" value="ADD" name="add" class="btn">';
                        }
                    ?>
                    
                </form>
                <?php
                    if(isset($_POST['add'])){
                        if(empty($_POST['amt'])){
                            echo "Insert Amount!";
                           
                            
                        }else{
                            $amt = $_POST['amt'];
                            $query = mysqli_query($conn,"INSERT INTO sale (pid,sale_amt) VALUES('$pid','$amt')");
                            if($query){
                                echo '<script>alert("Inserted Successfully")</script>';
                                
                            }
                            else{
                                echo '<script>alert("Something Went Wrong")</script>';
                            }
                        }
                    }
                    if(isset($_POST['delete'])){
                        $del = mysqli_query($conn, "DELETE FROM sale WHERE pid = '$id'");
                        if($del){
                            echo '<script>alert("Deleted Successfully");location.assign("sale.php")</script>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>