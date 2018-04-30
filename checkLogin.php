<?php

  // ESERCIZIO 2
  /**
   * Permette di far loggare un utente registrato su myusers.txt
   */
  require "utilities.php";
  $required = array('username', 'password_signin');

  foreach($required as $field) {
    if (empty($_POST[$field])) {
      echo "Il campo: ".$field." e' obbligatorio.";
      return;
    }
  }

  // Get dei parametri
  $username = trim($_POST['username']);
  $password = sha1($_POST['password_signin']);


  // Check se l'username esiste
  $txt_file = file_get_contents('myusers.txt');
  $rows = explode("\n", $txt_file);
  array_shift($rows);

  // findUser è nel file utitlities.php
  $name = findUser($rows, $username, $password);
  
  if(!empty($name)){
    session_start();
    $_SESSION['username'] = $username;
    header('Location: index.php');
    // echo "<center><h2>Congratulations $name, you are logged in!</h2>";
    // echo "<input type=\"button\" value=\"Home\" onclick=\"document.location.href='index.html'\"></center>";
  }
  else{
    echo "<center><h2>Login failed!</h2>";
    echo "<input type=\"button\" value=\"Login\" onclick=\"history.back(-1)\"></center>";
  }

?>
