<?php
  // ESERCIZIO 1
  /* Il seguente script prende i dati in input dal form di registrazione
  *  Controlla solamente che tutti i dati siano stati inseriti e che il codice fiscale inserito sia corretto.
  */

  $required = array('name', 'surname', 'email', 'password');

  foreach($required as $field) {
    if (empty($_POST[$field]))
      header('Location: error.html');
  }

  // Uso la trim per evitare che ci siano spazi non voluti
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $email = $_POST['email'];
  $password = sha1($_POST['password']);

  // Create connection
  $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $query = "INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)";

  if ($stmt = $conn->prepare($query)) {
    /* bind parameters for markers */
    $stmt->bind_param("ssss", $name, $surname, $email, $password);

    /* execute query */
    $stmt->execute();

    //execute successful
    if ($stmt) {
      session_start();

      $_SESSION['name'] = $name;
      $_SESSION['email'] = $email;
      header('Location: index.php?action=0');
    }
    else {
      header('Location: error.html');
    }

    /* close statement */
    $stmt->close();
  }
  $conn->close();
?>
