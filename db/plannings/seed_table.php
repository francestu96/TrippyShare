<?php
    include("./mysql_credentials.php");

    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
  
    /* check connection */
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $query = "INSERT INTO `plannings` (`id`, `place`, `author`, `departure_date`, `arrival_date`, `price`, `image_name`, `description`) 
              VALUES 
                    (NULL, 'Italy', '2', '2018-07-08 09:05:00', '2018-07-12 10:00:00', '600', 'italy.png', 'A nice trip in Italy'),
                    (NULL, 'France', '3', '2018-07-10 09:05:00', '2018-07-12 10:00:00', '800', 'france.png', 'A nice trip in France'),
                    (NULL, 'Spain', '1', '2018-07-9 09:05:00', '2018-07-12 10:00:00', '900', 'spain.png', 'A nice trip in Spain')
                    ";
    
    if ($conn->query($query) === TRUE) {
      echo "Table plannings successfully seeded.<br/>";
    }else{
      echo "Table plannings NOT seeded.<br/>";
    }
  
    $conn->close();
?>