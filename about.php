<?php
    include 'nav.php';
?>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    .about-container{
        border: 5px double;
        border-radius: 10px;
        margin: 1rem;
        width: 50%;
        height: 50%; 
        padding: 35px 60px;
    }
    .profile{
        padding-bottom: 25px;
        letter-spacing: 5px;
    }
    .about-container p{
        text-align: justify;
    }
    .profile img{
        width: 15rem;
        border-radius: 50%;
        border: 5px double;
    }
    
</style>
<center>
<div class="about-container">
    <div class="profile">
        <img src="images/profile.jpg" alt="Picture">
        <h2>Niraj Shrestha</h2>
        <i>CEO of Muse</i>
    </div>
    <p>
    Welcome to Muse! I'm Niraj Shrestha, a passionate musician and the proud CEO of our online musical instrument store nestled in the heart of Nepal. Here at Muse, we've embarked on a mission to make the world of music accessible to all. Whether you're an aspiring musician taking your first steps or a seasoned artist seeking that perfect addition to your ensemble, our store is your haven. Our carefully curated selection includes an array of instruments and accessories that cater to various genres and skill levels. From guitars to keyboards, drums to wind instruments, our collection is designed to ignite your creativity and elevate your musical journey. What sets Muse apart is not just our products, but our commitment to creating a community of music lovers who share the same passion. We understand that music has the power to transcend boundaries and enrich lives, and that's the essence we infuse into every note. Join us at Muse and be a part of our harmonious family. Let's create melodies, memories, and magic together!
    </p>
</div>
</center>


<?php include_once 'footer.php'; ?>