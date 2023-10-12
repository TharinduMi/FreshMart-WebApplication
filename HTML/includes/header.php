<header>
    <nav >
      <div class="navbar">
        <div class="logo"><a href="Home.php"><img src="../Image/Common/logo.png"></a></div>
        <ul class="menu">
          <li><a href="Home.php">Home</a></li>
          <li><a href="Home.php">Categories</a></li>
          <li><a href="#" onclick="scrollToSection()">Contact</a></li>
          <li><a href="">Feedback</a></li>
        </ul>
      </div>
      </div>


      <div class="buttons">

        <?php
          if (!isset($_SESSION['email'])) {
            echo '<a href="login.php"><button id="btn">Log In</button></a>';
          } else {
            
            echo '<a href="../php/logout.php"><button id="btn">Log out</button></a>';
          }
          ?>    


        <?php
              if(!isset($_SESSION['email'])){
          
                echo '<a href="signup.php"><button id="btn">Signup</button></a>';
              }
              else{
                echo '<a href="profile/profile.php"><button id="btn">Profile</button></a>';
              }
            ?>          
        
        
      <?php
              if(!isset($_SESSION['email'])){
                echo ' ';
              }
              else{
                echo '<a href="cart.php"><button id="btn"><img src="../Image/Common/cart.png" height="25px" width="35px"></button></a>';
              }
            ?>    

            
        

      </div>
    </nav>
    </nav>
  
    
  </header>