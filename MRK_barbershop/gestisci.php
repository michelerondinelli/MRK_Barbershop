<!DOCTYPE html>
<HTML>
<head>
    <title>MRK_BarberShop | Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/admin.js"></script>
    <link rel="stylesheet" type="text/css" href="css/gestisci.css">
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
     <button class="tornaPrenotazioniButton">Torna alle Prenotazioni</button>
    </div>
   </div>
</header>
  <?php

   require "dbhandler.php";

   session_start();

   if ($_SESSION['user_id'] != "admin@gmail.com") header("location: login.html");

   ?>
  
  <table id="select">
       <!--Inserisco la prima riga con tutti i time slot -->
      <tr>
        <th class="attributi"><i class="glyphicon glyphicon-user"></i></th>
        <th class="attributi">Nome</th> 
        <th class="attributi">Cognome</th>
        <th class="attributi">Data</th>
        <th class="attributi">Orario</th>
        <th class="attributi">Confermato</th>
        <th class="attributi">Conferma</th>
        <th class="attributi">Elimina</th>
      </tr>

    <?php

     $sql = "SELECT * FROM Appointments";
     $result = mysqli_query($conn, $sql);

     $i = 1;
     $y = 0;

     for( $i; $i<=mysqli_num_rows($result); $i++ ) {
        $row = mysqli_fetch_assoc($result);

        $data = $row['appo_date'];
        $orario = $row['appo_slot'];
        $email = $row['email'];
        $confirmed = $row['confirmed'];
        
        if (substr_count($email,"@")== 1){

            $sql2 = "SELECT nome,cognome FROM Users where email = '$email'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $nome = $row2['nome'];
            $cognome = $row2['cognome'];
        }
        else{
            if (substr_count($row['email']," ") >= 1){
                $split = explode(" ",$row['email']);
                $nome = $split[0];
                if (substr_count($row['email']," ") == 2){
                $cognome = $split[1]." ".$split[2];
                }else{
                    $cognome = $split[1];
                }

            }
        }

        if (strtotime($data) >= strtotime((date("Y-m-d")))){
          
            $y++;
         
            echo "<tr>";
            echo "<th class='attributi'>Appuntamento $y</th>";
            echo "<th class='white'>$nome</th>";
            echo "<th class='white'>$cognome</th>";
            echo "<th class='white'>$data</th>";
            echo "<th class='white'>$orario</th>";
            echo "<th class='white'>$confirmed</th>";
            echo "<th class='white'><button class='conferma'data='$data' ora='$orario'><img src='images/check-mark.png' height=15></button></th>";
            echo "<th class='white'><button class='elimina' data='$data' ora='$orario'><img src='images/close.png' height=15</th>";
            echo "</tr>";
            
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
            echo "<th class='white'></th>";
            echo "</tr>";
          }
        ?>
        </table> 

        <div class="prenotazioniDiv">
            <button class="prenotazioniButton">Torna alle prenotazioni</button>
        </div>
    <footer></footer>
 </body>
</html>