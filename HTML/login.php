<?php

session_start();

@include 'config.php';


// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["login"])) {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and sanitize input (add your own validation rules as needed)

    // Check if required fields are empty
    if (empty($email) || empty($password)) {
        echo "All fields are required";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Check if the user exists in the database
    $query = "SELECT * FROM signup WHERE E_mail = '$email' AND Password = '$password'";
    $result = mysqli_query($conn, $query);




    if ($result && mysqli_num_rows($result) > 0) {
      session_start();
      $_SESSION['email']=$_POST["email"];
        // User exists and credentials are correct
        // Redirect to the dashboard or desired page
        header("Location:../HTML/home.php");
      
    
        



        exit;
    } else {
        // User does not exist or credentials are incorrect
    
        echo "<script>alert('Cheeck Email or Username');</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}

?>




<!DOCTYPE html>
<html>
    <title>Welcome To Fresh Mart Super</title>
    <head>
        <link rel="stylesheet" type="text/css" href="../CSS/login.css">
    </head>
<body>

  <header>
    <nav>
      <div class="navbar">
        <div class="logo"><a href="home.php"><img src="../Image/Common/logo.png"></a></div>
        <ul class="menu">
          <li><a href="home.php">Home</a></li>
          <li><a href="home.php">Categories</a></li>
          <li><a href="">Contact</a></li>
          <li><a href="">Feedback</a></li>
        </ul>
      </div>
      </div>

      <div class="buttons">
        <a href="Signup.php"> <button id="btn">Sign in</button></a>
      </div>

    </nav>
    </nav>
    </header>

<br/><br/><br/><br/><br/>

    <div class="container">
       
            <div class="form">
              <form action="../php/login.php" method="POST">
              <div class="login">
                <div class="title"><center>Login</center></div>
              
                <div class="input-boxes">
                  <div class="input-box">
                    <input type="text" placeholder="Enter your email" required name="email">
                  </div>
                  <div class="input-box">
                    <input type="password" placeholder="Enter your password" required name="password">
                  </div>
                  <div class="text"><a href="#">Forgot password?</a></div>
                  <div class="button input-box">
                    <input type="submit" value="Sumbit" name="login">
                  </div>
                  <div class="text sign_up_text">Don't have an account? <a href="signup.html">Signup now</a></div>
                </div>
              </form>
            
          </div>
        </div>
        </div>
      </div>


<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>


<?php
include '../html/includes/footer.php'
?>
    </body>