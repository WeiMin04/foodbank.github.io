<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "collection";

$connection = mysqli_connect($servername, $username, $password, $database);

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $image = $_FILES['image'];
    $img_loc = $_FILES['image']['tmp_name'];
    $img_name = $_FILES['image']['name'];
    $img_des = "images/".$img_name;
    move_uploaded_file($img_loc, 'images/'.$img_name);

    mysqli_query($connection,"INSERT INTO `foodbank` (`image`,`name`,`phone`,`address`) VALUES ('$img_des','$name','$phone','$address')");

}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Foodbank</title>
        <link rel="stylesheet" href="admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
       
       
    </head>
    <body>

        <!--sidebar -->
        <div class="header">
            <div class="side-nav">
                <div class="logo">Welcome, Admin</div>
                <ul class="nav-links">
                    <li><a href="admin.php"><i class="fa-solid fa-list"></i>Collections</a></li>
                    <li><a href="admin_foodbank.php"><i class="fa-solid fa-list"></i>FoodBanks</a></li>
                    <li><a href="admin_donation.php"><i class="fa-solid fa-money-bill"></i>Donations</a></li>
                    <li><a href="admin_profile.php"><i class="fa-solid fa-user"></i>Profile</a></li>
                    <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
                    <div class="active"></div>
                </ul>
            </div>
        </div>

        <!-- content -->
        <section>
        <h2>Foodbank List</h2>
        <a href='admin_foodbank_add.php?id=$row[id]'>Add Foodbank</a> <a href="admin_foodbank_search.php">Search</a>
        <form action="" method="POST" enctype="multipart/form-data">
        <table class="content-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "collection";
              
            $connection = mysqli_connect($servername, $username, $password, $database);

            $pic = mysqli_query($connection, "SELECT * FROM `foodbank`");
            while($row = mysqli_fetch_array($pic)) {
              echo "
              <tr>
                <td>$row[id]</td>
                <td><img src='$row[image]'></td>
                <td>$row[name]</td>
                <td>$row[phone]</td>
                <td>$row[address]</td>
                <td>
                <a href='admin_foodbank_edit.php?id=$row[id]'>Edit</a>
                <a href='admin_foodbank_delete.php?id=$row[id]'>Delete</a>
                </td>
              </tr>
              ";
            }
          ?>
          </tbody>
          </table>
          </form>
          </section>
    </body>
</html>