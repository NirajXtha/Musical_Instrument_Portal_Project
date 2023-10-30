<?php
    session_start();
    include 'check_session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-weight: 600;
            font-size: 1em;
            font-family: system-ui;
            /* border: 1px solid red; */
            color: antiquewhite;
        }
        body{
            background-color: #79A7D3;
            background-image: url(../images/g3.jpg);
            backdrop-filter: blur(10px);
        }
        a{
            text-decoration: none;
            color: antiquewhite;
            font-weight: 600;
            font-size: 20px;
            position: relative;
            top: 30px;
            left: 200px;
        }
        a:hover{
            border-bottom: 2px solid;
        }
        .product-form{
            width: auto;
            display: grid;
            grid-template-columns: 13% 23% 13% 23%;
            gap: 1em;
            justify-content: center;
            /* text-align: center; */
        }
        .product-form input{
            border-radius: 6px;
            padding: 3px;
            border: 1px solid;
            /* color: #1f1f1f; */
        }
        #file{
            border: none;
        }
        .submit{
            grid-row: 4;
            grid-column: 2;
            cursor: pointer;
            height: 2.2em;
            background-color: #CC313D;
        }
        .submit:hover{
            background: antiquewhite;
            color: #1f1f1f;
            border: 1px solid;
        }
        .desc{
            font-weight: 300;
            grid-row: span 2;
            padding: 3px;
        }
        table{
            width: 80vw;
            text-align: center;
            margin-bottom: 25px;
        }
        table tr{
            height: 2em;
            overflow: hidden;
        }
        table tr td, th{
            padding: 5px;
            
        }
        input,textarea{
            color: black;
        }
        table input{
            color: antiquewhite;
        }
        table input:hover{
            color: #CC313D;
        }
        
    </style>
</head>
<body>
    <a href="admin.php">&#8592; Back</a>
    <h1 style="text-align: center; padding: 25px; font-size: 2em; font-weight: 900">Add product</h1>
        <br>
    <form action="add_product.php" method="POST" enctype="multipart/form-data" class="product-form">
        <label for="Product-Name">Product Name:</label>
        <input type="text" name="product_name">
        <label for="Product_type">Product Type:</label>
        <input type="text" name="product_type" id="">
        <label for="Product Brand">Product Brand:</label>
        <input type="text" name="brand" id="">
        <label for="Product Price">Product Price:</label>
        <input type="number" name="price" id="">
        <label for="product_image">Select an Image to display:</label>
        <input type="file" name="image" id="file">
        <label for="description">Add a Description:</label>
        <textarea name="description" class="desc" cols="20" rows="7"></textarea>
        <input type="submit" value="Add Product" name="submit" class="submit">
    </form>
    <br>
    <h1 style="text-align: center; padding: 25px; font-size: 2em; font-weight: 900; color: black">Manage products</h1><br>
<center>
    <table border= "1px">
        <tr>
            <th>S.No</th>
            <th>Product Name</th>
            <th>Product Type</th>
            <th>Product Brand</th>
            <th>Price</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        include 'dbconfig.php';
            $show = mysqli_query($conn,"SELECT * FROM product");
            $i = 1;
            while($row = mysqli_fetch_assoc($show)){
                
                echo "<tr>
                    <td>" . $i . "</td>
                    <td>" . $row['product'] . "</td>
                    <td>" . $row['p_type'] . "</td>
                    <td>" . $row['brand'] . "</td>
                    <td>" . $row['price'] . '</td>
                    <td>
                    <form action="edit.php" method="get">
                    <input type="hidden" value="'.$row['pid'].'" name = "pid">
                    <input type="submit" value="Edit" name="action" style="background: transparent; border: none; cursor: pointer">
                    </form></td>
                    <td>
                    <form action="edit.php" method="get">
                    <input type="hidden" value="'.$row['pid'].'" name = "pid">
                    <input type="submit" value="Delete" name="action" style="background: transparent; border: none; cursor: pointer">
                    </form></td>
                    </tr>';
                    $i++;
            }
        ?>
    </table>
</center>
    
</body>
</html>

