var request;

function jsonAPIRequest(){
  $.ajax({
         url : "http://api.openweathermap.org/data/2.5/weather?q=Lisboa&&appid=5f4cd1cf7f21d214ead24a56a0ed49f3",
         type : 'GET',
         dataType: "json",
         success: function (jsonObj){
           var city=jsonObj.name;
           var weather=jsonObj.weather[0].main;
           var temp=jsonObj.main.temp/33.8;
           var spanContent="City: "+city+"<br>Weather: "+weather+"<br>Temp: "+Math.round(temp * 100) / 100+"C";

           document.getElementsByClassName("tooltiptext")[0].innerHTML=spanContent;
         },
         error : function(xhr,status,error) {
           alert("Ajax error: "+error);
         }
  });
}
