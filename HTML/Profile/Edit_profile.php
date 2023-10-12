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
        
        echo "<center><h1>Edit Profile Details</h1></center><br>";
        echo "<center>";
        echo "<table>";
        echo "<form action='update_profile.php' method='POST'>"; // Specify the action file for updating the profile
        
        echo "<tr><td>First Name:</td><td><input type='text' name='first_name' value='" . $row["First_Name"] . "'></td></tr>";
        echo "<tr><td>Last Name:</td><td><input type='text' name='last_name' value='" . $row["Last_Name"] . "'></td></tr>";
        echo "<tr><td>Birthday:</td><td><input type='text' name='birthday' value='" . $row["Birthday"] . "'></td></tr>";
        echo "<tr><td>E-mail:</td><td><input type='text' name='email' value='" . $row["E_mail"] . "'></td></tr>";
        echo "<tr><td>Address Line 1:</td><td><input type='text' name='address_line1' value='" . $row["Address_Line1"] . "'></td></tr>";
        echo "<tr><td>Address Line 2:</td><td><input type='text' name='address_line2' value='" . $row["Address_Line2"] . "'></td></tr>";
        echo "<tr><td>Phone Number:</td><td><input type='text' name='phone_number' value='" . $row["Phone_Number"] . "'></td></tr>";

        echo "<tr><td colspan='2'><input type='submit' value='Save'></td></tr>";
        
        echo "</form>";
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