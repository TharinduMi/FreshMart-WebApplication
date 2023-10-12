<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'freshmartdb') or die('Connection failed');

if (isset($_POST['order_btn'])) {
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = mysqli_real_escape_string($conn, $_POST['number']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address1 = mysqli_real_escape_string($conn, $_POST['address1']);
   $address2 = mysqli_real_escape_string($conn, $_POST['address2']);

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE email='$email'");
   $price_total = 0;
   $product_names = array();

   if (mysqli_num_rows($cart_query) > 0) {
      while ($product_item = mysqli_fetch_assoc($cart_query)) {
         $product_names[] = $product_item['name'] . ' (' . $product_item['quantity'] . ')';
         $product_price = $product_item['price'] * $product_item['quantity'];
         if (is_numeric($product_price)) {
            $price_total += $product_price;
         }
      }
   }

   $total_products = implode(', ', $product_names);

   // Insert order details into 'order' table
   $order_query = mysqli_query($conn, "INSERT INTO `order` (name, number, email, method, address1, address2, product, total_price) VALUES ('$name', '$number', '$email', '$method', '$address1', '$address2', '$total_products', '$price_total')") or die('Query failed');

   if ($order_query) {
      $order_id = mysqli_insert_id($conn); // Retrieve the generated order ID

      // Insert product details into product_order table
      if (mysqli_num_rows($cart_query) > 0) {
         mysqli_data_seek($cart_query, 0); // Reset the result set pointer
         while ($product_item = mysqli_fetch_assoc($cart_query)) {
            $product_names[] = $product_item['name'] . ' (' . $product_item['quantity'] . ')';
            $product_price = $product_item['price'] * $product_item['quantity'];
            if (is_numeric($product_price)) {
               $price_total += $product_price;
            }

            // Insert product details into product_order table with the order ID
            mysqli_query($conn, "INSERT INTO `product_order` (order_id, email, pname, qty, price) VALUES ('$order_id', '$email', '{$product_item['name']}', '{$product_item['quantity']}', '{$product_item['price']}')") or die('Query failed');
         }
      }

      $grand_total = $price_total; // Calculate the grand total

      echo "
      <div class='order-message-container'>
         <div class='message-container'>
            <h3>Thank you for shopping!</h3>
            <div class='order-detail'>
               <span>".$total_products."</span>
               <span class='total'>Total: Rs.".$grand_total."/-</span>
            </div>
            <div class='customer-details'>
               <p>Your name: <span>".$name."</span></p>
               <p>Your number: <span>".$number."</span></p>
               <p>Your email: <span>".$email."</span></p>
               <p>Your address: <span>".$address1.", ".$address2."</span></p>
               <p>Your payment mode: <span>".$method."</span></p>
               <p>(*Pay when product arrives*)</p>
            </div>
            <a href='home.php' class='btn'>Continue shopping</a>
         </div>
      </div>
      ";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Checkout</title>
   <link rel="stylesheet" href="../style.css">
</head>
<body>
   <?php include 'includes/header.php'; ?>
   <div class="container">
      <section class="checkout-form">
         <h1 class="heading">Complete Your Order</h1>
         <form action="" method="post">
         <div class="display-order">
   <?php
   $email = $_SESSION['email'];
   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE email='$email'");
   $grand_total = 0;
   if (mysqli_num_rows($select_cart) > 0) {
      while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
         $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
         $grand_total += $total_price;
         echo "<span>".$fetch_cart['name']." (".$fetch_cart['quantity'].")</span>";
      }
   } else {
      echo "<div class='display-order'><span>Your cart is empty!</span></div>";
   }

   $email = $_SESSION['email'];
   $fetch_signup_query = mysqli_query($conn, "SELECT * FROM `signup` WHERE E_mail='$email'");
   $fetch_signup = mysqli_fetch_assoc($fetch_signup_query);
   ?>
   <span class="grand-total">Total Balance: Rs.<?= number_format($grand_total); ?>/-</span>
</div>
            <div class="flex">
               <div class="inputBox">
                  <span>Your name</span>
                  <input type="text" value="<?php echo $fetch_signup['First_Name'] . ' ' . $fetch_signup['Last_Name']; ?>" name="name" required>
               </div>
               <div class="inputBox">
                  <span>Your number</span>
                  <input type="number" value="<?php echo $fetch_signup['Phone_Number']; ?>" name="number" required>
               </div>
               <div class="inputBox">
                  <span>Your email</span>
                  <input type="email" value="<?php echo $fetch_signup['E_mail']; ?>" name="email" required>
               </div>
               <div class="inputBox">
                  <span>Payment method</span>
                  <select name="method">
                     <option value="cash on delivery" selected>cash on delivery</option>
                     <option value="credit card">cash on delivery</option>
                     <option value="bank transfer">cash on delivery</option>
                  </select>
               </div>
               <div class="inputBox">
                  <span>Address line 1</span>
                  <input type="text" value="<?php echo $fetch_signup['Address_line1']; ?>" name="address1" required>
               </div>
               <div class="inputBox">
                  <span>Address line 2</span>
                  <input type="text" value="<?php echo $fetch_signup['Address_Line2']; ?>" name="address2" required>
               </div>
            </div>
            <input type="submit" value="Order Now" name="order_btn" class="btn">
         </form>
      </section>
   </div>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>
</body>
</html>
