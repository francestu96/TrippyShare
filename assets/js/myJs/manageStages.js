var stages = new Array();
var index = 0;

function addStage(){
  var stage = {
    place : document.getElementById("place").value,
    day : document.getElementById("days").value,
    type : document.getElementById("type").value,
    description : document.getElementById("description").value
  }

  stages[index] = stage;
  if(!stages[index+1]){
    document.getElementById("place").value='';
    document.getElementById("days").value=1;
    document.getElementById("type").value=document.getElementById("type").value;
    document.getElementById("description").value='';
  }
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
}

function prevStage(){
  if(index == 0)
    return;

  var right = $(window).width() - ($('#animate').offset().left + $('#animate').outerWidth());

  $("#animate").css({right:right})
             .animate({"right":"0px"}, "slow");

  index--;
  document.getElementById("place").value = stages[index].place;
  document.getElementById("days").value = stages[index].day;
  document.getElementById("type").value = stages[index].type;
  document.getElementById("description").value = stages[index].description;

  document.getElementById("progress").value=(index/stages.length)*100;
}
