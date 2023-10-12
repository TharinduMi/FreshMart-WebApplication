<?php
session_start();
include '../../php/config.php';

if(isset($_POST['add_to_cart'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;
   
   $user_email = $_SESSION['email'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND email = '$user_email'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity, email) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity', '$user_email')");
      $message[] = 'product added to cart successfully';
   }
  }
?>

<!DOCTYPE html>
<html>
<script>
function scrollToSection() {
  var element = document.getElementById("scrollToElement");
  element.scrollIntoView({ behavior: "smooth" });
}
</script>

<head>
<link rel="stylesheet" href="../../css/products.css">
</head>
<body>
<header>
    <nav >
      <div class="navbar">
        <div class="logo"><a href="../Home.php"><img src="../../Image/Common/logo.png"></a></div>
        <ul class="menu">
          <li><a href="../home.php">Home</a></li>
          <li><a href="../home.php">Categories</a></li>
          <li><a href="#" onclick="scrollToSection()">Contact</a></li>
          <li><a href="">Feedback</a></li>
        </ul>
      </div>
      </div>


      <div class="buttons">

        <?php
          if (!isset($_SESSION['email'])) {
            echo '<a href="../login.php"><button id="btn">Log In</button></a>';
          } else {
            
            echo '<a href="../../php/logout.php"><button id="btn">Log out</button></a>';
          }
          ?>    


        <?php
              if(!isset($_SESSION['email'])){
          
                echo '<a href="../signup.php"><button id="btn">Signup</button></a>';
              }
              else{
                echo '<a href="../profile/profile.php"><button id="btn">Profile</button></a>';
              }
            ?>          
        
        
      <?php
              if(!isset($_SESSION['email'])){
                echo ' ';
              }
              else{
                echo '<a href="../cart.php"><button id="btn"><img src="../../Image/Common/cart.png" height="25px" width="35px"></button></a>';
              }
            ?>    

            
        

      </div>
    </nav>
    </nav>
  
    
  </header>




   <?php
   if(isset($message)) {
      foreach($message as $message) {
         echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
      }
   }
   ?>

   <br><br><br><br>
   <center>
  
   <h1 class="heading">Baby Products</h1>
  </center>
   <div class="card-container">
      <?php
      $select_products = mysqli_query($conn, "SELECT `name`, `price`, `image` FROM `baby`");
      if(mysqli_num_rows($select_products) > 0) {
         while($fetch_product = mysqli_fetch_assoc($select_products)) {
          
            ?>
          
      <div class="card">
   <form action="" method="post">
      <div class="gallery">

         <img src="../Admin/baby/uploaded/<?php echo $fetch_product['image']; ?>" alt="">
         <h3><?php echo $fetch_product['name']; ?></h3>
         <div class="price">Rs.<?php echo $fetch_product['price']; ?>/-</div>
         <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
         <label>1</label>
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
            <li><a href="#">Prefrences</a></li>
            <li><a href="#">Purchase</a></li>
          </ul>
          </div>
          <br/>
          <div class="top">
            <img src="../../Image/Common/logo2.png" > 
          <div class="media-icons" id="scrollToElement">
            <a href="#"><img id="img" src="../../Image/Common/whatsapp_logo.png" height="40" width="40"></a>
            <a href="#"><img id="img" src="../../Image/Common/Facebook_logo.png" height="40" width="40"></a>
            <a href="#"><img id="img" src="../../Image/Common/Twitter_logo.png" height="40" width="40"></a>
            <a href="#"><img id="img" src="../../Image/Common/insta_logo.png" height="40" width="40"></a>
            <a href="#"><img id="img" src="../../Image/Common/linkedin_logo.png" height="40" width="40"></a>
          </div>
        
    </div>
          
        </div>
      </div>
      <div class="bottom-details">
        <div class="bottom_text">
          <span class="copyright_text">Copyright © 2023 <a href="#">FreshMart Super</a> All rights reserved</span>
            <a href="#">Privacy policy</a>
            <a href="#">Terms & condition</a>
        
        </div>
      </div>
    </footer>

</body>
</html>
</body>
</html>
