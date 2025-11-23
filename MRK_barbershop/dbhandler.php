<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barber_shop";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
 die("Connessione al database fallita: " . mysqli_connect_error());
}

?>