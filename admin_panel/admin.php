<?php
// Start the session
session_start();
       include 'dbconfig.php';
       include_once 'check_session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css?v1">
    
</head>
<body>
<?php if (isset($_GET['error'])): ?>
		<p><?php echo $_GET['error']; ?></p>
              <?php endif ?>
       <!-- Header  -->
       <div class="header">
              <div class="nav">
                     
                     <a href="admin.php"><img src="../images/logo.png" class="logo"></a>
                     <h1>ADMIN DASHBOARD</h1>

                     <form action="logout.php" method="post">
                            <input type="submit" value="LogOut" name="logout" class="logout-btn">
                     </form>
                     

              </div>
       </div>

       <div class="main">
              <!-- side nav  -->
              <div class="side-nav">

                     <form action="admin.php" method="post">
                            <a href="product.php"><input type="button" value="Products" name="products"></a>
                            <a href="featured.php"><input type="button" value="Featured" name="featured"></a>
                            <a href="sale.php"><input type="button" value="Products For Sale" name="sale"></a>
                            <a href="rental.php"><input type="button" value="Rental Requests" name="rental"></a>
                            <a href="orders.php"><input type="button" value="Orders" name="orders"></a>
                            <a href="msg.php"><input type="button" value="Message" name="message" id="msg"></a>
                     </form>

              </div> <!-- side nav end -->

       </div>
       






</body>
</html>

<!-- 
     <form action="upload.php"
           method="post"
           enctype="multipart/form-data">

           <input type="file" 
                  name="my_image">

           <input type="submit" 
                  name="submit"
                  value="Upload">
     	
     </form> -->