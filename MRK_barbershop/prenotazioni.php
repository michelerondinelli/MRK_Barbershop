<?php
require "libreria_app.php";

if ($_POST["email"] =="") {
    header("location: admin.php");
    exit;
}
echo $_APPO->save($_POST["date"], $_POST["slot"], $_POST["email"]) ? "La tua prenotazione è stata effettuata" : $_APPO->error;

session_start();

if ($_SESSION['user_id'] == "admin@gmail.com"){
   header("location: admin.php");
}else{
    header("location: LeMiePrenotazioni.php");
}

?>
