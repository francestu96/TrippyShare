<?php
  include("./mysql_credentials.php");

  $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);

  /* check connection */
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $query = "
  CREATE TABLE `ratings` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `stage` int(11) NOT NULL,
    `author` int(11) NOT NULL,
    `rating` int(1) NOT NULL DEFAULT '0',
    `comment` text NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`stage`) REFERENCES `stages` (`id`),
    FOREIGN KEY (`author`) REFERENCES `users` (`id`)
    );
  ";

  if ($conn->query($query) === TRUE) {
    echo "Table ratings successfully created.<br/>";
  }else{
    echo "Table ratings NOT created.<br/>";
  }

  $conn->close();

?>