<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "collection";

$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";
$card_name = "";
$card_number = "";
$amount = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header ("location: admin_donation.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM donation WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: admin_donation.php");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
    $card_name = $row["card_name"];
    $card_number = $row["card_number"];
    $amount = $row["amount"];
}

else { 
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $card_name = $_POST["card_name"];
    $card_number = $_POST["card_number"];
    $amount = $_POST["amount"];

    do {
        if ( empty($id) || empty($name) || empty($email) || empty($phone) || empty($address) || empty($card_name) || empty($card_number) || empty($amount))  {
           $errorMessage = "ALL the fields are required";
           break;
        }

        $sql = "UPDATE donation " . 
               "SET name = '$name', email = '$email', phone = '$phone', address = '$address', card_name = '$card_name', card_number = '$card_number', amount = '$amount' " . 
               "WHERE id = $id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query" . $connection->error;
            break;
        }

        $successMessage = "Client updated successfully";

        header("location: admin_donation.php");
        exit;

    } while (false);


}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Client</title>
        <link rel="stylesheet" href="admin_add.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <!-- content -->
        <div class="wrapper">
            <div class="title">
                Update Client
            </div>

            <?php 
            if (!empty($errorMessage)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
            ?>

            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form">
                    <div class="input_field">
                        <label>Name</label>
                        <input type="text" class="input" name="name" value="<?php echo $name; ?>">
                    </div>
                    <div class="input_field">
                        <label>Email</label>
                        <input type="text" class="input" name="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="input_field">
                        <label>Phone</label>
                        <input type="text" class="input" name="phone" value="<?php echo $phone; ?>">
                    </div>
                    <div class="input_field">
                        <label>Address</label>
                        <input type="text" class="input" name="address" value="<?php echo $address; ?>">
                    </div>
                    <div class="input_field">
                        <label>Name on Card</label>
                        <input type="text" class="input" name="card_name" value="<?php echo $card_name; ?>">
                    </div>
                    <div class="input_field">
                        <label>Card Number</label>
                        <input type="text" class="input" name="card_number" value="<?php echo $card_number ?>">
                    </div>
                    <div class="input_field">
                        <label>Amount</label>
                        <input type="text" class="input" name="amount" value="<?php echo $amount; ?>">
                    </div>

                    <?php 
                    if (!empty($successMessage)) {
                        echo "
                        <div class='input_field'>
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$successMessage</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        </div>
                        ";

                    }
                    ?>

                    <div class="inputfield">
                        <button type="submit" value="Add Client" class="btn">Update Client</button><a href="admin_donation.php" type="submit" value="Cancel" class="btn">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>