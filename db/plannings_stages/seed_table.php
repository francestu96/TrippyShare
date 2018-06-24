<?php
    include("./mysql_credentials.php");

    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
  
    /* check connection */
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $query = "INSERT INTO `plannings_stages` (`planning_id`, `stage_id`) 
              VALUES 
              ('1', '1'),
              ('1', '2'),
              ('2', '3'),
              ('3', '4')
    ;";
  
    if ($conn->query($query) === TRUE) {
      echo "Table plannings_stages successfully seeded.<br/>";
    }else{
      echo "Table plannings_stages NOT seeded.<br/>";
    }
  
    $conn->close();
?>