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
        alert("Ajax error: no data received");
    }
    else
      alert("Ajax error: " + request.statusText);
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
  // TODO: validare la password, mettere il bordo anche a lei se non è almeno di 6 caratteri
}

function validateForm(){
  for(var i = 0; i < correct.length; i++){
    if(correct[i] == 0){
      // DIsplay del messaggio di errore generico (impossibile registrarsi), se hai sbatti di scriverlo direttamente in pagina e non su alert meglio
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
    default: return -1;
  }
}
