<?php
  include("./mysql_credentials.php");

  $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);

  /* check connection */
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $query = "
  CREATE TABLE `stages` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `trip_type` varchar(25) NOT NULL,
    `author` int(11) NOT NULL,
    `place` varchar(100) NOT NULL,
    `description` text NOT NULL,
    `duration` varchar(40) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`trip_type`) REFERENCES `trip_types` (`type`),
    FOREIGN KEY (`author`) REFERENCES `users` (`id`)
  );
  ";

  if ($conn->query($query) === TRUE) {
    echo "Table stages successfully created.<br/>";
  }else{
    echo "Table stages NOT created.<br/>";
  }

  $conn->close();

?>