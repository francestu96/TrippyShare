<?php
  /**
   * A partire da un username e una password mi permette di vedere se è presente in rows
   */
  function findUser($rows, $username, $password){
    foreach ($rows as $row => $data) {
      if(substr($data, 0, 1) == "#")
        continue;

      $tok = $name = strtok($data, ",");

      for($i=0; $tok != false; $i++){
        $passFind = false;
        $userFind = false;

        $tok = strtok(",");

        if($username == $tok)
          $userFind = true;

        $tok = strtok(",");
        if($password == $tok)
          $passFind = true;


        if($passFind && $userFind)
          return $name;

        $tok = $name = strtok(",");
      }
    }

    return "";
  }

  /**
   * Mi permette di lasciare null facendo il trim di una stringa null
   */
  function trimIfString($value) {
    return is_string($value) ? trim($value) : $value;
  }

  /**
   * Restituisce un id a partire da una mail
   */
  function findId($mail){
    $id = null;
    $query = "SELECT id FROM users
            WHERE email = ?";

    if ($stmt = $conn->prepare($query)) {
      /* bind parameters for markers */
      $stmt->bind_param("s", $mail);

      // Prova ad effettuare la SELECT
      /* get the statement result */
      $result = $stmt->get_result();

      if ($result->num_rows === 1) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

          $id = htmlspecialchars($raw['id']);
        }
      }
    }
    return $id;
  }


?>
