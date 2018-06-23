<?php
  include("./mysql_credentials.php");

  $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);

  /* check connection */
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $query = "
  CREATE TABLE `users_plannings` (
    `user_id` int(11) NOT NULL,
    `planning_id` int(11) NOT NULL,
    PRIMARY KEY (`user_id`, `planning_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
    FOREIGN KEY (`planning_id`) REFERENCES `plannings` (`id`)
  );
  ";

  if ($conn->query($query) === TRUE) {
    echo "Table users_plannings successfully created.<br/>";
  }else{
    echo "Table users_plannings NOT created.<br/>";
  }

  $conn->close();

?>