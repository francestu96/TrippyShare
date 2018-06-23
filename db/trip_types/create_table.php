<?php
  include("./mysql_credentials.php");

  $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);

  /* check connection */
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $query = "
    CREATE TABLE `trip_types` (
    `type` varchar(25) NOT NULL,
      PRIMARY KEY (`type`)
      );
    ";

  if ($conn->query($query) === TRUE) {
    echo "Table trip_types successfully created.<br/>";
  }else{
    echo "Table trip_types NOT created.<br/>";
  }

  $conn->close();

?>