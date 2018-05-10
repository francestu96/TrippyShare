<?php

  // ESERCIZIO 2
  /**
   * Permette di far loggare un utente registrato su myusers.txt
   */
  $required = array('email_signin', 'password_signin');

  foreach($required as $field) {
    if (empty($_POST[$field])) {
      echo "Il campo: ".$field." e' obbligatorio.";
      return;
    }
  }

  // Get dei parametri
  $email = trim($_POST['email_signin']);
  $password = sha1($_POST['password_signin']);

  $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");

  /* check connection */
  if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
  }

  $query = "SELECT * FROM users WHERE email=? AND password=?";

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

        $_SESSION['name'] = $row["name"];
        header('Location: index.php');
      }
    }
    else {
      echo "<center><h2>Login failed!</h2>";
      echo "<input type=\"button\" value=\"Login\" onclick=\"history.back(-1)\"></center>";
    }

    /* close statement */
    $stmt->close();
  }

  $conn->close();
?>
