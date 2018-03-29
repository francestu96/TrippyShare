var request;
var field;
var value;

function jsonRequest(field, value){
  var url="https://saw1718.herokuapp.com/validation.php";
  getXMLHttpRequestObject();
  this.field=field;
  this.value=value;

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
  }
  else{
    document.getElementById(field).style="border:1px solid red";
    alert(jsonObj[0].name+" "+jsonObj[0].value+" already used! Try another one");
  }
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
