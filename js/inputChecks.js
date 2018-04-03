var request;
var field;
var value;
var correct = [0,0,0];

function jsonRequest(field, value){
  var url="https://saw1718.herokuapp.com/validation.php";
  getXMLHttpRequestObject();
  this.field=field;
  this.value=value;
  this.countCorrect = 0;

  request.open("POST", url, true);

  request.onreadystatechange=checkField;

  params=encodeURI(field+"="+value);
  request.open("POST", url, true);
  request.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
  request.send(params);
}

function checkField(){
  if (request.readyState == 4) {
    if (request.status == 200) {
      if (request.responseText != null)
        formatJson(request.responseText);
      else
        console.log("Ajax error: no data received");
    }
  }
}

function formatJson(jsonText){
  var jsonObj=JSON.parse(jsonText);

  if(jsonObj[0].status=="ok"){
    document.getElementById(field).style="border:1px solid green";
    correct[fromIdToIndex(field)] = 1;
  }
  else{
    document.getElementById(field).style="border:1px solid red";
    correct[fromIdToIndex(field)] = 0;
  }
}


/** -------------- Ho aggiunto queste ---------------- */
function validatePassword(){
  var passElem=document.getElementById("password");

  if(passElem.value.length>5){
    passElem.style="border:1px solid green";
    correct[fromIdToIndex("password")] = 1;
  }
  else{
    passElem.style="border:1px solid red";
    correct[fromIdToIndex("password")] = 0;
  }
}

function validateForm(){
  for(var i = 0; i < correct.length; i++){
    if(correct[i] == 0){
      alert("Your " + fromIndexToId(i) + " is not valid");
      return false;
    }
  }

  alert("An horrible alert to prove you are now registered on no one's cloud");
  return true;
}

/** -------------- End ---------------- */


function getXMLHttpRequestObject(){
  if (window.XMLHttpRequest) { // Mozilla, Safari, ...
      request = new XMLHttpRequest();
  }
  else if (window.ActiveXObject) { // IE
    try {
      request = new ActiveXObject('Msxml2.XMLHTTP')
    }
    catch (e) {
      try { request = new ActiveXObject('Microsoft.XMLHTTP'); }
      catch (e) {}
    }
  }
}


function fromIdToIndex(field){
  switch(field){
    case "name":  return 0;
    case "email": return 1;
    case "password": return 2;
    default: return -1;
  }
}
function fromIndexToId(index){
  switch(index){
    case 0:  return "Name";
    case 1: return "E-Mail";
    case 2: return "Password";
    default: return -1;
  }
}
