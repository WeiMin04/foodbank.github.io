<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "collection";

$connection = new mysqli($servername, $username, $password, $database);

$name = "";
$email = "";
$message = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
 
    do {
        if ( empty($name) || empty($email) || empty($message)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "INSERT INTO contact (name, email, message) " . 
               "VALUES ('$name', '$email', '$message')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $name = "";
        $email = "";
        $message = "";

        $successMessage = "Message sent successfully";

        header("location: contact_us.php");
        exit;

    } while (false);
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact Us</title>
        <link rel="stylesheet" href="contact_us.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
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

    <!-- contact us -->
    <section class="contact">
        <div class="content">
            <h2>Contact Us</h2>
            <p>If you have any questions, feel free to contact us.</p>
        </div>

        <div class="container">
            <div class="contactInfo">
                <div class="box">
                    <div class="icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div class="text">
                        <h3>Address</h3>
                        <p>Cheras, Malaysia</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fa-solid fa-phone"></i></div>
                    <div class="text">
                        <h3>Phone</h3>
                        <p>+60123456789</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fa-solid fa-envelope"></i></div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>xyz@gmail.com</p>
                    </div>
                </div>
            </div>

            <div class="contactForm">
                <form method="POST">
                    <h2>Send Us a Message!</h2>
                    <div class="inputBox">
                        <input type="text" name="name"required="required">
                        <span>Full Name</span>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="email"required="required">
                        <span>Email</span>
                    </div>
                    <div class="inputBox">
                        <textarea required="required" name="message"></textarea>
                        <span>Please type your message here...</span>
                    </div>
                    <div class="inputBox">
                        <input type="submit" name="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
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

    