<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
    header('location:admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Profile</title>
        <link rel="stylesheet" href="register.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>
    <body>

      <!--admin profile-->

        <h1 class="title"> <span>Admin</span> Profile Page</h1>

        <section class="profile-container">
            <?php 
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id= ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>

            <div class="profile">
                <img src="images/<?= $fetch_profile['image']; ?>" alt="">
                <h3><?= $fetch_profile['name']; ?></h3>
                <a href="admin_profile_update.php" class="btn">Update Profile</a>
                <a href="admin.php" class="btn">Home page</a>
                <a href="logout.php" class="delete-btn">Logout</a>
                <div class="flex-btn">
                    <a href="login.php" class="option-btn">Login</a>
                    <a href="register.php" class="option-btn">Register</a>
                </div>
            </div>
            
        </section>
    </body>
</html>