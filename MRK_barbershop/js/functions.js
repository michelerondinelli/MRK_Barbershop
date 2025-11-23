$(document).ready(function(){
    
    //Reindirizzento buttons

    $(".loginButton").click(function(){
        $( location ).attr("href", "login.html");
      });
    $(".registerButton").click(function(){
        $( location ).attr("href", "register.html");
      });
    $(".logoutButton").click(function(){
        $( location ).attr("href", "logout.php");
      });
    $(".prenotaButton").click(function(){
        $( location ).attr("href", "select1.php");
      });
    $(".prenotaIndexButton").click(function(){
      $( location ).attr("href", "login.html");
    });
    $(".LeMiePrenotazioniButton").click(function(){
      $( location ).attr("href", "LeMiePrenotazioni.php");
    });
    $(".posizioneButton").click(function(){
      $( location ).attr("href","https://goo.gl/maps/GnQkXGmVnqghzpkFA");
    });
    $(".prenotazioniButton").click(function(){
      $( location ).attr("href","select1.php");
    });
    $(".tornaPrenotazioniButton").click(function(){
      $( location ).attr("href","select1.php");
    });
    $(".homeImg").click(function(){
      $( location ).attr("href","index.html");
    });
    $(".homeImgLogged").click(function(){
      $( location ).attr("href","loggato.html");
    });
    $(".logo").click(function(){
      $( location ).attr("href","loggato.html");
    });

    //Elimina appuntamento
    $(".elimina").click(function(){
  
      $.ajax({
        url: "elimina.php",
        type: 'POST',
        data:{data:$(this).attr("data"), ora:$(this).attr("ora")},
    
        success: function(result){
          location.reload()
        }
      });
    });
  
});

function select (cell, date, slot) {
  // (A) UPDATE SELECTED CELL
  let last = document.querySelector("#select .selected");
  if (last != null) { last.classList.remove("selected"); }
  cell.classList.add("selected");

  // (B) UPDATE CONFIRM FORM
  document.getElementById("cdate").value = date;
  document.getElementById("cslot").value = slot;
  document.getElementById("cgo").disabled = false;
}