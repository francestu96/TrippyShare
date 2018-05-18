<?php
  session_start();

  $required = array('departure', 'arrival', 'price', 'stages');

  foreach($required as $field) {
    if (empty($_POST[$field]))
      header('Location: error.html');
  }

  $stages = json_decode($_POST["stages"]);

  $targetFolder = 'assets/img/uploaded/'; // Relative to the root
  $tempFile = $_FILES['image']['tmp_name'];
  //$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;

  $myhash = md5_file($_FILES['image']['tmp_name']);
  $temp = explode(".", $_FILES['image']['name']);
  $extension = end($temp);

  $targetFile = rtrim($targetFolder,'/') . '/' .$myhash.'.'.$extension;
  if(file_exists($targetFile))
      header('Location: imageExistsError.html');


  // Validate the file type
  $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
  $fileParts = pathinfo($_FILES['image']['name']);
  if (in_array($fileParts['extension'],$fileTypes)) {
      move_uploaded_file($tempFile,$targetFile);
  }
  else
      header('Location: error.html');

  // Create connection
  $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $query = "INSERT INTO plannings (author, departure_date, arrival_date, price, image_path)
            VALUES ((SELECT id FROM users WHERE name LIKE ?), ?, ?, ?, ?)";

  if ($stmt = $conn->prepare($query)) {
    /* bind parameters for markers */
    $stmt->bind_param("sssss", $_SESSION['name'], $_POST['departure'], $_POST['arrival'], $_POST['price'], $tempFile);

    /* execute query */
    $stmt->execute();
    printf("Error: %s.\n", $stmt->error);
    /* close statement */
    $stmt->close();
  }
  else{
    echo "Dio cane";
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
