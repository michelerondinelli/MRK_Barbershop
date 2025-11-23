<!DOCTYPE HTML>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<?php

 require "dbhandler.php";

$data = $_POST["data"];
$ora = $_POST["ora"];

$sql = "UPDATE Appointments SET confirmed = 'SI' where appo_date = '$data'
        and appo_slot = '$ora'";

 mysqli_query($conn, $sql);
   
?>

</html>