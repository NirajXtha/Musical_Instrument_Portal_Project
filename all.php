

<?php
   
    include 'dbconfig.php';
    

    include 'nav.php';

?>
<style>
    .section{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
        gap: 1rem;
        /* margin: 10px 25px; */
        padding: 20px 35px;
        background-image: url(images/uwp3814594.jpeg);
        background-size: cover;
        background-repeat: no-repeat;
        font-weight: 700;
        color: antiquewhite;
    }
    .view{
        border: 1px solid;
        border-radius: 20px;
        margin: 0 10px;
        display: grid;
        text-align: center;
        backdrop-filter: blur(10px);
        padding-bottom: 10px;
        max-width: 16rem;
    }
    .view a{
        padding: 10px;
        /* color: maroon; */
    }
    .container{
        display: flex;
        flex-wrap: wrap;
        gap: 2em;
        width: 100%;
        padding: 25px;
    }
    *{
        /* border: 1px solid red; */
        margin: 0px;
        padding: 0px;
    }
    .cards{
        /* display: flex; */
        /* justify-content: center; */
        border-radius: 10px;
        overflow: hidden;
        width: auto;
        
        height: 20rem;
        flex-direction: column;
        text-align: center;
        border: 1px solid;
        padding: 5px;
    }
    form input{
        background-color: #F96167;
        width: 6em;
        height: 2em;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        margin: 0;
        padding: 0;
        font-weight: 500;
        font-size: 15px;
    }
    form input:hover{
        color: antiquewhite;
    }
    .cards img{
        width: auto;
        max-width: 14rem;
        height: 16rem;
        border-radius: 10px;
        border: none;
    }
    .cards h2{
        color: black;
    }
</style>
<div class="section">
    <?php
    if(!empty($_GET['type'])){
        $type = $_GET['type'];
        
        
    if($type == "products"){
        $sql = mysqli_query($conn,"SELECT * FROM product");
        if($sql){
        while($result = mysqli_fetch_assoc($sql)){ 
            $id=$result['pid'];
            $check = mysqli_query($conn,"SELECT * FROM sale WHERE pid = $id"); 
            ?>
            <div class="view">
                <a href="view_product.php?id=<?=$id?>"><img src="images/<?=$result['img_url']?>" width="200px" height="200px" alt=""></a>
                <a href="view_product.php?id=<?=$id?>"><?php echo $result['product']; ?></a>
                <?php
                    if(mysqli_num_rows($check) == 0){?>
                        <a href="view_product.php?id=<?=$id?>"><?=$result['price']?></a>
                    <?php }else{
                        $sale = mysqli_fetch_assoc($check); ?>
                        <a href="view_product.php?id=<?=$id?>"><?=$sale['sale_amt']?></a>
                    <?php }
                ?>
                
                <form action="buy.php?id=<?=$id?>&type=product" method="post">
                    <input type="submit" value="Buy Now" name="buy" class="buy-btn">
                    <input type="submit" value="Add To Cart" name="cart" class="cart-btn">
                </form>
            </div>
       <?php }}
    }
    
    

    elseif($type == "brands"){
        $sql = mysqli_query($conn, "SELECT DISTINCT brand from product");
        $result = "";
        
        while($result = mysqli_fetch_array($sql)){
            // echo $result['brand']; 
            echo 
            '
                <div class="cards">
                    <a href="all.php?type='.$result['brand'].'"><img src="images/'.$result['brand'].'.png" alt="'.$result['brand'].'"></a><br>
                    <h2>'.$result['brand'].'</h2>
                </div>
            ';
        }
        
    }
    else{
        $stype = strtolower($type);
        $query = mysqli_query($conn,"SELECT * FROM product WHERE p_type = '$type' OR p_type = '$stype'" );
        if(mysqli_num_rows($query) == 0){
        $sql = mysqli_query($conn,"SELECT * FROM product WHERE brand = '$type'");
        if($sql){
            while($result = mysqli_fetch_assoc($sql)){ $id=$result['pid']; 
                $check = mysqli_query($conn,"SELECT * FROM sale WHERE pid = $id");?>
                <div class="view">
                    <a href="view_product.php?id=<?=$id?>"><img src="images/<?=$result['img_url']?>" width="200px" height="200px" alt=""></a>
                    <a href="view_product.php?id=<?=$id?>"><?php echo $result['product']; ?></a>
                    <?php
                    if(mysqli_num_rows($check) == 0){?>
                        <a href="view_product.php?id=<?=$id?>"><?=$result['price']?></a>
                    <?php }else{
                        $sale = mysqli_fetch_assoc($check); ?>
                        <a href="view_product.php?id=<?=$id?>"><?=$sale['sale_amt']?></a>
                    <?php }
                ?>
                    
                    <form action="buy.php?id=<?=$id?>&type=product" method="post">
                    <input type="submit" value="Buy Now" name="buy" class="buy-btn">
                    <input type="submit" value="Add To Cart" name="cart" class="cart-btn">
                </form>
                </div>
           <?php }}}
           else{
                $query = mysqli_query($conn,"SELECT * FROM product WHERE p_type = '$type' OR p_type = '$stype'" );
                while($result = mysqli_fetch_assoc($query)){ 
                    $id=$result['pid']; 
                    $check = mysqli_query($conn,"SELECT * FROM sale WHERE pid = $id");?>
                    <div class="view">
                        <a href="view_product.php?id=<?=$id?>"><img src="images/<?=$result['img_url']?>" width="200px" height="200px" alt=""></a>
                        <a href="view_product.php?id=<?=$id?>"><?php echo $result['product']; ?></a>
                        <?php
                    if(mysqli_num_rows($check) == 0){?>
                        <a href="view_product.php?id=<?=$id?>"><?=$result['price']?></a>
                    <?php }else{
                        $sale = mysqli_fetch_assoc($check); ?>
                        <a href="view_product.php?id=<?=$id?>"><?=$sale['sale_amt']?></a>
                    <?php }
                    ?>
                        <form action="buy.php?id=<?=$id?>&type=product" method="post">
                    <input type="submit" value="Buy Now" name="buy" class="buy-btn">
                    <input type="submit" value="Add To Cart" name="cart" class="cart-btn">
                </form>
                    </div>
               <?php }
           }
    }
    }//not empty type end


else{
    $sql = mysqli_query($conn,"SELECT * FROM product");
        if($sql){
        while($result = mysqli_fetch_assoc($sql)){ $id=$result['pid']; 
            $check = mysqli_query($conn,"SELECT * FROM sale WHERE pid = $id");?>
            <div class="view">
                <a href="view_product.php?id=<?=$id?>"><img src="images/<?=$result['img_url']?>" width="200px" height="200px" alt=""></a>
                <a href="view_product.php?id=<?=$id?>"><?php echo $result['product']; ?></a>
                <?php
                    if(mysqli_num_rows($check) == 0){?>
                        <a href="view_product.php?id=<?=$id?>"><?=$result['price']?></a>
                    <?php }else{
                        $sale = mysqli_fetch_assoc($check); ?>
                        <a href="view_product.php?id=<?=$id?>"><?=$sale['sale_amt']?></a>
                    <?php }
                ?>
                <form action="buy.php?id=<?=$id?>&type=product" method="post">
                    <input type="submit" value="Buy Now" name="buy" class="buy-btn">
                    <input type="submit" value="Add To Cart" name="cart" class="cart-btn">
                </form>
            </div>
       <?php }}
}
    ?>
    
</div>
    <?php include 'footer.php'; ?>
</body>
</html>