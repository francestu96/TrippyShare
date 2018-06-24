<?php
    include("./mysql_credentials.php");

    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
  
    /* check connection */
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $query = "INSERT INTO `stages` (`id`, `trip_type`, `author`, `place`, `description`, `duration`) 
              VALUES 
                    (NULL, 'Relax', '2', 'Genoa, Italy', 'Visit Lanterna', 'One day'),
                    (NULL, 'Visit', '2', 'Milan', 'Visit Milan', 'Two days'),
                    (NULL, 'Visit', '3', 'Paris', 'Visit Paris', 'Three days'),
                    (NULL, 'Relax', '1', 'Barcelona', 'Party all days', 'Three days')
    ;";
  
    if ($conn->query($query) === TRUE) {
      echo "Table stages successfully seeded.<br/>";
    }else{
      echo "Table stages NOT seeded.<br/>";
    }
  
    $conn->close();
?>