<?php
  include('db/mysql_credentials.php');
  require("common/costants.php");
  if(!isset($_SESSION)){
      session_start();
  }

  if(empty($_POST['receiverId']) || empty($_POST['message'])){
    header('Location: error.html');
    die();
  }

  // Create connection
  $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);

  // Check connection
  if ($conn->connect_error)
    error("Connection failed: " . $conn->connect_error, null);

  //retrive id by the email
  $querySelectId = "SELECT id FROM users WHERE email=?";

  try{
    if (!($stmtSelectId = $conn->prepare($querySelectId)))
      throw new Exception($stmtSelectId->error);

    /* bind parameters for markers */
    if(!($stmtSelectId->bind_param("s", $_SESSION['email'])))
      throw new Exception($stmtSelectId->error);

    /* execute query */
    if(!$stmtSelectId->execute())
      throw new Exception($stmtSelectId->error);

    /* get the statement result */
    $result = $stmtSelectId->get_result();
    $sender = ($result->fetch_assoc())['id'];

    /* close statement */
    if(!$stmtSelectId->close())
      throw new Exception($stmtSelectId->error);
    }
  catch(Exception $error_message){
    error($error_message, $conn);
  }

  $timestamp = date('Y-m-d H:i:s');
  $query = "INSERT INTO messages (sender, receiver, date, message, message_read) VALUES (?, ?, ?, ?, 'no')";

  try{
    if(!($stmt = $conn->prepare($query)))
      throw new Exception($conn->error);

    /* bind parameters for markers */
    if(!$stmt->bind_param("iiss", $sender, $_POST["receiverId"], $timestamp, $_POST['message']))
      throw new Exception($stmt->error);

    if(!$stmt->execute())
      throw new Exception($stmt->error);

    /* close statement */
    if(!$stmt->close())
      throw new Exception($stmt->error);
  }
  catch(Exception $error_message){
    error($error_message, $conn);
  }
  if(!$conn->close())
    error($conn->error, null);

  header("Location:listMessages.php");
?>
