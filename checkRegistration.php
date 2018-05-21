<?php
  session_start();

 /* Il seguente script prende i dati in input dal form di registrazione
  *  Controlla che tutti i dati siano stati inseriti e prova ad inserirli.
  * Se tutti i dati sono inseriti correttamente e la query di inserimento va a buon fine l'utente verrà loggato e rimandato sulla homepage.
  * Altrimenti tornerà nella pagina di login e gli verrà visualizzato un errore generico.
  */
  $required = array('name', 'surname', 'email', 'password');

  foreach($required as $field) {
    if ($_POST[$field] === "" || empty($_POST[$field])){
      $_SESSION['registration_message'] = "Errore durante la registrazione, compila tutti i campi";
      header('Location: login.php');
    }
  }

  // Uso la trim per evitare che ci siano spazi non voluti
  $name = trim($_POST['name']);
  $surname = trim($_POST['surname']);
  $email = trim($_POST['email']);
  $password = sha1(trim($_POST['password']));

  // Create connection
  // <TODO:> Inserisci qui il tuo nome utente e password</TODO:>
  $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");

  // Check connection
  if ($conn->connect_error) {
      header('Location: login.html');
  }

  $query = "INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)";

  if ($stmt = $conn->prepare($query)) {
    /* bind parameters for markers */
    $stmt->bind_param("ssss", $name, $surname, $email, $password);

    // Prova ad effettuare la insert
    if ($stmt->execute()) {
      // L'ho inserito con successo
      $_SESSION['name'] = $name;
      header('Location: index.php');
    } else {
      // La mail era già rpesente o si è verificato qualche errore
      $_SESSION['registration_message'] = "Errore durante la registrazione, i tuoi dati potrebbero essere errati o hai già un account registrato";
      header('Location: login.html');
    }

    /* close statement */
    $stmt->close();
  }
  $conn->close();
?>
