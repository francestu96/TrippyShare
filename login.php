<?php
  require "utilities.php";
  $required = array('username', 'password_signin');

  foreach($required as $field) {
    if (empty($_POST[$field])) {
      dontHackMySite();
      return;
    }
  }

  $username = $_POST['username'];
  $password = sha1($_POST['password_signin']);

  $txt_file = file_get_contents('myusers.txt');
  $rows = explode("\n", $txt_file);
  array_shift($rows);

  $name = findUser($rows, $username, $password);

  if(!empty($name)){
    echo "<center><h2>Congratulations $name, you are logged in!</h2>";
    echo "<input type=\"button\" value=\"Home\" onclick=\"document.location.href='index.html'\"></center>";
  }
  else{
    echo "<center><h2>You are not registered yet. Sign in now!</h2>";
    echo "<input type=\"button\" value=\"Login\" onclick=\"history.back(-1)\"></center>";
  }

?>
