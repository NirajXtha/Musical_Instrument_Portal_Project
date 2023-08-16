<?php
include 'nav.php';
include 'login/dbconfig.php';
?>
<style>
    .contain{
        background-image: url(images/beck.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
    }
    /* .contain{
        border: 1px solid;
        margin: 10px 25px;
    } */
    .contain table{
        
        margin: 10px;
    }
    .contain table tr th,.contain table tr td{
        padding: 10px;
        max-width: 35rem;
        min-width: 5rem;
        font-weight: 600;
        color: white;     
        text-align: center;
    }
    .contain table tr td img{
        width: 200px;
        max-height: 250px;
    }
    .contain table tr td a, .add{
        cursor: pointer;
        border: none;
        background: transparent;
        color: white;
        font-weight: 900;
    }
</style>


<div class="contain">
    <table border="1px">
        <tr>
            <th>Set</th>
            <th>Details</th>
            <th>Image</th>
            <th>Price(/hr)</th>
            <th>Action</th>
            <th>Status</th>
        </tr>
        <?php
            $sql = mysqli_query($conn,"SELECT * FROM rent");
            $i = 1;
            while($row = mysqli_fetch_assoc($sql)){
                echo 
                '<tr>
                    <td>' . $i . '</td>
                    <td>' . $row['detail']. '</td>
                    <td><img src="images/' . $row['img']. '" alt="' . $row['rid'] . '"></td>
                    <td>' . $row['price'] . '</td>
                    <td><a href="buy.php?id='.$row['rid'].'&type=rent">ADD
                        </a></td>
                    <td>';
                    if(empty($row['username'])){
                        echo 'Available';
                    }
                    else{
                        echo 'Not Available';
                    }
                    $i++;
            }
        ?>
    </table>
</div>

<?php include_once 'footer.php'; ?>