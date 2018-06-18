<?php
session_start();

if(!isset($_SESSION['name'])){
  header('Location: error.html');
  return;
}

session_unset();
session_destroy();

header('Location: index.php');
?>
