<?php
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
    die("Connection failed: " . $conn->connect_error);
  }

  $query = "INSERT INTO users_plannings (user_id, planning_id) VALUES ((SELECT id FROM users WHERE email = ?), ?)";

  $stmt = $conn->prepare($query);

  if ($stmt = $conn->prepare($query)) {
    /* bind parameters for markers */
    $stmt->bind_param("si", $_SESSION["email"], $trip_id);

    /* execute query */
    $stmt->execute();

    /* close statement */
    $stmt->close();
  }
  else{
    header('Location: error.html');
    $conn->close();
    die();
  }

  $conn->close();
  header('Location: index.php');
?>
