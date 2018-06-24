<?php
    include("./mysql_credentials.php");

    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
  
    /* check connection */
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $query = "INSERT INTO `messages` (`id`, `sender`, `receiver`, `date`, `message`) 
              VALUES 
                    (NULL, '1', '2', '2018-06-24 11:17:37', 'I\'d like to come to Italy, can I join you?'),
                    (NULL, '2', '1', '2018-06-24 13:17:37', 'Sure'),
                    (NULL, '1', '3', '2018-06-25 11:17:37', 'I\'d like to come to France, can I join you?')
                    ;
    ";
  
    if ($conn->query($query) === TRUE) {
      echo "Table messages successfully seeded.<br/>";
    }else{
      echo "Table messages NOT seeded.<br/>";
    }
  
    $conn->close();
?>