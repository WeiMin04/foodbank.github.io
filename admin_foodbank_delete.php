<?php 
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "collection";

    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM foodbank WHERE id=$id";
    $connection->query($sql);
}

header ("location: admin_foodbank.php");
exit;

?>