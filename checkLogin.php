<?php
  session_start();
  include('db/mysql_credentials.php');
  $required = array('email_signin', 'password_signin');

  foreach($required as $field) {
    if ($_POST[$field] === "" || empty($_POST[$field])){
      $_SESSION['login_message'] = "Errore, compila tutti i campi";
      header('Location: login.php');
      exit();
    }
}

  // Get dei parametri
  $email = trim($_POST['email_signin']);
  $password = sha1(trim($_POST['password_signin']));

  $conn = new mysqli($host, $db_user, $db_pass, $db_name);

  /* check connection */
  if ($conn->connect_error) {
    header('Location: login.php');
    exit();

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

        $_SESSION['name'] = $row["name"];
        header('Location: index.php');
      }
    }
    else {
      $_SESSION['login_message'] = "Username o password errati";
      header('Location: login.php');
      exit();
    }

    /* close statement */
    $stmt->close();
  }
  $conn->close();
?>
