<?php
  session_start();
  include('db/mysql_credentials.php');
  require("common/costants.php");

 /* Il seguente script prende i dati in input dal form di registrazione
  *  Controlla che tutti i dati siano stati inseriti e prova ad inserirli.
  * Se tutti i dati sono inseriti correttamente e la query di inserimento va a buon fine l'utente verrà loggato e rimandato sulla homepage.
  * Altrimenti tornerà nella pagina di login e gli verrà visualizzato un errore generico.
  */
  $required = array('name', 'surname', 'email', 'password');

  foreach($required as $field) {
    if ($_POST[$field] === "" || empty($_POST[$field])){
      header('Location: login.php?action='.MISSING_FIELD_REGISTRATION_ACTION);
      exit();
    }
  }

  // Uso la trim per evitare che ci siano spazi non voluti
  $name = trim($_POST['name']);
  $surname = trim($_POST['surname']);
  $email = trim($_POST['email']);
  $password = sha1(trim($_POST['password']));

  // Verifico che abbiano inserito solo il nome e non altre schifezze
  if(!preg_match("/^[a-zA-Z'-]+$/", $name) || !preg_match("/^[a-zA-Z'-]+$/", $surname) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
    // Un cracker :D
    header('Location: login.php?action='.CHECK_FIELD_REGISTRATION_ACTION);
    exit();
  }

  // Create connection
  $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);

  // Check connection
  if ($conn->connect_error)
    error("Connection failed: " . $conn->connect_error, null);
  
  $query = "INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)";

  if ($stmt = $conn->prepare($query)) {
    /* bind parameters for markers */
    $stmt->bind_param("ssss", ucfirst($name), ucfirst($surname), $email, $password);

    // Prova ad effettuare la insert
    if ($stmt->execute()) {
      // L'ho inserito con successo
      $_SESSION['name'] = $name;
      $_SESSION['email'] = $email;
      header('Location: index.php?action='.REGISTRATION_ACTION);
    } else {
      // La mail era già rpesente o si è verificato qualche errore
      header('Location: login.php?action='.ERROR_REGISTRATION_ACTION);
    }

    /* close statement */
    $stmt->close();
  }
  $conn->close();
?>
