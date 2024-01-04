<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FoodBank</title>
        <link rel="stylesheet" href="style.css">
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
 
    <!-- header -->

    <div class="heading">
      <h1>About Us</h1>
      <p>By using our website, you can find foodbank that is around your area. Additionally, you can donate funds to foodbank or 
        request a food collection with the help of our driver. Furthermore, you can volunteer as a driver to help us out. Thank you for doing your part
        to help people who are in need of help. 
      </p>
    </div>

    <!--foodbank-->

    <form action="" method="POST" enctype="multipart/form-data">
    <div class="box">
    <h1>List of Foodbank</h1>
        <form method="POST" enctype="multipart/form-data">
        <div class="searchbar">
        <input type="text" class="bar" name="submit" placeholder="Search....">
        <i class="fa-solid fa-magnifying-glass"></i></div>
        </div>
        
    </div>
        
    </div>

    <div class="foodbank-box">
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "collection";

        $connection = mysqli_connect($servername, $username, $password, $database);
        $search="";
        
        if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
        }

        if(isset($_POST['submit'])) {
        $search=$_POST['submit'];
        }

        $sql = ($search=="") ? "SELECT * FROM `foodbank`" : "SELECT * FROM `foodbank` WHERE id LIKE '%$search%' or name LIKE '%$search%' ";
        $result=mysqli_query($connection,$sql);

        if($result) {
            if(mysqli_num_rows($result)>0) {
                while($row=mysqli_fetch_array($result)) {
                echo '<div class="foodbank-card">
                <img src="' . $row['image'] . '" alt="Foodbank Image"/>
                <p>'.$row['name'].'</p>
                <p>'.$row['phone'].'</p>
                <p>'.$row['address'].'</p>
                </div>
                ';
                }

            }else{
                echo '<script type=text/javascript> alert("Data Not Found") </script>';
            }
        }

        ?>
    </div>
    </form>

     <!-- service -->

     <div class="container">
        <div class="center">
            <h1>Our Services</h1>
            <div class="our-service-text">Feel free to check out our services.
            </div>
        </div>
        <div class="cards">

            <div class="card">
                <img src="images/food donation.jpg" alt="food donation">
                <h3 class="card-name">Food Collection</h3>
                <p class="card-text">Request for food collection and our driver will send it to foodbank.</p>
                <a href="collection.php" class="btn">Request</a>
            </div>

            <div class="card">
                <img src="images/fund donation.png" alt="fund donation">
                <h3 class="card-name">Fund Donation</h3>
                <p class="card-text">The donation made will be send to foodbanks.</p>
                <a href="donation.php" class="btn">Donate</a>
            </div>

            <div class="card">
                <img src="images/food driver.jpg" alt="food driver">
                <h3 class="card-name">Food Driver</h3>
                <p class="card-text">Volunteer and become a food driver to help deliver.</p>
                <a href="contact_us.php" class="btn">Volunteer</a>
            </div>
        </div>
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