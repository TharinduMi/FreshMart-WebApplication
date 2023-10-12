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
       

if (isset($_POST['add_product'])) {
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'uploaded/'.$p_image;

   $insert_query = mysqli_query($conn, "INSERT INTO `baby`(`name`, `price`, `image`) VALUES('$p_name', '$p_price', '$p_image')") or die('query failed');

   if ($insert_query) {
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'Product added successfully';
   } else {
      $message[] = 'Could not add the product';
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `baby` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:admin.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:admin.php');
      $message[] = 'product could not be deleted';
   };
};

if(isset($_POST['update_baby'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded/'.$update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `baby` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'product updated succesfully';
      header('location:admin.php');
   }else{
      $message[] = 'product could not be updated';
      header('location:admin.php');
   }

}

?>


<!DOCTYPE html>
<html>

<head>
   <title>Admin Dashboard</title>
   <link rel="stylesheet" href="../../../css/Edit_item.css">
   <?php
   echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
;
?>
</head>

<body>
   <div class="sidebar">

      <ul class="nav-links">
         <li>
            <a href="#" class="active">
               <i class='bx bx-grid-alt'></i>
               <span class="links_name">Category List</span>
            </a>
         </li>
         <li>
            <a href="../Vegitables/admin.php">
               <i class='bx bx-box'></i>
               <span class="links_name">Vegetables</span>
            </a>
         </li>
         <li>
            <a href="../Fruits/admin.php">
               <i class='bx bx-list-ul'></i>
               <span class="links_name">Fruits</span>
            </a>
         </li>
         <li>
            <a href="#">
               <i class='bx bx-coin-stack'></i>
               <span class="links_name"><h2>Baby Products</h2></span>
            </a>
         </li>
         <li>
            <a href="#">
               <i class='bx bx-book-alt'></i>
               <span class="links_name">Beverages</span>
            </a>
         </li>
         <li>
            <a href="#">
               <i class='bx bx-message'></i>
               <span class="links_name">Food Cupboard</span>
            </a>
         </li>
         <li>
            <a href="#">
               <i class='bx bx-message'></i>
               <span class="links_name">House Hold</span>
            </a>
         </li>
         <li>
            <a href="#">
               <i class='bx bx-message'></i>
               <span class="links_name">Cooking Essentials</span>
            </a>
         </li>
         <li>
            <a href="#">
               <i class='bx bx-message'></i>
               <span class="links_name">Frozen Food</span>
            </a>
         </li>
         <li>
            <a href="#">
               <i class='bx bx-message'></i>
               <span class="links_name">Sea Food</span>
            </a>
         </li>
         <li>
            <a href="#">
               <i class='bx bx-message'></i>
               <span class="links_name">Snacks & Confectionery</span>
            </a>
         </li>
         <li>
            <a href="#">
               <i class='bx bx-message'></i>
               <span class="links_name">Rice</span>
            </a>
         </li>
         <li>
            <a href="#">
               <i class='bx bx-message'></i>
               <span class="links_name">Seeds & Spices</span>
            </a>
         </li>
         <li>
            <a href="#">
               <i class='bx bx-message'></i>
               <span class="links_name">Desserts & Ingredients</span>
            </a>
         </li>
         <li>
            <a href="#">
               <i class='bx bx-message'></i>
               <span class="links_name">Tea & Coffee</span>
            </a>
         </li>
      </ul>
   </div>

   <header>
      <nav>
         <div class="navbar">
            <div class="logo"><a href="home.php"><img src="../../../Image/Common/logo.png"></a></div>
            <ul class="menu">
               <li><a href="../admin.php">Home</a></li>
               <li><a href="">Contact</a></li>
               <div class="logout">
               <li><a href="../logout.php">Log Out</a></li></div>
               </div>
            </ul>
         </div>
      </nav>
   </header>

   <div class="table">
   <?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>



<div class="container">

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>add a new product to Baby Products</h3><br>
   <input type="text" name="p_name" placeholder="enter the product name" class="box" required>
   <input type="number" name="p_price" min="0" placeholder="enter the product price" class="box" required>
   <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="submit" value="add the product" name="add_product" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         <th>product image &nbsp;&nbsp;&nbsp;</th>
         <th>product name &nbsp;&nbsp;&nbsp;</th>
         <th>product price &nbsp;&nbsp;&nbsp;</th>
         <th>action</th>
      </thead>

      <tbody>
         <?php
         
            $select_fruits = mysqli_query($conn, "SELECT * FROM `baby`");
            if(mysqli_num_rows($select_fruits) > 0){
               while($row = mysqli_fetch_assoc($select_fruits)){
         ?>

         <tr>
            <td><img src="uploaded/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>Rs.<?php echo $row['price']; ?>/-</td>
            <td>
               <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no product added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `baby` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
      <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
      <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the prodcut" name="update_fruits" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>
</body>

</html>
