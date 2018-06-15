//quando clicclo su trip per visualizzarlo, invia a Trip.php l'id del trip interessato
$(document).ready(function() {
     $('[name="tripContainer"]').click(function() {
       $('<input />').attr('type', 'hidden')
         .attr('name', 'trip')
         .attr('value', this.querySelector("#id").getAttribute("value"))
         .appendTo('#myForm');
       $('#myForm').submit();
     });
});
