var places = new Array();
var days = new Array();
var types = new Array();
var descriptions = new Array();
var left = $('#animate').offset().left;

function addStage(){
  places.push(document.getElementById("place").value);
  days.push(document.getElementById("days").value);
  types.push(document.getElementById("type").value);
  descriptions.push(document.getElementById("description").value);

  $("#animate").css({left:left})
               .animate({"left":"0px"}, "slow");
  //$("#animate").animate({"right": "0px"}, "slow");
  // var result = "";
  // for(var i=0; i < places.length; i++)
  //   result += places[i] + " " + days[i] + " " + types[i] + " " + descriptions[i] + "\n";
  //
  // alert(result);
}
