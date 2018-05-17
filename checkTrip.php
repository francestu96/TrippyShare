<?php
  $required = array('departure', 'arrival', 'price', 'stages');

  foreach($required as $field) {
    if (empty($_POST[$field]))
      header('Location: error.html');
  }

  $stages = json_decode($_POST["stages"]);

  echo "Stages:<br>";
  foreach($stages as $stage){
    echo "Place: " . $stage->place . "<br>";
    echo "Days: " . $stage->days . "<br>";
    echo "Type: " . $stage->type . "<br>";
    echo "Description: " . $stage->description . "<br><br>";
  }
?>
