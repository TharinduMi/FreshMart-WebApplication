<?php

// Define database connection variables
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

if (isset($_POST["submit"])) {
    // Retrieve form data
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $bdy = $_POST["bdy"];
    $email = $_POST["email"];
    $line1 = $_POST["line1"];
    $line2 = $_POST["line2"];
    $mobile = $_POST["mobile"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // Check if required fields are empty
    if (empty($fname) || empty($lname) || empty($bdy) || empty($email) || empty($line1) || empty($line2) || empty($mobile) || empty($password) || empty($cpassword)) {
        echo "<script>alert('Please Complete Sign-up Details');</script>";
        header("Location:../html/signup.php");

        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid E-mail Format');</script>";
        header("Location:../html/signup.php");
        exit;
    }

    // Check if passwords match
    if ($password !== $cpassword) {       
        echo "<script>alert('Passwords do not match');</script>";
        header("Location:../html/signup.php");
        exit;
    }

    // Check if user is already signed up
    $checkQuery = "SELECT * FROM signup WHERE E_mail = '$email'";
    $result = mysqli_query($conn, $checkQuery);
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<script>alert('Already Have an account? Please Login');</script>";
        header("Location:../html/signup.php");
        exit;
    }

    // Insert the data into the database
    $sql = "INSERT INTO signup (First_Name, Last_Name, Birthday, E_mail, Address_Line1, Address_Line2, Phone_Number, Password, cpassword) VALUES ('$fname', '$lname', '$bdy', '$email', '$line1', '$line2', '$mobile', '$password', '$cpassword')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to the login page
        header("Location:../html/login.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}

?>

