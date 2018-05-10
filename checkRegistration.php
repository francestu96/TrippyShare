<?php
  // ESERCIZIO 1
  /* Il seguente script prende i dati in input dal form di registrazione
  *  Controlla solamente che tutti i dati siano stati inseriti e che il codice fiscale inserito sia corretto.
  */
  //require "utilities.php";
  const MALE = "male";
  const FEMALE = "female";
  const OTHER = "other";

  $required = array('name', 'surname', 'email', 'password');

  foreach($required as $field) {
    if (empty($_POST[$field])) {
      echo "Il campo: ".$field." e' obbligatorio.";
      return;
    }
  }
  // Uso la trim per evitare che ci siano spazi non voluti
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $gender = $_POST['gender'];
  $birthDate = $_POST['birthDate'];
  $email = $_POST['email'];
  $password = sha1($_POST['password']);

  // Create connection
  $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $query = "INSERT INTO users (name, surname, gender, birthdate, email, password) VALUES (?, ?, ?, ?, ?, ?)";

  if ($stmt = $conn->prepare($query)) {
    /* bind parameters for markers */
    $stmt->bind_param("ssssss", $name, $surname, $gender, $birthDate, $email, $password);

    /* execute query */
    $stmt->execute();

    //execute successful
    if ($stmt) {
      session_start();

      $_SESSION['name'] = $name;
      header('Location: index.php');
    }
    else {
      echo "<center><h2>Something went wrong during the insert</h2>";
      echo "<input type=\"button\" value=\"Login\" onclick=\"history.back(-1)\"></center>";
    }

    /* close statement */
    $stmt->close();
  }
  echo "<center><h2>You submit bad inputs!</h2>";
  echo "<input type=\"button\" value=\"Login\" onclick=\"history.back(-1)\"></center>";

  $conn->close();
?>
