<?php

  // ESERCIZIO 2
  /**
   * Permette di far loggare un utente registrato su myusers.txt
   */
  require "utilities.php";
  $required = array('username', 'password_signin');

  foreach($required as $field) {
    if (empty($_POST[$field]))
      header('Location: error.html');
  }

  // Get dei parametri
  $username = trim($_POST['username']);
  $password = sha1($_POST['password_signin']);

  $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");

  /* check connection */
  if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
  }

  $query = "SELECT * FROM users WHERE email=? AND password=?";

  $stmt = $conn->prepare($query);
  if ($stmt = $conn->prepare($query)) {
    /* bind parameters for markers */
    $stmt->bind_param("ss", $username, $password);

    /* execute query */
    $stmt->execute();

    /* get the statement result */
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
    // output data of each row
      while($row = $result->fetch_assoc()) {
        session_start();

        $_SESSION['name'] = $row["name"];
        header('Location: index.php');
      }
    }
    else {
      header('Location: error.html');
    }

    /* close statement */
    $stmt->close();
  }
  $conn->close();
  header('Location: error.html');
?>
