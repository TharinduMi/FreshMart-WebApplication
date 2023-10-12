<?php
session_start();
?>

<!DOCTYPE html>

  <head>
       <title> User Profile</title>
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
if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
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

    // Query the database to retrieve user data
    $query = "SELECT First_Name, Last_Name, Birthday, `E_mail`, Address_Line1, Address_Line2, Phone_Number FROM signup WHERE `E_mail` = '$username'";
    $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if ($result) {
        // Fetch the row from the result set
        $row = mysqli_fetch_assoc($result);

        
        echo "<center><h1> Profile Details</h1></center> <br>";
        // Display the user data

        // Assuming $row contains the user information fetched from the database
        echo "<center>";
        echo "<table>";
        echo "<tr><td>First Name:</td><td>" . $row["First_Name"] . "</td></tr>";
        echo "<tr><td>Last Name:</td><td>" . $row["Last_Name"] . "</td></tr>";
        echo "<tr><td>Birthday:</td><td>" . $row["Birthday"] . "</td></tr>";
        echo "<tr><td>E-mail:</td><td>" . $row["E_mail"] . "</td></tr>";
        echo "<tr><td>Address Line 1:</td><td>" . $row["Address_Line1"] . "</td></tr>";
        echo "<tr><td>Address Line 2:</td><td>" . $row["Address_Line2"] . "</td></tr>";
        echo "<tr><td>Phone Number:</td><td>" . $row["Phone_Number"] . "</td></tr>";
        echo "</table>";
        echo "</center>";
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




      </nav>
      </nav>






</body>
</html>