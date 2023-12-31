<?php
session_start();

@include 'config.php';

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:cart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<head>
   <title>shopping cart</title>

   <link rel="stylesheet" href="../css/cart.css">

</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container">

<section class="shopping-cart">

   <h1 class="heading">shopping cart</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity(1=500g)</th>
         <th>total price</th>
         <th>action</th>
      </thead>

      <tbody>

      <?php 
$email = $_SESSION['email']; 

$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE email = '$email'");
if ($select_cart === false) {
    die('Error: ' . mysqli_error($conn)); // Display the specific error message
}

$grand_total = 0;

if(mysqli_num_rows($select_cart) > 0){
    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
?>

<tr>
<td><img src="Admin/vegitables/uploaded/<?php echo $fetch_cart['image']; ?>" height="100"  alt="">
<img src="Admin/baby/uploaded/<?php echo $fetch_cart['image']; ?>" height="100"  alt="">
</td>
<td><?php echo $fetch_cart['name']; ?></td>
<td>Rs.<?php echo number_format($fetch_cart['price']); ?>/-</td>
<td>
    <form action="" method="post">
        <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>" >
        <input type="number" name="update_quantity" min="1"value="<?php echo $fetch_cart['quantity']; ?>" >
        <input type="submit" value="update" name="update_update_btn">
    </form>   
</td>
    <td>Rs.<?php echo $sub_total = $fetch_cart['price'] * $fetch_cart['quantity']; ?>/-</td>
    <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
</tr>
<?php


        $grand_total += $sub_total;
    }
}
?>
<tr class="table-bottom">
    <td><a href="products.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
    <td colspan="3">Net Total</td>
    <td>Rs.<?php echo $grand_total; ?>/-</td>
    <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
</tr>

</tbody>
</table>

<div class="checkout-btn">
    <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
</div>

</section>

</div>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>