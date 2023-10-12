<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <link rel="stylesheet" href="../../CSS/profile.css">
</head>
<body>
<?php
include 'includes/sidebar.html';
include 'includes/header.html';
?>

<div class="container">
    <?php
    // Check if the user is logged in
    if (isset($_SESSION["email"]) && $_SESSION["login"] === true) {
        // Retrieve user data from the session
        $username = $_SESSION["email"];

        // Create a database connection
        $servername = "localhost";
        $dbusername = "root";
        $password = "";
        $dbname = "freshmartdb";

        // Create a new database connection
        $connection = mysqli_connect($servername, $dbusername, $password, $dbname);

        // Check if the connection was successful
        if (!$connection) {
            die("Failed to connect to the database: " . mysqli_connect_error());
        }

        // Query the database to retrieve order data
        $query = "SELECT * FROM `order` WHERE email = '$username'";
        $result = mysqli_query($connection, $query);

        // Check if the query was successful
        if ($result) {
            // Display the order details in a table
            echo "<center><h1>Order Details</h1></center>";
            echo "<br>";
            echo "<table>";
            echo "<tr>
                    <th>Name</th>
                    <th>Address Line 1</th>
                    <th>Address Line 2</th>
                    <th>Number</th>
                    <th>Product</th>
                    <th>Total Price</th>
                    <th>Method</th>

                </tr>";

            // Loop through each row of the result set
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";                
                echo "<td>" . $row["address1"] . "</td>";
                echo "<td>" . $row["address2"] . "</td>";
                echo "<td>" . $row["number"] . "</td>";
                echo "<td>" . $row["product"] . "</td>";
                echo "<td>" . $row["total_price"] . "</td>";
                echo "<td>" . $row["method"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Error: " . mysqli_error($connection);
        }

        // Close the database connection
        mysqli_close($connection);
    } else {
        echo "User is not logged in";
    }
    ?>
</div>

</body>
</html>