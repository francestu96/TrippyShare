<?php
  require("common/costants.php");
  if(!isset($_SESSION))
      session_start();

  if(empty($_SESSION["email"])){
    header("Location: error.html");
    die();
  }

  //check POSTed data
  if(empty($_POST['trip'])){
    header('Location: error.html');
    die();
  }
  $trip_id=$_POST['trip'];

  $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");

  /* check connection */
  if ($conn->connect_error) {
      error("Connection failed: " . $conn->connect_error, null);
  }

  //insert the user to N to N table users_plannings with its id and the id of the planning
    $query = "INSERT IGNORE INTO users_plannings (user_id, planning_id) VALUES ((SELECT id FROM users WHERE email = ?), ?)";

    try{
      if($stmt = $conn->prepare($query)) {
      /* bind parameters for markers */
      if(!$stmt->bind_param("si", $_SESSION["email"], $trip_id))
        throw new Exception($stmt->error);

      /* execute query */
      if(!$stmt->execute())
        throw new Exception($stmt->error);

      /* close statement */
      if(!$stmt->close())
        throw new Exception($stmt->error);
    }
    else {
      throw new Exception($conn->error);
    }
  }
  catch(Exception $error_message){
    error($error_message, $conn);
  }

  if(!$conn->close()){
    error($conn->error, null);
  }
  header('Location: index.php?action='.SUCCESSFUL_JOIN_TRIP);
?>
