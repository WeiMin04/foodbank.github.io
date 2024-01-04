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
    print_r($_FILES['image']);
    $img_loc = $_FILES['image']['tmp_name'];
    $img_name = $_FILES['image']['name'];
    $img_des = "images/".$img_name;
    move_uploaded_file($img_loc, 'images/'.$img_name);

    mysqli_query($connection,"INSERT INTO `foodbank` (`image`,`name`,`phone`,`address`) VALUES ('$img_des','$name','$phone','$address')");
    header("location:admin_foodbank.php");

}
?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Foodbank</title>
        <link rel="stylesheet" href="admin_add.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <!-- content -->
        <div class="wrapper">
            <div class="title">
                Add Foodbank
            </div>

            <form action="admin_foodbank.php" method="POST" enctype="multipart/form-data">
                <div class="form">
                    <div class="input_field">
                        <label>Image</label>
                        <input type="file" class="input" name="image">
                    </div>
                    <div class="input_field">
                        <label>Name</label>
                        <input type="text" class="input" name="name">
                    </div>
                    <div class="input_field">
                        <label>Phone</label>
                        <input type="text" class="input" name="phone">
                    </div>
                    <div class="input_field">
                        <label>Address</label>
                        <input type="text" class="input" name="address">
                    </div>
                    <div class="inputfield">
                        <input type="submit" name="submit" class="btn" value="Add Foodbank"><a href="admin_foodbank.php" type="submit" class="btn">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>