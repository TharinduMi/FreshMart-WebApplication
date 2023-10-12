<?php
session_start();
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

    // Retrieve updated profile data from the form
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $birthday = $_POST["birthday"];
    $email = $_POST["email"];
    $address_line1 = $_POST["address_line1"];
    $address_line2 = $_POST["address_line2"];
    $phone_number = $_POST["phone_number"];

    // Update the user's profile in the database
    $updateQuery = "UPDATE signup SET First_Name='$first_name', Last_Name='$last_name', Birthday='$birthday', Address_Line1='$address_line1', Address_Line2='$address_line2', Phone_Number='$phone_number' WHERE `E_mail`='$email'";
    $updateResult = mysqli_query($connection, $updateQuery);

    if ($updateResult) {
        $message[] = "Profile updated successfully.";
        header('location:Profile.php');

    } else {
        echo "Error updating profile: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    echo "User is not logged in";
}
?>