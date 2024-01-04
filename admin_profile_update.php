<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
    header('location:login.php');
}

if(isset($_POST['update'])) {
  $name = $_POST['name'];
  $name = filter_var($name);
  $email = $_POST['email'];
  $email= filter_var($email);
  
  $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
  $update_profile->execute([$name, $email, $admin_id]);
   
  $old_image = $_POST['old_image'];
  $image = $_FILES['image']['name'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_size = $_FILES['image']['size'];
  $image_folder = 'images/'.$image;

  if(!empty($image)) {
    if($image_size > 2000000) {
      $message[] = 'Image size is too large';
    }else{
      $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
      $update_image->execute([$image, $admin_id]);

      if($update_image) {
        move_uploaded_file($image_tmp_name, $image_folder);
        unlink('images/'.$old_image);
        $message[] = 'Image has been updated';
      }
    }
  }
  
  $old_pass = $_POST['old_pass'];
  $previous_pass = $_POST['previous_pass'];
  $new_pass = $_POST['new_pass'];
  $confirm_pass = $_POST['confirm_pass'];

  if(!empty($previous_pass) || !empty($new_pass) || !empty($confirm_pass)) {
    if($previous_pass != $old_pass) {
      $message[] = 'Old Password not Matched!';
    }elseif($new_pass != $confirm_pass) {
      $message[] = 'Confirm Password not Matched!';
    }else{
      $update_password = $conn->prepare("UPDATE `users` SET password = ? WHERE id =?");
      $update_password->execute([$confirm_pass, $admin_id]);
      $message[] = "Password has been Updated!";
    }
  }
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

      <!--user profile-->
        
        <h1 class="title"> <span>Admin</span> Profile Update</h1>

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

        <section class="update-profile-container">
        <?php 
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id= ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <img src="images/<?= $fetch_profile['image']; ?>"  alt="">
            <div class="flex">
                <div class="inputBox">
                    <span>Username: </span>
                    <input type="text" name="name" required class="box" placeholder="Enter Your Name" value="<?=$fetch_profile['name']; ?>">
                    <span>Email: </span>
                    <input type="email" name="email" required class="box" placeholder="Enter Your Email" value="<?=$fetch_profile['email']; ?>">
                    <span>Profile Pic:</span>
                    <input type="hidden" name="old_image" value="<?= $fetch_profile['image'] ?>">
                    <input type="file" name="image" required class="box" accept="image/jpg, image/jpeg, image/png">
                </div>
                <div class="inputBox">
                    <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
                    <span>Old Password:</span>
                    <input type="password" name="previous_pass" class="box" placeholder="Enter your Previous Password">
                    <span>New Password:</span>
                    <input type="password" class="box" name="new_pass" placeholder="Enter your New Password">
                    <span>Confirm Password:</span>
                    <input type="password" class="box" name="confirm_pass" placeholder="Confirm New Password">
                </div>
            </div>
            <div class="flex-btn">
                <input type="submit" value="Update Profile" name="update" class="btn">
                <a href="admin_profile.php" class="option-btn">Go Back</a>
            </div>
        </form>
            
        </section>

    </body>
</html>