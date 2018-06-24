<?php
    include("./mysql_credentials.php");

    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
  
    /* check connection */
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $query = "INSERT INTO `trip_types` (`type`) 
              VALUES
                    ('Hobby'),
                    ('Relax'),
                    ('Religious'),
                    ('Visit')
                    ;";
  
    if ($conn->query($query) === TRUE) {
      echo "Table trip_types successfully seeded.<br/>";
    }else{
      echo "Table trip_types NOT seeded.<br/>";
    }
  
    $conn->close();
?>