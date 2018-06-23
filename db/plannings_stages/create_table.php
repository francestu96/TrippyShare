<?php
  include("./mysql_credentials.php");

  $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);

  /* check connection */
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $query = "
  CREATE TABLE `plannings_stages` (
    `planning_id` int(11) NOT NULL,
    `stage_id` int(11) NOT NULL,
    PRIMARY KEY (`planning_id`,`stage_id`),
    FOREIGN KEY (`planning_id`) REFERENCES `plannings` (`id`),
    FOREIGN KEY (`stage_id`) REFERENCES `stages` (`id`)
    );
  ";

  if ($conn->query($query) === TRUE) {
    echo "Table plannings_stages successfully created.<br/>";
  }else{
    echo "Table plannings_stages NOT created.<br/>";
  }

  $conn->close();

?>