<?php
@include '../config.php';
?>
<!DOCTYPE html>

  <head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../../CSS/admin.css">
</head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name"><img src="../../Image/Common/logo2.png"></span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="#" class="active">
            <span class="links_name">&emsp;Select Category</span>
          </a>
        </li>
        <li>
          <a href="vegitables/admin.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Vegitables</span>
          </a>
        </li>
        <li>
          <a href="fruits/admin.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Fruits</span>
          </a>
        </li>
       
        <li>
          <a href="#">
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name">Baby Products</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Beverages</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">Food Cupboard</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">House Hold</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">Cooking Essentials</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">Frozen Food</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">Sea Food</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">Snacks & Confectionary</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">Rice</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">Seeds & Spices</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">Desserts & ingredients</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">Tea & coffee</span>
          </a>
        </li>

     
  </div>









  <header>
    <nav >
      <div class="navbar">
        <div class="logo"><a href="home.php"><img src="../../Image/Common/logo.png"></a></div>
        <ul class="menu">
          <li><a href="home.php">Home</a></li>
          <div class="logout">
          <li><a href="logout.php">Log Out</a></li></div>
        </ul>
      </div>
      </div>
    </nav>
    </nav>

  </header>

  <br><br><br><br><br><br>

  <div class="container">
    <center>
    <h2>New Orders</h2>
</center>
  <?php
$order_query = mysqli_query($conn, "SELECT * FROM `order`");
if (mysqli_num_rows($order_query) > 0) {
   while ($order_row = mysqli_fetch_assoc($order_query)) {
      $order_id = $order_row['id']; // Assuming 'id' is the primary key of the 'order' table
      $name = $order_row['name'];
      $number = $order_row['number'];
      $email = $order_row['email'];
      $method = $order_row['method'];
      $address1 = $order_row['address1'];
      $address2 = $order_row['address2'];
      $product = $order_row['product'];
      $total_price = $order_row['total_price'];

      // Display the order details
      echo "<p>Name: $name</p>";
      echo "<p>Number: $number</p>";
      echo "<p>Email: $email</p>";
      echo "<p>Method: $method</p>";
      echo "<p>Address: $address1 , $address2</p>";
      echo "<p>Product: $product</p>";
      echo "<p>Total Price: $total_price</p>";

      // Add the delete button
      echo "<button onclick=\"deleteOrder($order_id)\">Delete</button>";
      
      

      // Add the mark as delivered button
      echo "<button onclick=\"markAsDelivered($order_id)\">Mark as Delivered</button>";

      echo "<hr>";
   }
} else {
   echo "<p>No orders found.</p>";
}
?>

  </div>

  <script>
function deleteOrder(orderId) {
  if (confirm("Are you sure you want to delete this order?")) {
 
    $.post('delete_order.php', { id: orderId }, function(response) {
      // Handle the response from the server if needed
      console.log(response);
      // Reload the page or update the order list
      location.reload();
    });
  }
}

function markAsDelivered(orderId) {
  if (confirm("Mark this order as delivered?")) {
    // Make AJAX request to mark order as delivered using orderId
    // Example using fetch API:
    fetch('mark_delivered.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id: orderId })
    })
    .then(function(response) {
      // Handle the response from the server if needed
      console.log(response);
      // Reload the page or update the order list
      location.reload();
    })
    .catch(function(error) {
      // Handle any error during the request
      console.error(error);
    });
  }
}
</script>


</body>
</html>