<?php
  include("./mysql_credentials.php");

  $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);

  /* check connection */
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $query = "
    CREATE TABLE `messages` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `sender` int(11) NOT NULL,
      `receiver` int(11) NOT NULL,
      `date` datetime NOT NULL,
      `message` text NOT NULL,
      PRIMARY KEY (`id`),
      FOREIGN KEY (`sender`) REFERENCES `users` (`id`),
      FOREIGN KEY (`receiver`) REFERENCES `users` (`id`)
    );
  ";

  if ($conn->query($query) === TRUE) {
    echo "Table messages successfully created.<br/>";
  }else{
    echo "Table messages NOT created.<br/>";
  }

  $conn->close();

?>