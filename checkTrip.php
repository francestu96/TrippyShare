<?php
  require("common/costants.php");
  if(!isset($_SESSION))
      session_start();

  if(empty($_POST['tripDescription']))
    $_POST['tripDescription'] = "No description";

  $required = array('tripPlace', 'departure', 'arrival', 'price', 'stages');

  foreach($required as $field) {
    if (empty($_POST[$field])){
      header('Location: error.html');
      die();
    }
  }

  $stages = json_decode($_POST["stages"]);

  $required = array('days', 'place', 'type', 'description');

  foreach($stages as $stage) {
    foreach ($required as $field) {
      if (empty($stage->$field)){
        header('Location: error.html');
        die();
      }
    }
  }

  //check if places are valid
  foreach($stages as $stage){
    $place = str_replace(" ", "&",  $stage->place);
    $resp = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . $place . "&key=AIzaSyB8-kAUPVmM33rORirYxG2KhKkLnFH89-w"));
    if($resp->status !== "OK"){
      header('Location: error.html');
      die();
    }
  }

  // Create connection
  $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");
  // Check connection
  if ($conn->connect_error) {
      error("Connection failed: " . $conn->connect_error, null);
  }

  if(!$conn->begin_transaction())
    error("Begin transaction failed: " . $conn->error, null);

  try{
    //Process to store file
    if(is_uploaded_file($_FILES['image']['tmp_name'])){
      $targetFolder = 'assets/img/uploaded/'; // Relative to the root
      $tempFile = $_FILES['image']['tmp_name'];

      $myhash = md5_file($_FILES['image']['tmp_name']);
      $temp = explode(".", $_FILES['image']['name']);
      $extension = end($temp);
      $fileName = $myhash.'.'.$extension;

      $targetFile = rtrim($targetFolder,'/') . '/' .$myhash.'.'.$extension;
      for($i = 1; file_exists($targetFile); $i++)
          $targetFile = rtrim($targetFolder,'/') . '/' .$myhash + $i.'.'.$extension;

      // Validate the file type
      $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
      $fileParts = pathinfo($_FILES['image']['name']);

      if (in_array($fileParts['extension'],$fileTypes)) {
          move_uploaded_file($tempFile,$targetFile);
          $fileName = $targetFile;
      }
      else{
          throw new Exception("File corrupted");
      }
    }

    //QUERY 1) insert planning
    $query = "INSERT INTO plannings (author, place, departure_date, arrival_date, price, image_name, description)
              VALUES ((SELECT id FROM users WHERE email LIKE ?), ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
      /* bind parameters for markers */
      if(!($stmt->bind_param("sssssss", $_SESSION['email'], $_POST['tripPlace'], $_POST['departure'], $_POST['arrival'], $_POST['price'], $fileName, $_POST['tripDescription'])))
        throw new Exception($stmt->error);

      /* execute query */
      if(!$stmt->execute())
        throw new Exception($stmt->error);

      /* close statement */
      if(!$stmt->close())
        throw new Exception($stmt->error);
    }
    else{
      throw new Exception($stmt->error);
    }

    //QUERY 2) insert stages
    $query = "INSERT INTO stages (author, trip_type, place, description, duration)
              VALUES ((SELECT id FROM users WHERE email LIKE ?), ?, ?, ?, ?)";

    foreach($stages as $stage){
      if ($stmt = $conn->prepare($query)) {
        /* bind parameters for markers */
        if(!$stmt->bind_param("sssss", $_SESSION['email'], $stage->type, $stage->place, $stage->description, $stage->days))
          throw new Exception($stmt->error);

        /* execute query */
        if(!$stmt->execute())
          throw new Exception($stmt->error);

        /* close statement */
        if(!$stmt->close())
          throw new Exception($stmt->error);
      }
      else{
        throw new Exception($stmt->error);
      }

      //QUERY 3) insert the last planning_id and the last stage_id in the N to N table plannings_stages
      if(!$conn->query("INSERT INTO plannings_stages (planning_id, stage_id) VALUES ((SELECT MAX(id) FROM plannings), (SELECT MAX(id) FROM stages));"))
        error($conn->error, $conn);
    }

    //everything fine
    $conn->commit();
  }
  catch(Exception $error_message){
    //if something goes wrong, need to rollback
    if(!$conn->rollback())
      error($conn->error, $conn);

    error($error_message, $conn);
  }

  if(!$conn->close()){
    error($conn->error, null);
  }

  header('Location: index.php?action=1');
?>
