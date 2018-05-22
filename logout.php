<?php
session_start();

/* In production porterà ad una pagina di errore */
if(!isset($_SESSION['name'])){
  session_unset();
  session_destroy();
  header('Location: index.php');
  return;
}

session_unset();
session_destroy();

header('Location: index.php');
?>
