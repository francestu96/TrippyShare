<?php
  // Se non è ancora inizializzat la sessione la inizializzo
  if(!isset($_SESSION))
  {
      session_start();
  }
  include('db/mysql_credentials.php');
  require("common/costants.php");

  $required = array('email_signin', 'password_signin');

  foreach($required as $field) {
    if ($_POST[$field] === "" || empty($_POST[$field])){
      header('Location: login.php?action='.MISSING_FIELD_LOGIN_ACTION);
      exit();
    }
}

  // Get dei parametri
  $email = trim($_POST['email_signin']);
  $password = sha1(trim($_POST['password_signin']));

  $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);

  /* check connection */
  if ($conn->connect_error)
    error("Connection failed: " . $conn->connect_error, null);


  $query = "SELECT * FROM users WHERE email=? AND password=?";

  $stmt = $conn->prepare($query);
  if ($stmt = $conn->prepare($query)) {
    /* bind parameters for markers */
    $stmt->bind_param("ss", $email, $password);

    /* execute query */
    $stmt->execute();

    /* get the statement result */
    $result = $stmt->get_result();

    // output data of each row
    if(!empty($row = $result->fetch_assoc()[0])){
      $_SESSION['name'] = $row["name"];
      $_SESSION['email'] = $row["email"];
      header('Location: index.php');
    }
    else {
      header('Location: login.php?action='.WRONG_USR_PSW_LOGIN_ACTION);
    }
    /* close statement */
    $stmt->close();
  }
  $conn->close();
?>
