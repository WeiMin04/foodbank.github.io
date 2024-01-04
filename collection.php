<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "collection";

$connection = new mysqli($servername, $username, $password, $database);

$name = "";
$email = "";
$phone = "";
$address = "";
$pickup_date = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $pickup_date = $_POST["pickup_date"];

    do {
        if ( empty($name) || empty($email) || empty($phone) || empty($address) || empty($pickup_date) ) {
            echo '<script type=text/javascript> alert("All fields must be requried") </script>';
            break;
        }

        $sql = "INSERT INTO request (name, email, phone, address, pickup_date) " . 
               "VALUES ('$name', '$email', '$phone', '$address', '$pickup_date')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $name = "";
        $email = "";
        $phone = "";
        $address = "";
        $pickup_date = "";

        echo '<script type=text/javascript> alert("Collection Request Sent Successfully") </script>';

       

    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FoodBank</title>
        <link rel="stylesheet" href="collection.css">
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

    <!-- form -->
    <div class="wrapper">
        <div class="title">
            Collection Form
        </div>

        <form method="POST">
            <div class="form">
                <div class="input_field">
                    <label>Name</label>
                    <input type="text" class="input" name="name">
                </div>
                <div class="input_field">
                    <label>Email</label>
                    <input type="text" class="input" name="email">
                </div>
                <div class="input_field">
                    <label>Phone Number</label>
                    <input type="text" class="input" name="phone"> 
                </div>
                <div class="input_field">
                    <label>Address</label>
                    <input type="text" class="input" name="address">
                </div>
                <div class="input_field">
                    <label>Pickup Date</label>
                    <input type="datetime-local" class="input" name="pickup_date">
                </div>
                <div class="input_field">
                    <input type="submit" name="submit" value="Submit" class="submit-btn">
                </div>
            </div>
        </form>
    </div>

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
      