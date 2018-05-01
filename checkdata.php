<?php
  // ESERCIZIO 1
  /* Il seguente script prende i dati in input dal form di registrazione
  *  Controlla solamente che tutti i dati siano stati inseriti e che il codice fiscale inserito sia corretto.
  */
  require "utilities.php";
  const MALE = "male";
  const FEMALE = "female";

  $required = array('name', 'surname', 'gender', 'birthDate','birthCity', 'email', 'fiscalCode', 'password');

  foreach($required as $field) {
    if (empty($_POST[$field])) {
      echo "Il campo: ".$field." e' obbligatorio.";
      return;
    }
  }

  // Uso la trim per evitare che ci siano spazi non voluti
  $name = trim($_POST['name']);
  $birthCity = trim($_POST['birthCity']);
  $surname = trim($_POST['surname']);
  $gender = trim($_POST['gender']);
  $birthDate = strtotime($_POST['birthDate']);

  // getFiscalCode è una funzione che si trova in utilities.php
  $fiscalCode = getFiscalCode($name, $surname, $gender == MALE ? 0 : 40, $birthDate, $birthCity);
  if($fiscalCode === strtoupper($_POST['fiscalCode'])){
    echo "Registrazione avvenuta con successo, purtroppo non puoi ancora loggare con questi dati perché manca il database";
  } else {
    echo "Il codice fiscale dovrebbe essere: ".$fiscalCode." invece hai inserito: ".strtoupper($_POST['fiscalCode']);
  }

?>
