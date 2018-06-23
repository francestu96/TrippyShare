<?php
  include("./mysql_credentials.php");

  $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);

  /* check connection */
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $query = "
  CREATE TABLE `plannings` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `place` varchar(30) NOT NULL,
    `author` int(11) NOT NULL,
    `departure_date` datetime NOT NULL,
    `arrival_date` datetime NOT NULL,
    `price` int(11) NOT NULL,
    `image_name` varchar(40) NOT NULL,
    `description` varchar(50) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`author`) REFERENCES `users` (`id`)
    );
  ";

  if ($conn->query($query) === TRUE) {
    echo "Table plannings successfully created.<br/>";
  }else{
    echo "Table plannings NOT created.<br/>";
  }

  $conn->close();

?>