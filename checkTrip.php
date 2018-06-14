<?php
  session_start();

  if(empty($_POST['tripDescription']))
    $_POST['tripDescription'] = "No description";

  $required = array('departure', 'arrival', 'price', 'stages');

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

  //controllo se i luoghi sono esistenti
  foreach($stages as $stage){
    $resp = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . $stage->place . "&key=AIzaSyB8-kAUPVmM33rORirYxG2KhKkLnFH89-w"));
    if($resp->status !== "OK"){
      header('Location: error.html');
      die();
    }
  }

  $fileName = "empty.png"; //immagine non caricata e viene assegnata un immagine vuota

  // Create connection
  $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  //inizia la transazione
  $conn->begin_transaction();

  try{
    //PRIMA QUERY PER INSERIRE IL PLANNING
    $query = "INSERT INTO plannings (author, departure_date, arrival_date, price, image_path, description)
              VALUES ((SELECT id FROM users WHERE email LIKE ?), ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
      /* bind parameters for markers */
      $stmt->bind_param("ssssss", $_SESSION['email'], $_POST['departure'], $_POST['arrival'], $_POST['price'], $fileName, $_POST['tripDescription']);

      /* execute query */
      $stmt->execute();

      /* close statement */
      $stmt->close();
    }
    else{
      throw new Exception();
    }

    //SECONDA QUERY PER INSERIRE LE TAPPE
    $query = "INSERT INTO stages (author, trip_type, place, description, duration)
              VALUES ((SELECT id FROM users WHERE email LIKE ?), ?, ?, ?, ?)";

    foreach($stages as $stage){
      if ($stmt = $conn->prepare($query)) {
        /* bind parameters for markers */
        $stmt->bind_param("sssss", $_SESSION['email'], $stage->type, $stage->place, $stage->description, $stage->days);

        /* execute query */
        $stmt->execute();

        /* close statement */
        $stmt->close();
      }
      else{
        throw new Exception();
      }

      //TERZA QUERY PER INSERIRE I DATI NELLA TABELLA MOLTI A MOLTI plannings_stages
      $conn->query("INSERT INTO plannings_stages (planning_id, stage) VALUES ((SELECT MAX(id) FROM plannings), (SELECT MAX(id) FROM stages));");
    }

    //MEMORIZZAZIONE DEL FILE IN POST SE PRESENTE
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
      }
      else{
          throw new Exception();
      }
    }

    //TUTTO ANDATO A BUON FINE E FACCIO LA COMMIT
    $conn->commit();
  }
  catch(Exception $e){
    $conn->rollback();
    $conn->close();
    header('Location: error.html');
    die();
  }

  $conn->close();

  echo "</p>";
  echo '<pre>';
  echo 'Here is some more debugging info:';
  print_r($_FILES);
  print "</pre>";

  echo "Stages:<br>";
  foreach($stages as $stage){
    echo "Place: " . $stage->place . "<br>";
    echo "Days: " . $stage->days . "<br>";
    echo "Type: " . $stage->type . "<br>";
    echo "Description: " . $stage->description . "<br><br>";
  }
?>
