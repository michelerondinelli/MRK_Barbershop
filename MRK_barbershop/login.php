<?php
 require "dbhandler.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Gestione del login+
$Email = mysqli_real_escape_string($conn, $_POST['email']);
$Password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query per verificare l'esistenza dell'utente nel database
    $sql = "SELECT * FROM Users WHERE email = '$Email'";
    
 
        $result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    
        
        if (password_verify($Password,$row['password'])) {
        // Login effettuato con successo
           session_start();
           $_SESSION['user_id'] = $row['email'];
           $_SESSION['name'] = $row['nome'];
           $_SESSION['surname'] = $row['cognome'];
           
           if ($row['email'] == "admin@gmail.com"){
              header("location: admin.php");
           } else{
        
           header("location: loggato.html");}
        
           
        } else {
            header("location: login.html");
        }
    } else {
        header("location: login.html");
    }
}

// Chiusura della connessione al database
mysqli_close($conn);
?>