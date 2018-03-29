var request;

function jsonAPIRequest(){
  var url="http://api.openweathermap.org/data/2.5/weather?q=Lisboa&&appid=5f4cd1cf7f21d214ead24a56a0ed49f3";
  getXMLHttpRequestObject();

  request.open("GET", url, true);
  request.onreadystatechange=ajaxCallback;
  request.send();
}

function ajaxCallback(){
  if (request.readyState == 4) {
    if (request.status == 200) {
      if (request.responseText != null)
        formatWeatherJson(request.responseText);
      else
        alert("Ajax error: no data received");
    }
    else
      alert("Ajax error: " + request.statusText);
  }
}

function formatWeatherJson(jsonText){
  var jsonObj=JSON.parse(jsonText);
  var city=jsonObj.name;
  var weather=jsonObj.weather[0].main;
  var temp=jsonObj.main.temp/33.8;
  var spanContent="City: "+city+"<br>Weather: "+weather+"<br>Temp: "+Math.round(temp * 100) / 100+"C";

  //document.getElementById("weatherDiv").style.display="block";
  document.getElementsByClassName("tooltiptext")[0].innerHTML=spanContent;

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
