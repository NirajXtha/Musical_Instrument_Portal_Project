<?php

    include 'dbconfig.php';
    
?>
    <style>
        *{
    margin: 0;
    padding: 0;
    /* border: 1px solid red; */
}
.main{
    width: 95vw;
    height: 100%;
    margin: 10px;
    display: grid;
    grid-template-columns: 45% 55%;
}
.p_image{
    width: 35em;
}
.p_image img{
    width: auto;
    height: 35em;
}
h1{
    text-align: center;
    grid-column: span 2;
    font-size: 55px;
    font-family: cursive;
}
.p_description h2{
    font-weight: 500;
    font-size: 25px;
}
.p_description{
    font-size: 20px;
    text-align: justify;
}
.p_description form label{
    padding: 0 20px 0 0;
}
.p_description form input{
    width: 2.3em;
    height: 2em;
    padding: 0;
    margin: 0;
    text-align: center;
}
.p_description form .cart{
    width: 10em;
    height: 3em;
    font-weight: 650;
    border-radius: 10px;
    border: 1px solid;
    cursor: pointer;
}
.cart:hover{
    background: #F96167;
    color: #f1f1f1; 
}

    </style>
    <?php include 'nav.php'; 
    $id = $_GET['id'];
    $sql = mysqli_query($conn,"SELECT * FROM product WHERE pid = '$id'");
    if(mysqli_num_rows($sql) > 0){
        $view = mysqli_fetch_assoc($sql);
    }
    ?>
    <div class="main">
    <h1><?php echo $view['product'] ?></h1>
        <div class="p_image">
            <img src="images/<?=$view['img_url']?>" alt="">
        </div>
        <div class="p_description">
            <br><br>
            <h2><?php echo $view['product'] ?></h2><br>
            <h4>
                <?php 
                $p = mysqli_query($conn, "SELECT * FROM sale WHERE pid = " . $id);
                if(mysqli_num_rows($p) > 0){
                    $pp = mysqli_fetch_assoc($p);
                    echo "Nrs " . $pp['sale_amt'];
                }else{
                    echo "Nrs " . $view['price'];
                }
                
                ?>
            </h4><br>
            <p><?php echo $view['detail'] ?></p>
            <br>
            <br>
            <form action="addtocart.php?id=<?=$id?>" method="post">
                <label for="Quantity" max="10">Quantity</label>
                <input type="number" name="quantity" value="1"><br><br>
                <input type="submit" value="ADD TO CART" name="cart" class="cart">
            </form>
        </div>
    </div>
    
</body>
</html>