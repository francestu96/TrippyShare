"use strict";

//quando clicclo su trip per visualizzarlo, invia a Trip.php l'id del trip interessato

//IL MODULO DI INVIO DEVE AVERE:
// - un form con id="myForm"
// - un div container con name="tripContainer"
// - un div con id="id" e il valore dell'id del trip che vogliamo postare
$(document).ready(function() {
     $('[name="tripContainer"]').click(function() {
       $('<input />').attr('type', 'hidden')
         .attr('name', 'trip')
         .attr('value', this.querySelector("#id").getAttribute("value"))
         .appendTo('#myForm');
       $('#myForm').submit();
     });
});
