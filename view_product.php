<?php

    include 'dbconfig.php';
    
?>
    <style>
        *{
    margin: 0;
    padding: 0;
    /* border: 1px solid red; */
}
h1{
    text-align: center;
    grid-column: span 2;
    font-size: 55px;
    font-family: cursive;
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
    <div class="product-view-container">
        <div class="product-image">
            <img src="images/<?php echo $view['img_url']; ?>" alt="<?php echo $view['product']; ?>">
        </div>
        
        <div class="product-details">
            <h1><?php echo $view['product']; ?></h1>
            
            <div class="product-info">
                <?php
                $p = mysqli_query($conn, "SELECT * FROM sale WHERE pid = " . $id);
                if(mysqli_num_rows($p) > 0){
                    $pp = mysqli_fetch_assoc($p); ?>
                    <div class="product-price">
                        <span class="sale-price">₹<?php echo $view['price']; ?></span>
                        <span class="current-price">₹<?php echo $pp['sale_amt']; ?></span>
                    </div>
                <?php } else { ?>
                    <div class="product-price">₹<?php echo $view['price']; ?></div>
                <?php } ?>
                
                <div class="quantity-controls">
                    <button type="button" onclick="decreaseQuantity()">-</button>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="10" readonly>
                    <button type="button" onclick="increaseQuantity()">+</button>
                </div>
                
                <form action="addtocart.php?id=<?php echo $id; ?>" method="post" class="product-actions">
                    <input type="hidden" name="quantity" id="quantity-input" value="1">
                    <input type="submit" value="Add To Cart" name="cart">
                </form>
            </div>
            
            <p><?php echo $view['detail']; ?></p>
        </div>
    </div>

    <script>
    function decreaseQuantity() {
        const input = document.getElementById('quantity');
        const hiddenInput = document.getElementById('quantity-input');
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
            hiddenInput.value = input.value;
        }
    }

    function increaseQuantity() {
        const input = document.getElementById('quantity');
        const hiddenInput = document.getElementById('quantity-input');
        if (input.value < 10) {
            input.value = parseInt(input.value) + 1;
            hiddenInput.value = input.value;
        }
    }
    </script>

    <?php include 'footer.php'; ?>
    
</body>
</html>