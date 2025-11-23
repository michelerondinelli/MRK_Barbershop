<!DOCTYPE html>
<HTML>
  <head>
    <title>MRK_BarberShop | Prenota</title>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/functions.js"></script>
    <link rel="stylesheet" type="text/css" href="css/select3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  </head>
  <body>
  <header>
  <div class="container">
   <div class="row">
    <div class="col-md-3">
     <img class="logo" src="images/logo.PNG" >
    </div>
    <div class="col-md-9 buttonDiv">
     <button class="LeMiePrenotazioniButton">Le Mie Prenotazioni<span></span></button>
     <button class="logoutButton">Logout<span></span></button>
    </div>
   </div>
  </div>
  </header>
    <?php
    //Carico la libreria_app e inizializzo inizio e fine
    require "libreria_app.php";
    
    session_start();
    $inizio = strtotime("+".APPO_MIN." day");
    $fine = strtotime("+".APPO_MAX." day");
    $prenotato = $_APPO->get(date("Y-m-d", $inizio), date("Y-m-d", $fine));
    $email = $_SESSION['user_id'];
    ?>
  
 
    <!-- Creo la tabella select dove inserirò i giorni e i time slot degli appuntamenti -->
    <table id="select" style="bottom: 0px;left:290px">
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
   

    <!-- Creo il form di conferma -->
    <form id="confirm" method="post" action="prenotazioni.php" style="bottom:10px">
      <input type="hidden" name="email" value="<?php echo $email; ?>">
      <input type="text" id="cdate" name="date" readonly placeholder="Seleziona un orario da prenotare">
      <input type="text" id="cslot" name="slot" readonly>
      <input type="submit" id="cgo" value="Prenota" disabled>
    </form>
  <footer>
    <div class="container footer">
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
      <div class="col-md-3">
        <h5 style="color:white" >DOVE SIAMO</h5>
        <a class="linkVia" href="https://goo.gl/maps/GnQkXGmVnqghzpkFA">VIA URBANO RATTAZZI 47</a>
        </div>
        <hr style="color:white; padding-top: 3px">
	    <br>
	    <br>
	    <h6 style="color:white;text-align: center;">Copyright © 2023-2023, MRK_BarberShop.it</h6>
    </div>
   </div>
  </footer>
  </body>    
</html>