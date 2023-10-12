<!DOCTYPE html>
<html>
<head>
    <title>Register Here</title>
    <link rel="stylesheet" type="text/css" href="../CSS/sign.css">
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
            <div class="buttons">
                <a href="login.html">
                    <button id="btn">Log in</button>
                </a>
            </div>
        </nav>
    </header>
    <br/>
    <div class="bg">
        <div class="container">
            <div class="title">Sign Up</div>
            <br>
            <div class="form">
                <form action="../php/signup.php" method="POST">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">First Name:</span>
                            <input type="text" placeholder="Enter First name Here" required name="fname">
                        </div>
                        <div class="input-box">
                            <span class="details">Last Name:</span>
                            <input type="text" placeholder="Enter your Last Name Here" required name="lname">
                        </div>
                        <div class="input-box">
                            <span class="details">Birthday:</span>
                            <input type="date" required name="bdy">
                        </div>
                      
                        <div class="input-box">
                            <span class="details">Email:</span>
                            <input type="email" placeholder="Enter your email" required name="email">
                        </div>
                        <div class="input-box">
                            <span class="details">Address:</span>
                            <input type="text" placeholder="Enter Address Line 01" required name="line1">
                            <input type="text" placeholder="Enter Address Line 02" required name="line2">
                        </div>
                        <div class="input-box">
                            <span class="details">Phone Number:</span>
                            <input type="integer" placeholder="Enter your number" required name="mobile">
                        </div>
                        <div class="input-box">
                            <span class="details">Password</span>
                            <input type="password" placeholder="Enter your password" required name="password">
                        </div>
                        <div class="input-box">
                            <span class="details">Confirm Password</span>
                            <input type="password" placeholder="Confirm your password" required name="cpassword">
                        </div>
                    </div>
                    <div class="button">
                        <input type="submit" value="submit" name="submit">
                    </div>
                </form>
            </div>
        </div>
   <br><br><br><br><br><br><br>
    </div>

    <?php     
    include 'includes/footer.php'
    ?>
    
</body>
</html>
