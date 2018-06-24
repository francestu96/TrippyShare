<?php
    include("./mysql_credentials.php");

    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
  
    /* check connection */
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  
    $query = "INSERT INTO `S4166252`.`users` (`id`, `name`, `surname`, `email`, `password`, `birthdate`, `description`) 
              VALUES 
                      (NULL, 'Mario', 'Rossi', 'mario@rossi.it', 'd8a35e56b27694deda71223a47a98fc7bb96a94a', '1990-05-01', NULL),
                      (NULL, 'Paolo', 'Rossi', 'paolo@rossi.it', 'd8a35e56b27694deda71223a47a98fc7bb96a94a', '1992-05-01', NULL),
                      (NULL, 'Luigi', 'Sciolla', 'luigi@sciolla.it', 'd8a35e56b27694deda71223a47a98fc7bb96a94a', '1996-01-20', NULL),
                      (NULL, 'Francesco', 'Stucci', 'francesco@stucci.it', 'd8a35e56b27694deda71223a47a98fc7bb96a94a', '1996-07-15', NULL)
                      ;";
  
    if ($conn->query($query) === TRUE) {
      echo "Table users successfully created.<br/>";
    }else{
      echo "Table users NOT created.<br/>";
    }
  
    $conn->close();
?>