<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: Admin.php');
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['email'];
    $password = $_POST['password'];

    // Check the credentials (you should replace these with your own authentication logic)
    if ($username === 'admin' && $password === 'pass') {
        // Authentication successful, set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        // Redirect to the dashboard
        header('Location: Admin.php');
        exit;
    } else {
        // Authentication failed, display an error message
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
  body {
    background-image: url('../../Image/signlog/adminlog.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
  }
  .container{
        position: relative;
        top: 100px;
        left: 400px;
        max-width: 500px;
        width: 100%;
        background: transparent;
        padding: 40px 30px;
        box-shadow: 0 10px 10px rgba(253, 253, 253, 2.801);
        perspective: 2700px;
      }
    
     
      
      
       .form .title{
        position: relative;
        font-size: 25px;
        font-weight: 500;
        color: #ffffff;
      }
       .form .title:before{
        content: '';
        position: absolute;
        left: 188px;
        bottom: 0;
        height: 3px;
        width: 30px;
        background: linear-gradient(135deg, #f3ebef, #816bbb);;
      }
    
       .form .input-boxes{
        margin-top: 30px;
      }
       .form .input-box{
        display: flex;
        align-items: center;
        height: 50px;
        width: 100%;
        margin: 10px 0;
        position: relative;
      }
      .form .input-box input{
        height: 100%;
        width: 100%;
        outline: none;
        border: none;
        padding: 0 30px;
        font-size: 16px;
        font-weight: 500;
        border-bottom: 2px solid rgba(0,0,0,0.2);
        transition: all 0.3s ease;
      }
      .form .input-box input:focus,
      .form .input-box input:valid{
        border-color: #7d2ae8;
      }
      .form .input-box i{
        position: absolute;
        color: #7d2ae8;
        font-size: 17px;
      }
       .form .text{
        font-size: 14px;
        font-weight: 500;
        color: #ffffff;
    
      }
       .form .text a{
        text-decoration: underline;
        color: #ff0000;
      }
       .form .text a:hover{
        text-decoration-color: #ffffff;
      }
       .form .button{
        color: #fff;
        margin-top: 40px;
      }
       .form .button input{
        color: #fff;
        background: #7d2ae8;
        border-radius: 6px;
        padding: 0;
        cursor: pointer;
        transition: all 0.4s ease;
      }
       .form .button input:hover{
        background: #5b13b9;
      }
       .form label{
        color: #5b13b9;
        cursor: pointer;
      }
       .form label:hover{
        text-decoration: underline;
      }
      .form .login{
            left: 50px;

      }
       .form .login-text{
        text-align: center;
        margin-top: 25px;
      }
      .container #flip{
        display: none;
      }
      @media (max-width: 730px) {
        .container .cover{
          display: none;
        }
        .form .login{
          width: 100%;
        }

      }
    </style>
</head>
<body>
    <div class="container">
        <div class="form">
            <form method="POST" action="">
                <div class="login">
                    <div class="title"><center>Admin Login</center></div>
                    <div class="input-boxes">
                        <div class="input-box">
                            <input type="text" placeholder="Enter your email" required name="email">
                        </div>
                        <div class="input-box">
                            <input type="password" placeholder="Enter your password" required name="password">
                        </div>
                        <div class="button input-box">
                            <input type="submit" value="Submit" name="login">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>