<div class="footer">
<div class="categories">
    <h3>Categories</h3>
    <?php
    $sql = mysqli_query($conn,"SELECT DISTINCT p_type FROM product");
    echo '<ul style="list-style: none;">';
    while($row = mysqli_fetch_array($sql)){
        $category = $row['p_type']; ?>
        <li><a href="all.php?type=<?=$category?>"><?php echo $category; ?></a></li>
        
   <?php }
    ?>
</div>

<div class="links">
    <h3>Quick Links</h3>
    <ul style="list-style: none">
        <li><a href="about.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="all.php?type=products">All Products</a></li>
        <li><a href="all.php?type=brands">All Brands</a></li>
        
    </ul>
</div>

<div class="contact-us" id="contactus">
        <h3>Contact Us</h3>
        <h4>Call Us Now: +977 9841490485</h4>
        <form action="index.php" method="POST">
            <textarea name="message" id="" cols="60" rows="8" placeholder="Send us a message..."></textarea><br>
            <input type="submit" value="Send" name="send" class="sendbtn">
        </form>
</div>
</div>

<div class="social">
        <p>© Copyright by Niraj Shrestha</p>
        <div class="socials">
            <a href="#"><img src="images/facebook.png" alt=""></a>
            <a href="#"><img src="images/instagram.png" alt=""></a>
            <a href="#"><img src="images/github.png" alt=""></a>
            <a href="#"><img src="images/discord.png" alt=""></a>
        </div>

</div>

