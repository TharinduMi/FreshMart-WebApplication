<?php
// Assuming you have a database connection established

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'id' parameter is present
    if (isset($_POST['id'])) {
        $orderId = $_POST['id'];

        // Update the order as delivered in the database
        $updateQuery = mysqli_query($conn, "UPDATE `order` SET delivered = 1 WHERE id = '$orderId'");

        if ($updateQuery) {
            echo "Order marked as delivered.";
        } else {
            echo "Failed to mark the order as delivered.";
        }
    } else {
        echo "Invalid request.";
    }
}
?>
