<?php
  require "utilities.php";
  const MALE = "male";
  const FEMALE = "female";

  $required = array('name', 'surname', 'gender', 'birthDate', 'birthCity');

  foreach($required as $field) {
    if (empty($_POST[$field])) {
      dontHackMySite();
      return;
    }
  }

  if($_POST['gender'] != MALE && $_POST['gender'] != FEMALE){
    dontHackMySite();
    return;
  }

  $name=$_POST['name'];
  $birthCity=$_POST['birthCity'];
  $surname=$_POST['surname'];
  $gender=$_POST['gender'];
  $birthDate=strtotime($_POST['birthDate']);

  $fiscalCode = getFiscalCode($name, $surname, $gender == MALE ? 0 : 40, $birthDate, $birthCity);

  if (empty($fiscalCode))
    dontHackMySite();
  else{
    echo "<center><h2>Your fiscal code is: $fiscalCode </h2>";
    echo "<input type=\"button\" value=\"Home\" onclick=\"document.location.href='index.php'\"></center>";
  }
?>
