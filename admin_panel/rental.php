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
    <title>Rental</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            background-image: url(../images/g3.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            color: antiquewhite;
        }
        a{
            text-decoration: none;
            color: antiquewhite;
            font-weight: 600;
            font-size: 20px;
            
        }
        .back{
            position: relative;
            top: 30px;
            left: 200px;
        }
        a:hover{
            border-bottom: 2px solid;
        }
        img{
            height: 5rem;
            cursor: pointer;
        }
        button{
            border: none;
            background: transparent;
            cursor: pointer;
        }
        #x{
            position: absolute;
            right: 3rem;
            top: 2rem;
            font-weight: 900;
            font-size: 2rem;
            z-index: 100;
            display: none;
            color: antiquewhite;
        }
        table{
            backdrop-filter: blur(25px);
            text-align: center;
        }
        th,td{
            padding: 5px 10px;
            
        }
        th{
            border-bottom: 1px solid;
        }
        td{
            height: 5rem;
        }
        .card{
            border: 1px solid;
            margin: 15px 25px;
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <div class="card">
<a href="admin.php" class="back">&#8592; Back</a>
    <h1 style="text-align: center; padding: 25px; font-size: 2em; font-weight: 900">Rental Requests</h1>
    <br>
    <button id="x">X</button>
    <center>
    <table id="table">
        <tr>
            <th>Rent ID</th>
            <th>Username</th>
            <th>Date</th>
            <th>Time</th>
            <th>Hours</th>
            <th>Price</th>
            <th>District</th>
            <th>Municipality</th>
            <th>Tole</th>
            <th>Ward</th>
            <th>Phone</th>
            <th>Receipt</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
            $sql = mysqli_query($conn,"SELECT * FROM `rent` join r_order on rent.username = r_order.username WHERE status = 'pending'");
            if($sql){
                while($row = mysqli_fetch_assoc($sql)){ 
                    $id = $row['id'];?>
                    <tr>
                        <td><?=$row['id']?></td>
                        <td><?=strtoupper($row['username'])?></td>
                        <td><?=$row['date']?></td>
                        <td><?=$row['time']?></td>
                        <td><?=$row['hrs']?></td>
                        <td><?=$row['r_price']?></td>
                        <td><?=$row['district']?></td>
                        <td><?=$row['municipality']?></td>
                        <td><?=$row['tole']?></td>
                        <td><?=$row['ward']?></td>
                        <td><?=$row['ph']?></td>
                        <td><img src="../payments/<?=$row['payment']?>" id="pay"></td>
                        <td><a href="approve.php?type=rent&id=<?=$id?>">Approve</a></td>
                        <td><a href="reject.php?type=rent&id=<?=$id?>">Reject</a></td>
                    </tr>
                <?php }
            }
        ?>
    </table>
</center>
</div>
    <script>
        // const img = document.getElementById('img');
        const pay = document.getElementById('pay');
        const close = document.getElementById('x');
        const table = document.getElementById('table');
        pay.addEventListener("click",function(){
            // pay.style.transform = "matrix(7, 0, 0, 7, -250, 100)";
            close.style.display = "block";
            pay.style.display = "flex";
            pay.style.position = "absolute";
            pay.style.bottom = "0";
            pay.style.left = '45%';
            pay.style.transform = "scale(5.8)";
        });
        close.addEventListener("click",function(){
            pay.style.transform = "scale(1)";
            close.style.display = "none";
            pay.style.position = "inherit";
        })
    </script>
</body>
</html>
