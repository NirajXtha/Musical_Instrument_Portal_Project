<?php
    
    include 'dbconfig.php';
    
    include 'nav.php'; ?>

        <div class="texts">
            <h1>Get Your Groove On with Instruments</h1><br>
            <p>Unleash your inner musician with muse - the ultimate online destination for buying, renting, and discovering the perfect instruments and accessories for your musical journey.</p>
            <a href="about.php"><button>About Us</button></a>
        </div>
    

    <!-- Body of the home page -->
    <!-- product main and carousel-->
    <div class="pmain">
        <div class="product" id="product">
            <h3>Products</h3>
            <ul>
                <li><a href="all.php?type=midi">Audio Interface</a></li><hr>
                <li><a href="all.php?type=guitar">Guitars</a></li><hr>
                <li><a href="all.php?type=Keyboard">Keyboards</a></li><hr>
                <li><a href="all.php?type=mic">Microphones</a></li><hr>
                <li><a href="all.php?type=drum">Drums</a></li><hr>
                <!-- <li><a href="all.php?type=">Flutes</a></li><hr> -->
                <li><a href="all.php?type=bass">Bass</a></li><hr>
                <li><a href="all.php?type=accessories">Accessories</a></li><hr>
            </ul>
        </div>
        <!-- Product Carousel -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <div class="product-scroll">
            
            <a href="all.php?type=guitar" class="myslide"><img src="images/guitar_showcase.jpg" alt=""></a>
            <a href="all.php?type=drum" class="myslide"><img src="images/drum_showcase.jfif" alt=""></a>
            <a href="all.php?type=Keyboard" class="myslide"><img src="images/key_showcasr.jfif" alt=""></a>
            <a href="all.php?type=midi" class="myslide"><img src="images/midi_showcase.jpeg" alt=""></a>
            <a href="all.php?type=mic" class="myslide"><img src="images/mic_showcase.jfif" alt=""></a>
            <!-- <a href="all.php?type=headset" class="myslide"><img src="images/headset_showcase.jfif" alt=""></a> -->
            
        </div>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div> <!-- product main div end -->


    <!--Featured products-->
    <div class="featured">
        <h2>Featured Products</h2>
        <section class="featured_products">
            <?php 
            $sql = mysqli_query($conn,"SELECT * FROM product WHERE featured = 'Remove'");
                if(mysqli_num_rows($sql) > 0){
                
                while($row = mysqli_fetch_assoc($sql)){ 
                    $img = $row['img_url'];
                    $name = $row['product'];
                    $price = $row['price'];
                    $id = $row['pid'];
                    ?>
                    
            <div class="featured_product">
                <a href="view_product.php?id=<?=$id?>"><img src="images/<?=$img?>"></a>
                <p><?=$name?>
                    <br>
                    <?php $check = mysqli_query($conn,"SELECT * FROM sale WHERE pid = $id");
                    if(mysqli_num_rows($check) == 0){?>
                        <p><?=$price?></p>
                    <?php }else{
                        $sale = mysqli_fetch_assoc($check);
                        ?>
                        <p><?=$sale['sale_amt']?></p>
                    <?php }?>
                    
                </p>
                <form action="buy.php?id=<?=$id?>&type=product" method="post">
                    <input type="submit" value="Buy Now" name="buy" class="buy-btn">
                    <input type="submit" value="Add To Cart" name="cart" class="cart-btn">
                </form>
            </div>
                <?php }}?>
            
        </section><!-- featured products end-->
    </div>
    <!--featured end-->
    <hr>
    <!-- Trending items -->
    <div class="trending">
        <h2>For sale</h2>
        <section class="trend">
            <?php 
                $query = mysqli_query($conn, "SELECT * FROM product JOIN sale ON product.pid = sale.pid");
                while($row = mysqli_fetch_assoc($query)){ 
                    $img = $row['img_url'];
                    $name = $row['product'];
                    $price = $row['price'];
                    $id = $row['pid'];
                    $sale = $row['sale_amt'];
            ?>
            <div class="trending_products">
            <a href="view_product.php?id=<?=$id?>"><img src="images/<?=$img?>"></a>
                <p><?=$name?>
                    <br>
                    <p><?=$sale?> <strike><?=$price?></strike></p>
                </p>
                <form action="buy.php?id=<?=$id?>&type=product" method="post">
                    <input type="submit" value="Buy Now" name="buy" class="buy-btn">
                    <input type="submit" value="Add To Cart" name="cart" class="cart-btn">
                </form>
            </div>
                    <?php }?>    
        </section><!-- trending product end-->
    </div>
    <!-- Footer at the end of the page -->
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
    <?php
    if(isset($_POST['send'])){
            if(empty($_SESSION['username'])){
                echo '<script> var msg = confirm("Please login to contact us!");
                    if(msg == true){
                        location.assign("login/login.php");
                    }</script>';
            }
        else{
            if(empty($_POST['message'])){
                echo '<script> alert("Please enter a message to continue");</script>';
            }
            else{
                $username = $_SESSION['username'];
                $msg = $_POST['message'];
                $message = mysqli_query($conn,"INSERT INTO message(msg,username) VALUES('$msg','$username')");
                if($message){
                    echo '<script> alert("Inserted successfully!");</script>';
                }
                else{
                    echo '<script> alert("Something went wrong!");</script>';
                }
            }
        }
        
    }
?>
<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
    showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
    showSlides(slideIndex = n);
    }

    function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("myslide");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";
    captionText.innerHTML = dots[slideIndex-1].alt;
    }
</script>
</body>
</html>