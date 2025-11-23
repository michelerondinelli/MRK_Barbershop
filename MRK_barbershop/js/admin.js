$(document).ready(function(){
  
//Reindirizzento buttons

$(".gestisciButton").click(function(){
  $( location ).attr("href", "gestisci.php");
});

$(".gestisciButtonMobile").click(function(){
  $( location ).attr("href", "gestisci.php");
});

$(".prenotazioniButton").click(function(){
  $( location ).attr("href","admin.php");
});
$(".tornaPrenotazioniButton").click(function(){
  $( location ).attr("href","admin.php");
});
$(".logoutButton").click(function(){
  $( location ).attr("href", "logout.php");
});

//elimina query

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

  $(".conferma").click(function(){
    
    $.ajax({
      url: "conferma.php",
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

