<?php
session_start();
    include 'dbconfig.php';
    include 'check_session.php';

    $sql = mysqli_query($conn, "Select * FROM product");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale</title>
    <style>
        *{
            color: antiquewhite;
            font-weight: 600;
            font: serif;
        }
        body{
            background-image: url(../images/g3.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }
        .container{
            backdrop-filter: blur(30px);
            padding: 25px;
            border-radius: 15px;
            margin-left: 250px;
            width: fit-content;
        }
        button{
            border: none;
            background: transparent;
        }
        a{
            padding: 0 8px;
            color: antiquewhite;
            text-decoration: none;
            /* font-weight: 600; */
        }
        a:hover{
            color: antiquewhite;
            border-bottom: 1px solid;
        }
        button a{
            color: coral;
            
        }
        button a:hover{
            border: none;
        }
        table tr td,th{
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
<a href="admin.php" style="font-weight: bolder; font-size: 18px">&#8592; Back</a><center>
    <div class="sales">
        <h2>Add For Sale</h2>
        <table border="1px solid">
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Sale amount</th>
            <th>Action</th></tr>
            <?php
                $i = 1;
                while($row = mysqli_fetch_assoc($sql)){
                    
                    $id=$row['pid'];
                    $q = mysqli_query($conn,"SELECT * FROM sale WHERE pid = $id");
                    $sale = mysqli_fetch_assoc($q);
                    echo "<tr>
                        <td>" . $i . "</td>
                        <td>" . $row['product'] . "</td>
                        <td>" . $row['p_type'] . "</td>
                        <td>" . $row['brand'] . "</td> 
                        <td>" . $row['price'] . "</td>
                        <td>";
                        if($sale == 0){
                            echo "<center>Not For Sale</center>";}
                            else{echo $sale['sale_amt'];}?>
                            
                        <td><button><a href="addsale.php?pid=<?=$id?>">EDIT</a></button></td>
                        </tr>
                        <?php
                        
    
                        $i++;
                }
            ?>
        </table>
    </div></center>
</div>

</body>
</html>
<?php

    if(isset($_POST['edit'])){
        while($row){
            if(empty($_POST['sale_price'])){
                echo '<script>alert("Please enter a price");</script>';
            }
            else{
                $sale_amt = $_POST['sale_price'];
                $add_sale = mysqli_query($conn,"INSERT INTO sale (pid,sale_amt) VALUES ('.$id.','.$sale_amt.')");
                if($add_sale){
                    echo '<script>alert("Successfully Inserted!")</script>';
                }
                else{
                    echo '<script>alert("Something Went Wrong!")</script>';
                }
            }
        }
    }
?>