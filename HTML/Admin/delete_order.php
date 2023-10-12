<?php
// Assuming you have a database connection established

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'id' parameter is present
    if (isset($_POST['id'])) {
        $orderId = $_POST['id'];

        if(isset($_POST['remove'])){ 
            $remove_id = $_GET['remove'];
     mysqli_query($conn, "DELETE FROM `order` WHERE id = '$order_id'");

  };


        if ($deleteQuery) {
            echo "Order deleted successfully.";
        } else {
            echo "Failed to delete the order.";
        }
    } else {
        echo "Invalid request.";
    }
}
?>
