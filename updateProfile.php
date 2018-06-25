<?php
  include("common/costants.php");
  include("db/mysql_credentials.php");
  include("utilities.php");
  if(!isset($_SESSION)){
      session_start();
  }
  if(!isset($_SESSION['name'])){
    header('Location: login.php');
    exit();
  }
  $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);

  // Check connection
  if ($conn->connect_error) {
    header('Location: profile.php');
    exit();
  }


  // Getting post params
  $email = trimIfString($_POST['email']);
  if(isset($_POST['password']) && !empty($_POST['password'])){
    $password = sha1(trim($_POST['password']));  
  }else{
    $password = null;
  }
  $birthday = $_POST['birthday'];
  if($birthday == ''){
    $birthday = NULL;
  }
  $description = substr($_POST['description'],0,500);
  $gender = $_POST['gender'];
  $nationality = trimIfString($_POST['nationality']);
  $address = trimIfString($_POST['address']);
  $phone = trimIfString($_POST['phone']);
  $fileName = "no-photo.jpg";

  //Process to store file
  if(is_uploaded_file($_FILES['profile-image']['tmp_name'])){
    $targetFolder = 'assets/img/users/'; // Relative to the root
    $tempFile = $_FILES['profile-image']['tmp_name'];
    $myhash = md5_file($_FILES['profile-image']['tmp_name']);
    $temp = explode(".", $_FILES['profile-image']['name']);
    $extension = end($temp);
    $fileName = $myhash.'.'.$extension;
  
    $targetFile = rtrim($targetFolder,'/') . '/' .$myhash.'.'.$extension;
    for($i = 1; file_exists($targetFile); $i++){
      $targetFile = rtrim($targetFolder,'/') . '/' .$myhash + $i.'.'.$extension;
    }
    

    // Validate the file type
    $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
    $fileParts = pathinfo($_FILES['profile-image']['name']);
  
    if (in_array($fileParts['extension'],$fileTypes)) {
      move_uploaded_file($tempFile,$targetFile);
    }
    else{
      // C'é un errore
      $fileName = "no-photo.jpg";
    }
  }

  // Creating query only if are present using COALESCE
  $query = "UPDATE users 
            SET  
                email = COALESCE(?,email),
                password = COALESCE(?,password),
                birthdate = ?,
                description = COALESCE(?,description),
                gender = COALESCE(?,gender),
                nationality = COALESCE(?,nationality),
                address = COALESCE(?,address),
                phone = COALESCE(?,phone),
                image_name = COALESCE(?,image_name)
            WHERE 
                email LIKE ?";
  if ($stmt = $conn->prepare($query)) {
    /* bind parameters for markers */
    $stmt->bind_param("ssssssssss", $email, $password, $birthday, $description, $gender, $nationality, $address, $phone, $fileName, $_SESSION['email']);
    $status = $stmt->execute();
    // Prova ad effettuare la update
    if ($status === true) {
      // Update avvenuta con successo
      $_SESSION['email'] = $email;
      header('Location: profile.php');
      exit();
    } else {
      //echo $stmt->error;
      // Se si è verificato qualche errore
      header('Location: profile.php');
      exit();
    }
  }else {
    //echo $conn->error;
    // Errore nella connessione al db
    header('Location: index.php');
  }

?>