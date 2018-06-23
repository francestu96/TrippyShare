<?php
  include("./mysql_credentials.php");

  $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);

  /* check connection */
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $query = "
    CREATE TABLE `users` (
      `id` INT NOT NULL AUTO_INCREMENT,
      `name` varchar(20) NOT NULL,
      `surname` varchar(20) NOT NULL,
      `email` varchar(30) NOT NULL UNIQUE,
      `password` varchar(40) NOT NULL,
      `birthdate` DATETIME NOT NULL,
      `description` TEXT,
      PRIMARY KEY (`id`)
    );
  ";

  if ($conn->query($query) === TRUE) {
    echo "Table users successfully created.<br/>";
  }else{
    echo "Table users NOT created.<br/>";
  }

  $conn->close();

?>