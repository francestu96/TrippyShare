//array che contiene ogni tappa
var stages = new Array();
//indice di stages che utilizzo per l'autocompletamento dei campi delle tappe e per calcolare il rapporto per il progresso
var index = 0;

//aggiunge una tappa all'array stages
//si potrebbe fare che se è tutto vuoto la tappa viene eliminata, visto che un bottone in più non saprei dove metterlo
function addStage(){
  var required = new Array("place", "days", "type", "description");

  for(var i=0; i < required.length; i++) {
    if (document.getElementById(required[i]).value == "" || document.getElementById(required[i]).value == "undefined"){
      document.getElementById(required[i]).setCustomValidity("Please fill out this field");
      document.getElementById(required[i]).reportValidity();
      return;
    }
    else
      document.getElementById(required[i]).setCustomValidity("");
  }

  var stage = {
    place : document.getElementById("place").value,
    days : document.getElementById("days").value,
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
    document.getElementById("days").value = stages[index+1].days;
    document.getElementById("type").value = stages[index+1].type;
    document.getElementById("description").value = stages[index+1].description;
  }
  $("#animate").css('left', function(){ return $(this).offset().left; })
             .animate({"left":"0px"}, "slow");


  index++;
  document.getElementById("progress").value=(Number(index+1)/stages.length)*100;
}

//si guardano le tappe inserite precedentemente nel caso si volesse modificare qualcosa
function prevStage(){
  if(index == 0)
    return;

  var required = new Array("place", "days", "type", "description");
  var addStage = true;
  // for(var i=0; i < required.length; i++) {
  //   if (document.getElementById(required[i]).value == "" || document.getElementById(required[i]).value == "undefined"){
  //     document.getElementById(required[i]).setCustomValidity("Please fill out this field");
  //     document.getElementById(required[i]).reportValidity();
  //     return;
  //   }
  //   else
  //     document.getElementById(required[i]).setCustomValidity("");
  // }

  var stage = {
    place : document.getElementById("place").value,
    days : document.getElementById("days").value,
    type : document.getElementById("type").value,
    description : document.getElementById("description").value
  }

  for(var i=0; i < required.length; i++)
    if (document.getElementById(required[i]).value == "" || document.getElementById(required[i]).value == "undefined")
      addStage = false;

  if(addStage)
    stages[index] = stage;

  $("#animate").css('left', function(){ return -$(this).offset().left; })
             .animate({"left":"0px"}, "slow");

  index--;

  //ripristina i valori precedentemente inseriti
  document.getElementById("place").value = stages[index].place;
  document.getElementById("days").value = stages[index].days;
  document.getElementById("type").value = stages[index].type;
  document.getElementById("description").value = stages[index].description;

  document.getElementById("progress").value=(Number(index+1)/stages.length)*100;
}

//aggiorna stages() e lo assegna all'input nascosto "stages"
function setStages(){
  var stage = {
    place : document.getElementById("place").value,
    days : document.getElementById("days").value,
    type : document.getElementById("type").value,
    description : document.getElementById("description").value
  }
  var required = new Array("place", "days", "type", "description");
  var addStage = true;

  for(var i=0; i < required.length; i++)
    if (document.getElementById(required[i]).value == "" || document.getElementById(required[i]).value == "undefined"){
      if(stages.length === 0){
        document.getElementById(required[i]).setCustomValidity("Please fill out this field");
        document.getElementById(required[i]).reportValidity();
        return;
      }
      else
        addStage = false;
    }

  if(addStage)
    stages[index] = stage;

  document.getElementById("stages").value = JSON.stringify(stages);
}
