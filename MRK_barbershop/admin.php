<!DOCTYPE html>
<HTML>
<head>
    <title>MRK_BarberShop | Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script  type="text/javascript" src="js/admin.js"></script>
    <link rel="stylesheet"type="text/css" href="css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  </head>
  <body>
  <header>
   <div class="row">
    <div class="col-md-3">
     <img class="logo" src="images/logo.PNG" >
    </div>
    <div class="col-md-9">
     <button class="logoutButton">Logout</button>
     <button class="gestisciButtonMobile">Gestici Prenotazioni</button>
    </div>
   </div>
</header>

  <?php

    require "dbhandler.php";
    
    //Carico la libreria_app e inizializzo inizio e fine
    require "libreria_app.php";

    session_start();

    if ($_SESSION['user_id'] != "admin@gmail.com") header("location: login.html");

    $inizio = strtotime("+".APPO_MIN." day");
    $fine = strtotime("+".APPO_MAX." day");
    $prenotato = $_APPO->get(date("Y-m-d", $inizio), date("Y-m-d", $fine));
    $email = $_SESSION['user_id'];
    ?>
    
    <!-- Creo la tabella select dove inserirò i giorni e i time slot degli appuntamenti -->
    <table id="select">
      <!-- Inserisco la prima riga con tutti i time slot -->
      <tr>
        <th><i class="glyphicon glyphicon-user"></i></th>
        <?php foreach (APPO_SLOT as $slot) { echo "<th>$slot</th>"; } ?>
      </tr>

      <!-- Inserisco le righe corrispondenti per ogni giorno andando a creare anche le celle che fanno corrispondere ad ogni giorno tutte le fasce orarie-->
      <?php
      for ($unix=$inizio; $unix<=$fine; $unix+=86400) {
        $thisDate = date("Y-m-d", $unix);
        echo "<tr><th>$thisDate</th>";
        foreach (APPO_SLOT as $slot) {
          if (isset($prenotato[$thisDate][$slot])) {
            echo "<td class='booked'>PRENOTATO</td>";
          } else {
            echo "<td class='notBooked' onclick=\"select(this, '$thisDate', '$slot')\"></td>";
          }
        }
        echo "</tr>";
      }
      ?>
    </table>
   
    <div class="row form">
      <div class="col-md-9">
        <!-- Creo il form di conferma -->
        <form id="confirm" method="post" action="prenotazioni.php">
          <input type="varchar" name="email" placeholder="Nome e Cognome" require>
          <input type="text" id="cdate" name="date" readonly placeholder="Seleziona un orario da prenotare">
          <input type="text" id="cslot" name="slot" readonly>
          <input class="prenotaInput" type="submit" id="cgo" value="Prenota" disabled>
        </form>
      </div>
      <div class="col-md-3">
        <button class="gestisciButton">Gestici Prenotazioni</button>
      </div>
  </body>    
</html>
    
  