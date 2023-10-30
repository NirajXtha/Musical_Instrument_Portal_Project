<?php
    session_start();
    include 'dbconfig.php';
    include_once 'check_session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Featured</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-weight: 600;
            font-size: 1em;
            font-family: system-ui;
            color: antiquewhite;
            /* border: 1px solid red; */
        }
        body{
            background-color: #79A7D3;
            background-image: url(../images/g3.jpg);
            backdrop-filter: blur(12px);
        }
        a{
            text-decoration: none;
            
            font-weight: 600;
            font-size: 20px;
            position: relative;
            top: 30px;
            left: 200px;
        }
        a:hover{
            border-bottom: 2px solid;
        }
        table{
            display: flex;
            justify-content: center;
        }
        table td{
            padding: 10px;
            
        }

        img{
            height: 10em;
        }
        input{
            border: none;
            background: none;
            cursor: pointer;
            color: rgb(255,50,70);
        }

        input:hover{
            color: #fafafa;
        }
    </style>
</head>
<body>
    <a href="admin.php">&#8592; Back</a>
    <h1 style="text-align: center; padding: 25px; font-size: 2em; font-weight: 900">Add To Featured</h1>
    <br>
    <table>
        <tr>
            <th>S.no</th>
            <th>Name</th>
            <th>Type</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php
            $sql = mysqli_query($conn,"SELECT * FROM product");
            if($sql){
                while($row = mysqli_fetch_assoc($sql)){
                    echo '<tr>
                        <td>'.$row['pid'].'</td>
                        <td>'.$row['product'].'</td>
                        <td>' .$row['p_type']. '</td>
                        <td><img src="../images/' .$row['img_url']. '" alt=""></td>';
                        
                            if($row['featured'] == 'Add'){
                                
                                echo '<td><form action="edit_featured.php" method="get">
                                    <input type="hidden" value="'.$row['pid'].'" name = "pid">
                                    <input type="submit" value="'.$row['featured'].'" name="edit">
                                </form></td>';
                            }else{
                                echo '<td><form action="edit_featured.php" method="get">
                                    <input type="hidden" value="'.$row['pid'].'" name = "pid">
                                    <input type="submit" value="'.$row['featured'].'" name="edit">
                                </form></td>';
                            }
                        
                    echo '</tr>';
                }
            }
        ?>
    </table>
</body>
</html>

<?php
    
?>