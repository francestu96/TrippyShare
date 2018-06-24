<?php
    include("./mysql_credentials.php");

    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
  
    /* check connection */
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  
    $query = "INSERT INTO `users_plannings` (`user_id`, `planning_id`) 
              VALUES 
                    ('2', '1'),
                    ('3', '2'),
                    ('1', '3')
              ;";

    if ($conn->query($query) === TRUE) {
      echo "Table users_plannings successfully created.<br/>";
    }else{
      echo "Table users_plannings NOT created.<br/>";
    }
  
    $conn->close();
?>