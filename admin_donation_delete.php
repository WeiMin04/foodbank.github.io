<?php 
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "collection";

    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM donation WHERE id=$id";
    $connection->query($sql);
}

header ("location: admin_donation.php");
exit;

?>