var request;
var field;
var value;

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
    var el=document.getElementById(field);
    el.style="border:1px solid green";
    el.setCustomValidity("");
  }
  else{
    var el=document.getElementById(field);
    el.style="border:1px solid red";
    el.setCustomValidity("Invalid "+field);
  }
}

//aletr per dimostrare che viene inviato il form
function validateForm(){
  alert("An horrible alert to prove you are now registered on no one's cloud");
  return true;
}


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
