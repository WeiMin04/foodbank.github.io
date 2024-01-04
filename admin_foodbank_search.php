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
        <a href='admin_foodbank_add.php?id=$row[id]'>Add Foodbank</a>
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="box">
        <input type="text" name="search" placeholder="Search data">
        <button class="btn" name="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <table class="content-table">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "collection";

        $connection = new mysqli($servername, $username, $password, $database);
        $search="";
        
        if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
        }

        if(isset($_POST['submit'])) {
        $search=$_POST['search'];
        }

        $sql = ($search=="") ? "SELECT * FROM `foodbank`" : "SELECT * FROM `foodbank` WHERE id LIKE '%$search%' or name LIKE '%$search%' ";
        $result=mysqli_query($connection,$sql);

        if($result) {
            if(mysqli_num_rows($result)>0) {
                echo '<thead>
                <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
                ';

                while($row=mysqli_fetch_assoc($result)) {
                echo '<tbody>
                <tr>
                <td>'.$row['id'].'</td>
                <td><img src='.$row['image'].' "alt=Foodbank Image"/></td>
                <td>'.$row['name'].'</td>
                <td>'.$row['phone'].'</td>
                <td>'.$row['address'].'</td>
                <td>
                <a href="admin_foodbank_edit.php?id='.$row['id'].'">Edit</a>
                <a href="admin_foodbank_delete.php?id='.$row['id'].'">Delete</a>
                </td>
                </tr>
                ';
                }

            }else{
                echo '<script type=text/javascript> alert("Data Not Found") </script>';
            }
        }
        ?>
        </tbody>
        </table>
        </form>
        </section>
    </body>
</html>