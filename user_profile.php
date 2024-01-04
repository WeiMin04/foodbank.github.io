<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>
        <link rel="stylesheet" href="register.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>
    <body>

    <!-- navbar -->
    <nav>
        <h2 class="logo"><a href="user_page.php">FoodBank</a></h2>
        <ul>
          <li><a href="user_page.php">Home</a></li>
          <li><a href="user_collection.php">Collection</a></li>
          <li><a href="user_donation.php">Donation</a></li>
          <li><a href="user_contact_us.php">Contact Us</a></li>
        </ul>
        <a href="user_profile.php"><i class="fa-solid fa-user"></i></a>
      </nav>

      <!--user profile-->

        <h1 class="title"> <span>User</span>Profile Page</h1>

        <section class="profile-container">
            <?php 
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id= ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>

            <div class="profile">
                <img src="images/<?= $fetch_profile['image']; ?>" alt="">
                <h3><?= $fetch_profile['name']; ?></h3>
                <a href="user_profile_update.php" class="btn">Update Profile</a>
                <a href="user_page.php" class="btn">Home page</a>
                <a href="logout.php" class="delete-btn">Logout</a>
                <div class="flex-btn">
                    <a href="login.php" class="option-btn">Login</a>
                    <a href="register.php" class="option-btn">Register</a>
                </div>
            </div>
            
        </section>

             <!-- footer -->

      <footer class="footer-distributed">
        <div class="footer-left">
        <h3>Food<span>Bank</span></h3>

        <ul class="footer-links">
          <li><a href="user_page.php">Home</a></li>
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

  