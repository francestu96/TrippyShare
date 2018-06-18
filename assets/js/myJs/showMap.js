//In Trip.php mostra la mappa con tutte le tappe
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
            content: '<h1>Place:'+ description +
                         'Duration:'+ duration +
                         'Type: '+ type +
                         'Description: ' +description+
                     '</h1>'
          });

          marker.addListener('click', function(){
            infoWindow.open(map, marker);
          });

          bounds.extend(marker.getPosition());
          map.fitBounds(bounds);
        }
  });
}
