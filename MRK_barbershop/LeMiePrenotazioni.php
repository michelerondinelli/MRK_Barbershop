<!DOCTYPE html>
<HTML>
  <head>
    <title>MRK_BarberShop | Le Mie Prenotazioni</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/functions.js"></script>
    <link rel="stylesheet" type="text/css" href="css/LeMiePrenotazioni.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  </head>
  <body>
  <header>
  <div class="container">
   <div class="row">
    <div class="col-md-3">
     <img class="logo" src="images/logo.PNG" >
    </div>
    <div class="col-md-9 divButton">
     <button class="tornaPrenotazioniButton">Torna alle prenotazioni<span></span></button>
     <button class="logoutButton">Logout<span></span></button>
    </div>
   </div>
  </div>
  </header>
  <div class="container leMiePrenotazioni">
  <?php
    
    require "dbhandler.php";
    
    if (!isset($_SESSION['user_id']))  header("Location: login.html");
    $email = $_SESSION['user_id'];
    $nome = $_SESSION['name'];
    $cognome = $_SESSION['surname'];
    
  
 
    ?>
 
    <!-- Creo la tabella select dove inserirò i giorni e i time slot degli appuntamenti -->
    <table id="select">
      <!-- Inserisco la prima riga con tutti i time slot -->
      <tr>
        <th class="attributi"><i class="glyphicon glyphicon-user"></i></th>
        <th class="attributi">Nome</th> 
        <th class="attributi">Cognome</th>
        <th class="attributi">Data</th>
        <th class="attributi">Orario</th>
        <th class="attributi">Confermato</th>
        <th class="attributi">Elimina</th>
      </tr>
      <?php

      $sql = "SELECT * FROM Appointments WHERE email = '$email'";
      $result = mysqli_query($conn, $sql);
      $i = 1;
      $y = 0;
      for( $i; $i<=mysqli_num_rows($result); $i++ ) {
          $row = mysqli_fetch_assoc($result);
          $data = $row['appo_date'];
          $orario = $row['appo_slot'];
          $confermato = $row['confirmed'];
          if (strtotime($data) >= strtotime((date("Y-m-d")))){
            $y++;
            echo "<tr>";
            echo "<th class='attributi'>Appuntamento $y</th>";
            echo "<th class='white'>$nome</th>";
            echo "<th class='white'>$cognome</th>";
            echo "<th class='white'>$data</th>";
            echo "<th class='white'>$orario</th>";
            echo "<th class='white'>$confermato</th>";
            echo "<th class='white'><button class='elimina' data='$data' ora='$orario'><img src='images/close.png' height=15</th>";            echo "</tr>";
          }
      }

      for( $j=$y+1; $j<7; $j++){
        echo "<tr>";
        echo "<th class='attributi'>Appuntamento $j</th>";
        echo "<th class='white'></th>";
        echo "<th class='white'></th>";
        echo "<th class='white'></th>";
        echo "<th class='white'></th>";
        echo "<th class='white'></th>";
        echo "<th class='white'></th>";
        echo "</tr>";
      }
        ?>
  
    </table>
    <div class="prenotazioniDiv">
            <button class="prenotazioniButton">Torna alle prenotazioni</button>
    </div>
  </div>
  <footer>
    <div class="container">
    <div class="row">
      <div class="col-md-3">
        <h5 style="color: white;text-align: center;">LINK RAPIDI</h5>
         <ul class="linkRapidi">
          <li class="li_home" style="color:white"><a href="loggato.html" style="color:white;">Home</a></li>
          <li style="color:white"><a href="logout.php" style="color:white;">Logout</a></li>
          <li style="color:white"><a href="select1.php" style="color:white;">Prenota</a></li>
          <li style="color:white"><a href="LeMiePrenotazioni.php" style="color:white;">Le Mie Prenotazioni</a></li>
        </ul>
      </div>
      <div class="col-md-6" style="text-align: center;">
       <h5 style="color:white;">CONTATTACI</h5>
       <br>
       <ul class="social">
        <img class="mail_img" src="images/mail.jpg" height="20" style="margin-right:5px"/><h5 class="mail" style="color:white;">MRK_BarberShop@gmail.com</h5>
        <br>
        <img class="insta_img" src="images/insta.png" height="45"><h5 class="instagram" style="color:white">MRK_BarberShop</h5>
       </ul>
      </div>
      <div class="col-md-3 linkVia">
        <h5 style="color:white" >DOVE SIAMO</h5>
        <a style="color:white" href="https://goo.gl/maps/GnQkXGmVnqghzpkFA">VIA URBANO RATTAZZI 47</a>
        </div>
        <hr style="color:white; padding-top: 3px">
	    <br>
	    <br>
	    <h6 style="color:white;text-align: center;">Copyright © 2023-2023, MRK_BarberShop.it</h6>
    </div>
   </div>
  </footer>
 </body>       
</HTML>