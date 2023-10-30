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
        .msg{
            max-width: 40rem;
            min-width: 25rem;
            
        }
    </style>
</head>
<body>
    <div class="card">
<a href="admin.php" class="back">&#8592; Back</a>
    <h1 style="text-align: center; padding: 25px; font-size: 2em; font-weight: 900">User's Feedback</h1>
    <br>
    <button id="x">X</button>
    <center>
    <table id="table">
        <tr>
            <th>Username</th>
            <th class="msg">Message</th>
            
        </tr>
        <?php
            $sql = mysqli_query($conn,"SELECT * FROM `message`");
            if($sql){
                while($row = mysqli_fetch_assoc($sql)){ 
                    ?>
                    <tr>
        
                        <td><?=strtoupper($row['username'])?> </td>
                        <td><?=$row['msg']?></td>
                    </tr>
                <?php }
            }
        ?>
    </table>
</center>
</div>
    
</body>
</html>
