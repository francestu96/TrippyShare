<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<?php

  // Se non è ancora inizializzat la sessione la inizializzo
  if(!isset($_SESSION))
  {
      session_start();
  }

  // Devo essere loggato per accedere a questa pagina
  if(!isset($_SESSION['name'])){
    header('Location: login.php');
    exit();
  }

?>
<html class="no-js">
<!--<![endif]-->

<head>
    <title>SAW | Profile</title>
    <?php require_once("common/header.html"); ?>
</head>

<body>
    <?php
        require_once("common/costants.php");
        require_once("common/navbar.php");

        preloader();
    ?>

        <div class="page-head">
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">Profile</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-area user-profiel" style="background-color: #FCFCFC;">

            <?php
            include("utilities.php");
            include("./db/mysql_credentials.php");
            $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
            // Controllo se devo modificare il mio profilo o voglio visualizzarne uno di un utente
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $query = "SELECT * FROM users WHERE id = ?";
            } else{
                $query = "SELECT * FROM users WHERE email = ?";
            }

            // Cerco i dati di questo profilo
            try{
              if (!($stmt = $conn->prepare($query)))
                throw new Exception($stmt->error);

              /* bind parameters for markers */
              if(isset($_GET['id']) && !empty($_GET['id'])){
                if(!($stmt->bind_param("i", $_GET['id'])))
                  throw new Exception($stmt->error);
              }
              else{
                if(!($stmt->bind_param("s", $_SESSION['email'])))
                  throw new Exception($stmt->error);
              }

              if(!($stmt->execute()))
                throw new Exception($stmt->error);

              $result = $stmt->get_result();
              // output data of each row
              $row = $result->fetch_assoc();

              $name = htmlspecialchars($row['name']);
              $surname = htmlspecialchars($row['surname']);
              $email = htmlspecialchars($row['email']);
              $birthday = $row['birthdate'];
              $description = htmlspecialchars($row['description']);
              $gender = $row['gender'];
              $nationality = htmlspecialchars($row['nationality']);
              $address = htmlspecialchars($row['address']);
              $phone = htmlspecialchars($row['phone']);
              $fileName = htmlspecialchars($row['image_name']);

              /* close statement */
              if(!$stmt->close())
                throw new Exception($stmt->error);
            }
            catch(Exception $error_message){
              error($error_message, $conn);
            }


                // Prova ad effettuare la SELECT
                /* get the statement result */

            if(isset($_GET['id']) && !empty($_GET['id'])){
                // voglio visualizzare il profilo di un utente
                require_once("viewProfile.php");
            } else{
                // Voglio modificare il mio profilo
                require_once("changeProfile.php");
            }
            $conn->close();
            ?>
        </div>
    <?php
      require("common/footer.html");
      require("common/scripts.html");
    ?>
</body>

</html>
