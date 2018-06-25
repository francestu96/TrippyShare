"use strict";
//In Trip.php display all the stages in the map
var infoWindows = new Array();

$(document).ready(function(){
  var stages = document.getElementsByName("stages");

  for(var i=0; i < stages.length; i++){
    addMarker(stages[i].getAttribute("place"),
              stages[i].getAttribute("duration"),
              stages[i].getAttribute("trip_type"),
              stages[i].getAttribute("description"));
  }

});

function initMap(){
  var options = {
    zoom : 4,
    center : {lat:46.4792726, lng:12.033957}
  }

  map = new google.maps.Map(document.getElementById("map"), options);
  bounds = new google.maps.LatLngBounds();
}

function addMarker(place, duration, type, description){
  $.ajax({
        type: "GET",
        url: "https://maps.googleapis.com/maps/api/geocode/json?address=" + place +"&key=AIzaSyB8-kAUPVmM33rORirYxG2KhKkLnFH89-w",
        dataType: "json",
        success: function(response){
          var marker = new google.maps.Marker({
            position : response.results[0].geometry.location,
            map: map
          });

          var infoWindow = new google.maps.InfoWindow({
            content: '<h3><b>Place: </b>'+ description +
                         '<br><br><b>Duration: </b>'+ duration +
                         '<br><br><b>Type: </b>'+ type +
                         '<br><br><b>Description: </b>' +description+
                     '</h3>'
          });

          marker.addListener('click', function(){
            for(var i=0; i<infoWindows.length; i++)
              if(infoWindows[i])
                infoWindows[i].close();

            infoWindow.open(map, marker);
            infoWindows.push(infoWindow);
          });

          bounds.extend(marker.getPosition());
          map.fitBounds(bounds);
        }
  });
}
