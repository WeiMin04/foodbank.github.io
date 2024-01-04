<?php 
include 'config.php';
session_start();

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select->execute([$email, $pass]);
    $row = $select->fetch(PDO::FETCH_ASSOC) ;

    if($select->rowCount() > 0){

        if($row['user_type'] == 'admin') {
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_profile.php');

        }elseif($row['user_type'] == 'user') {
            $_SESSION['user_id'] = $row['id'];
            header('location:user_profile.php');
 
        }else{
        $message[] = 'No User Found!';
        }

    }else{
        $message[] = 'Incorrent Email or Password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="register.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>

    <body>

    <!-- navbar -->
    <nav>
        <h2 class="logo"><a href="home.php">FoodBank</a></h2>
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="collection.php">Collection</a></li>
          <li><a href="donation.php">Donation</a></li>
          <li><a href="contact_us.php">Contact Us</a></li>
        </ul>
        <button type="button"><a href="register.php">Register</a></button>
      </nav>

        <!--form-->

        
            <section class="form-container">
            <form action="" method="POST" enctype="multipart/form-data">
                <h3>Login Now</h3>
                <input type="email" required placeholder="Enter your Email" class="box" name="email">
                <input type="password" required placeholder="Enter your Password" class="box" name="pass">
               
                <?php
                if (isset($message)) {
                    foreach($message as $message) {
                    echo'
                    <div class="message">
                    <span>'.$message.'</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                    </div>
                    ';
                    }
                } 
                ?>

                <p>Don't have an Account? <a href="register.php">Register Now</a></p>
                <input type="submit" value="Login Now" class="btn" name="submit">
            </form>
        </section>

          <!-- footer -->

      <footer class="footer-distributed">
        <div class="footer-left">
        <h3>Food<span>Bank</span></h3>

        <ul class="footer-links">
          <li><a href="home.php">Home</a></li>
          <li><a href="collection.php">Collection</a></li>
          <li><a href="donation.php">Donation</a></li>
          <li><a href="contact_us.php">Contact Us</a></li>
        </ul>

        <p class="footer-company-name">Copyright © 2023 <strong>FoodBank</strong> All rights reserved</p>
        </div>

      <div class="footer-center">
      <h3>Contact Us</h3>
      <div>
      <i class="fa-solid fa-location-dot"></i>
        <p><span>Cheras</span>
            Malaysia</p>
      </div>
      <div>
      <i class="fa-solid fa-phone"></i>
        <p>+60123456789</p>
      </div>
      <div>
      <i class="fa-solid fa-envelope"></i>
        <p>xyz@gmail.com</p>
      </div>
      </div>
        <div class="footer-right">
      <p class="footer-company-about">
        <span>About the company</span>
        <strong>FoodBank</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sit amet lacus neque. Nullam tincidunt dignissim nibh, a vulputate leo venenatis vitae. Nulla ornare neque metus, ut molestie odio egestas nec. Donec pulvinar eget elit finibus bibendum. Mauris volutpat rutrum tristique. Suspendisse sagittis nulla ut neque feugiat pellentesque. Curabitur porta rutrum tempus. Proin urna sapien, iaculis non bibendum non, consectetur eu urna.
      </p>
      <div class="footer-icons">
        <a href="#"><i class="fa-brands fa-facebook"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-twitter"></i></a>
        <a href="#"><i class="fa-brands fa-pinterest"></i></a>
      </div>
    </div>
    </footer>
    </body>
</html>