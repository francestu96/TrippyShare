<?php
  //uncomment the following line if you don't want error info
  define("DEBUG", 0);

  //qui mettiamo le costanti che possiamo usare per i vari messaggi di successo/fallimento di qualcosa
  //potremmo mettere valori inventati per dare professionalità alla cosa e passarli semplicemente in GET.
  //Per esempio:
  define("REGISTRATION_SUCCESS_example", "3dasdefFdwj)oji)£dwoue");



  //if DEBUG is set show the error, otherwise redirect to the error page
  function error($error_message, $connection){
    if(defined('DEBUG'))
      echo $error_message;
    else
      header('Location: error.html');

    if(!empty($connection))
      if(!$connection->close())
        echo $connection->error;

    die();
  }

  //display the loading gif if DEBUG is not set
  function preloader(){
    if(!defined('DEBUG')){
      echo '<div id="preloader">
              <div id="status">&nbsp;</div>
            </div>';
    }
  }
?>
