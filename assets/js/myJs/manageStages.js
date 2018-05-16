//array che contiene ogni tappa
var stages = new Array();
//indice di stages che utilizzo per l'autocompletamento dei campi delle tappe e per calcolare il rapporto per il progresso
var index = 0;

//aggiunge una tappa all'array stages
//si potrebbe fare che se è tutto vuoto la tappa viene eliminata, visto che un bottone in più non saprei dove metterlo
function addStage(){
  var stage = {
    place : document.getElementById("place").value,
    day : document.getElementById("days").value,
    type : document.getElementById("type").value,
    description : document.getElementById("description").value
  }

  stages[index] = stage;
  //se si è in fondo all'array, i prossimi campi verranno visualizzati vuoti
  if(!stages[index+1]){
    document.getElementById("place").value='';
    document.getElementById("days").value=1;
    document.getElementById("type").value=document.getElementById("type").value;
    document.getElementById("description").value='';
  }
  //altrimenti si inseriscono i valori già stati inseriti precedentemente
  else{
    document.getElementById("place").value = stages[index+1].place;
    document.getElementById("days").value = stages[index+1].day;
    document.getElementById("type").value = stages[index+1].type;
    document.getElementById("description").value = stages[index+1].description;
  }
  $("#animate").css('left', function(){ return $(this).offset().left; })
             .animate({"left":"0px"}, "slow");

  index++;
  document.getElementById("progress").value=(index/stages.length)*100;

  //assegno all'input nascosto nel form l'array con tutte le tappe da inviare in POST
  document.getElementById("stages").value = stages;
}

//si guardano le tappe inserite precedentemente nel caso si volesse modificare qualcosa
function prevStage(){
  if(index == 0)
    return;

  var right = $(window).width() - ($('#animate').offset().left + $('#animate').outerWidth());

  //dovrebbe essere la funzione per l'animazione verso destra ma non funziona DIOCANE
  $("#animate").css({right:right})
             .animate({"right":"0px"}, "slow");

  index--;

  //ripristina i valori precedentemente inseriti
  document.getElementById("place").value = stages[index].place;
  document.getElementById("days").value = stages[index].day;
  document.getElementById("type").value = stages[index].type;
  document.getElementById("description").value = stages[index].description;

  document.getElementById("progress").value=(index/stages.length)*100;
}
