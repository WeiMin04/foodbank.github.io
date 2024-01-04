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
$card_name = "";
$card_number = "";
$amount = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $card_name = $_POST["card_name"];
    $card_number = $_POST["card_number"];
    $amount = $_POST["amount"];

    do {
        if ( empty($name) || empty($email) || empty($phone) || empty($address) || empty($card_name) || empty($card_number) || empty($amount)) {
            echo '<script type=text/javascript> alert("All fields must be requried") </script>';
            break;
        }

        $sql = "INSERT INTO donation (name, email, phone, address, card_name, card_number, amount) " . 
               "VALUES ('$name', '$email', '$phone', '$address', '$card_name', '$card_number', '$amount')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $name = "";
        $email = "";
        $phone = "";
        $address = "";
        $card_name = "";
        $card_number = "";
        $amount = "";

        echo '<script type=text/javascript> alert("Donation Sent Successfully") </script>';

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Donation</title>
        <link rel="stylesheet" href="donation.css">
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

      <!--content -->
      <div class="container">
        <form method="POST">
        <div class="row">
            <div class="col">
                <h3 class="title">Donation</h3>

                <div class="inputBox">
                    <span>Full Name :</span>
                    <input type="text" name="name">
                </div>
                <div class="inputBox">
                    <span>Email :</span>
                    <input type="text" name="email">
                </div>
                <div class="inputBox">
                    <span>Phone :</span>
                    <input type="text" name="phone">
                </div>
                <div class="inputBox">
                    <span>Address :</span>
                    <input type="text" name="address">
                </div>
            </div>

            <div class="col">
                <div class="inputBox">
                    <span>Cards accepted :</span>
                    <img src="images/card accepted.jpg" alt="">
                </div>
                <div class="inputBox">
                    <span>Name on Card :</span>
                    <input type="text" name="card_name">
                </div>
                <div class="inputBox">
                    <span>Credit Card Number :</span>
                    <input type="text" name="card_number">
                </div>
                <div class="inputBox">
                    <span>Amount :</span>
                    <input type="text" name="amount">
                </div>
            </div>
        </div>

 
        <input type="submit" name="submit" value="Donate Now" class="donate-btn">
        </form>
      </div>
    

       <!-- footer -->

       <footer class="footer-distributed">
        <div class="footer-left">
        <h3>Food<span>Bank</span></h3>

        <ul class="footer-links">
          <li><a href="user_page.php">Home</a></li>
          <li><a href="user_collection.php">Collection</a></li>
          <li><a href="user_donation.php">Donation</a></li>
          <li><a href="user_contact_us.php">Contact Us</a></li>
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