<?php
include 'dbconfig.php';
include 'nav.php';
if(empty($_SESSION['username'])){
    header('location: login/login.php');
}
$user = $_SESSION['username'];



?>

<style>
    .cart_body{
        color: white;
    }
    .remove{
        color: white;
    }
    .remove:hover{
        color: maroon;
    }
</style>

<div class="cart_body">
<div class="card">
    <h2>Cart</h2>
    <div class="cart">
        <table>
            <tr>
                <th colspan="2">Description</th>
                <th>Quantity</th>
                <th>Action</th>
                <th>Price</th>
            </tr>
        
        <?php
            $sql = mysqli_query($conn,"SELECT DISTINCT * FROM cart WHERE username = '$user' AND status = 'pending'");
            if(mysqli_num_rows($sql) == 0){
                echo "</table><h4>You have nothing add to your cart</h4>";
            }
            else{
                while($p = mysqli_fetch_array($sql)){
                    $query = mysqli_query($conn,"SELECT * FROM product WHERE pid = " . $p['pid']);
                    if($row = mysqli_fetch_assoc($query)){?>
                        <tr>
                            <td><img src="images/<?=$row['img_url']?>" alt=""></td>
                            <td><p><?=$row['product']?></p></td>
                            <td><?=$p['qty']?></td>
                            <td><form action="removecart.php?id=<?=$row['pid']?>" method="post">
                                <input type="submit" value="Remove" name="rem" class="remove">
                            </form></td>
                            <td><p>Rs. <?=$p['price']?></p></td>
                        </tr>
                        
                    <?php
                    
                    }
                }
                
                
            }
        ?>
        </table>
        <?php
            $sql = mysqli_query($conn,"SELECT DISTINCT * FROM cart WHERE username = '$user' AND status = 'pending'");
            if(mysqli_num_rows($sql) != 0){ ?>
                <p>Total: 
                    <?php 
                        $sql = mysqli_query($conn,"SELECT SUM(price) AS total FROM cart WHERE username = '$user' AND status = 'pending'");
                        $result = mysqli_fetch_assoc($sql);
                        echo $result['total'];
                    ?>
                </p>
                <button type="submit" onmouseup="return purchaseCart()">Purchase All</button>
            <?php }
        ?>
        </div><br><br>
        <h2 id="orders">Orders</h2>
        <div class="orders">
        <table>
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        
        <?php
            $sql = mysqli_query($conn,"SELECT Distinct * FROM orders WHERE username = '$user'");
            if(($num = mysqli_num_rows($sql)) == 0){
                echo "</table><h4>You have not Ordered Yet!</h4>";
            }
            else{
                while($o = mysqli_fetch_array($sql)){
                    $id = $o['pid'];
                    $query = mysqli_query($conn,"SELECT * FROM product WHERE pid = $id");
                    while($row = mysqli_fetch_assoc($query)){?>
                        <tr>
                            <td><?=$o['order_id']?></td>
                            <td><p><?=$row['product']?></p></td>
                            <td><p><?=$row['p_type']?></p></td>
                            <td><p><?=$o['qty']?></p></td>
                            <td><p>Nrs. <?=$o['price']?></p></td>
                            <td><p><?=$o['status']?></p></td>
                        </tr>

                    <?php
                    
                    }
                } 
            }
        ?>
        </table>
        
        </div>

            <!-- Cart payed -->
            <?php
                $sql = mysqli_query($conn,"SELECT DISTINCT *, cart.price AS actual FROM `cart` join c_order on c_order.id = cart.id join product on cart.pid = product.pid WHERE c_order.username = '$user' AND cart.status = 'payed'");
                if(($num = mysqli_num_rows($sql)) > 0){
            ?>
            <h2 id="cart_orders">Cart Orders</h2>
        <div class="orders">
        <table>
            <tr>
                <th>Order ID</th>
                <th>Products</th>
                <th>Order Date</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        
        <?php
            
                while($o = mysqli_fetch_array($sql)){
                    $date = $o['date'];
                    $time = $o['time'];
                    $cid = $o['id'];
                   // $sql1 = mysqli_query($conn,"SELECT * FROM `cart` join c_order on c_order.id = cart.id join product on cart.pid = product.pid WHERE c_order.username = '$user' AND c_order.status = 'pending' AND cart.status = 'payed'");
                   // $query = mysqli_query($conn,"SELECT DISTINCT * FROM cart WHERE id = $cid AND username = '$user' AND time = '$time' AND date = '$date'");
                    // while($row = mysqli_fetch_assoc($query)){
                      //  while($row = mysqli_fetch_assoc($sql1)){
                      //  $id = $row['pid'];
                     //   echo $id;
                        // $pro = mysqli_query($conn,"SELECT * FROM product where pid = $id");
                        ?>
                        <tr>
                            <td><?=$o['id']?></td>
                            <td><p>
                            <?php
                                // while($p = mysqli_fetch_assoc($pro)){
                                    // echo $p['product'] . ' [' . $row['qty'] . '],';
                                    echo $o['product'] . ' [' . $o['qty'] . '],';
                                // }
                                $stat = mysqli_query($conn,"SELECT * FROM c_order WHERE id = $cid");
                                $stt = mysqli_fetch_assoc($stat);
                            ?>
                            </p></td>
                            <td><p><?=$date?></p></td>
                            <td><p>Nrs. <?=$o['actual']?></p></td>
                            <td><p><?=$stt['status']?></p></td>
                        </tr>

                    <?php
                        
                    
                } 
            
        ?>
        </table>
        
        </div>
                <?php } ?>
        <h2 id="rent">Rent</h2>
        <div class="orders">
        <table>
            <tr>
                <th>Rent ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Hours</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        
        <?php
            $sql = mysqli_query($conn,"SELECT Distinct * FROM r_order WHERE username = '$user'");
            if(($num = mysqli_num_rows($sql)) == 0){
                echo "</table><h4>You have not Rented!</h4>";
            }
            else{
                while($r = mysqli_fetch_array($sql)){
                   ?>
                        <tr>
                            <td><?=$r['id']?></td>
                            <td><p><?=$r['date']?></p></td>
                            <td><p><?=$r['time']?></p></td>
                            <td><p><?=$r['hrs']?></p></td>
                            <td><p>Nrs. <?=$r['r_price']?></p></td>
                            <td><p><?=strtoupper($r['status'])?></p></td>
                        </tr>

                    <?php
                    
                    }
                } 
            
        ?>
        </table>
            
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
<script>
    function purchaseCart(){
        location.assign("buy.php?id=&type=cart");
    }
</script>