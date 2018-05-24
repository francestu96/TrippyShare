<?php

  // ESERCIZIO 2
  /**
   * Permette di far loggare un utente registrato su myusers.txt
   */
  $required = array('email_signin', 'password_signin');

  foreach($required as $field) {
    if (empty($_POST[$field]))
      header('Location: error.html');
  }

  // Get dei parametri
  $email = trim($_POST['email_signin']);
  $password = sha1($_POST['password_signin']);

  $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");

  /* check connection */
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $query = "SELECT * FROM users WHERE email=? AND password=?";

  $stmt = $conn->prepare($query);
  if ($stmt = $conn->prepare($query)) {
    /* bind parameters for markers */
    $stmt->bind_param("ss", $email, $password);

    /* execute query */
    $stmt->execute();

    /* get the statement result */
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
    // output data of each row
      while($row = $result->fetch_assoc()) {
        session_start();

        $_SESSION['email'] = $row["email"];
        $_SESSION['name'] = $row["name"];
        header('Location: index.php');
      }
    }
    else {
      header('Location: login.php');
    }

    /* close statement */
    $stmt->close();
  }
  $conn->close();
?>
