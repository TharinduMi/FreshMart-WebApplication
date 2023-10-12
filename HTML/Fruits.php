<?php
session_start();
  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "freshmartdb";

// Create a new database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="../css/products.css">
</head>
<body>
   <nav>


   <div class="input-box">
      <input type="text" placeholder="Search here..." />
      <button class="button">Search</button>
   </div>

   <?php
   if(isset($message)) {
      foreach($message as $message) {
         echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
      }
   }
   ?>

   <br><br><br><br><br><br>
   <center>
  
   <h1 class="heading">Fruits</h1></a>
  </center>
   <div class="container">
      <?php
      $select_products = mysqli_query($conn, "SELECT `name`, `price`, `image` FROM `fruits`");
      if(mysqli_num_rows($select_products) > 0) {
         while($fetch_product = mysqli_fetch_assoc($select_products)) {
            ?>
            <div class="card">
               <form action="" method="post">
                  <div class="gallery">
                     <img src="C:/xampp/htdocs/Project/HTML/Admin/Fruits/uploaded/RedApple.jpg<?php echo $fetch_product['image']; ?>" alt="">
                     <h3><?php echo $fetch_product['name']; ?></h3>
                     <div class="price">Rs<?php echo $fetch_product['price']; ?>/-</div>
                     <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                     <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                     <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                     <p><button name="add_to_cart">Add to Cart</button></p>
                  </div>
               </form>
            </div>
            <?php
         }
      }
      ?>
   </div>
</body>
</html>


   <!-- custom js file link  -->
   <script src="js/script.js"></script>


   <!--Footer -->
   <footer>
  <div class="content">
    <div class="lboxes">
      <ul class="lbox">
        <li class="link_name">Company</li>
        <li><a href="#">Home</a></li>
        <li><a href="#">Contact us</a></li>
        <li><a href="#">About us</a></li>
      </ul>
      <ul class="lbox">
        <li class="link_name">Services</li>
        <li><a href="#">Order Food</a></li>
        <li><a href="#">Home Delivery</a></li>
        <li><a href="#">Cash on Delivery</a></li>
      </ul>
      <ul class="lbox">
        <li class="link_name">Account</li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">My account</a></li>
        <li><a href="#">Preferences</a></li>
        <li><a href="#">Purchase</a></li>
      </ul>
    </div>
    <br/>
    <div class="top">
      <img src="../Image/Common/logo2.png" > 
      <div class="media-icons">
        <a href="#"><img id="img" src="../Image/Common/whatsapp_logo.png" height="40" width="40"></a>
        <a href="#"><img id="img" src="../Image/Common/Facebook_logo.png" height="40" width="40"></a>
        <a href="#"><img id="img" src="../Image/Common/Twitter_logo.png" height="40" width="40"></a>
        <a href="#"><img id="img" src="../Image/Common/insta_logo.png" height="40" width="40"></a>
        <a href="#"><img id="img" src="../Image/Common/linkedin_logo.png" height="40" width="40"></a>
      </div>
    </div>
  </div>
  <div class="bottom-details">
    <div class="bottom_text">
      <span class="copyright_text">
        Copyright © 2023
        <a href="#">FreshMart Super</a> All rights reserved
      </span>
      <a href="#">Privacy policy</a>
      <a href="#">Terms & condition</a>
    </div>
  </div>
</footer>

</body>
</html>
</body>
</html>
