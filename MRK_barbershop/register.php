<?php
require "dbhandler.php";

// Prendo i valori dal form
$Nome     = mysqli_real_escape_string($conn, $_POST['nome']);
$Cognome  = mysqli_real_escape_string($conn, $_POST['cognome']);
$Email    = mysqli_real_escape_string($conn, $_POST['email']);
$Password = mysqli_real_escape_string($conn, $_POST['password']);

$errors = [];

// Controllo lunghezza password
if (strlen($Password) < 8) {
    $errors[] = "La password deve contenere almeno 8 caratteri.";
}

// Controllo se l'email è già registrata
$checkEmail = "SELECT email FROM Users WHERE email = '$Email' LIMIT 1";
$result     = mysqli_query($conn, $checkEmail);

if (mysqli_num_rows($result) > 0) {
    $errors[] = "L'email inserita è già registrata.";
}

// Se ci sono errori → stampo script JS con alert
if (!empty($errors)) {
    $msg = implode("\\n", array_map('addslashes', $errors));
    echo "<script>alert('$msg'); window.location.href='register.html';</script>";
} else {
    // Se tutto ok → inserisco nel DB
    $hash = password_hash($Password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO Users (nome, cognome, email, password)
            VALUES ('$Nome', '$Cognome', '$Email', '$hash')";

    if (mysqli_query($conn, $sql)) {
        header("Location: benvenuto.html");
        exit;
    } else {
        $msg = addslashes("Errore durante la registrazione: " . mysqli_error($conn));
        echo "<script>alert('$msg'); window.location.href='register.html';</script>";
    }
}

mysqli_close($conn);
?>
