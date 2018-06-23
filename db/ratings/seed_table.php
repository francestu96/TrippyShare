<?php
    include("./mysql_credentials.php");

    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
  
    /* check connection */
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $query = ";";
    //$query = "INSERT INTO `S4166252`.`users` (`id`, `name`, `surname`, `email`, `password`, `birthdate`, `description`) VALUES (NULL, 'Mario', 'Rossi', 'mario@rossi.it', 'd8a35e56b27694deda71223a47a98fc7bb96a94a', '2018-05-01 00:00:00', NULL);";
  
    if ($conn->query($query) === TRUE) {
      echo "Table ratings successfully seeded.<br/>";
    }else{
      echo "Table ratings NOT seeded.<br/>";
    }
  
    $conn->close();
?>