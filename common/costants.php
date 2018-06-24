<?php
  //uncomment the following line if you don't want error info
  define("DEBUG", 0);

  //qui mettiamo le costanti che possiamo usare per i vari messaggi di successo/fallimento di qualcosa
  //potremmo mettere valori inventati per dare professionalità alla cosa e passarli semplicemente in GET.
  //Per esempio:
  //define("REGISTRATION_SUCCESS", "Registrazione effettuata con successo");
  define('REGISTRATION_ACTION', "edfba5d449ced3c7b5dfc26df16e3d8bd535c402");
  define('INSERT_TRIP_ACTION', "bba88d44d6c39917b34603d570f4b77f80e3efa7");
  define('CHECK_FIELD_REGISTRATION_ACTION', "af399eb07abf9c8bdd187f2052e3f7d93eae6e7d");
  define('ERROR_REGISTRATION_ACTION', "96c51f8d4673852190b5c80ba4667b2f553ed380");
  define('MISSING_FIELD_REGISTRATION_ACTION', "e51e46b283da47f7cac267b70ff935a814363067");
  define('MISSING_FIELD_LOGIN_ACTION', "41a15a8bb403dd7b69ad4c9a69b36a7b21de4a5e");
  define('WRONG_USR_PSW_LOGIN_ACTION', "7d5da248002eb407419415fd1fd030bc54a490e8");
  define('SUCCESSFUL_JOIN_TRIP', "a6d2bea740982a863afa8149e899b951316b5704");


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
