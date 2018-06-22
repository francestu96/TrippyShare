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
    header('login.php');
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

        <div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;

            <?php
            require_once("utilities.php");

            // Controllo se devo modificare il mio profilo o voglio visualizzarne uno di un utente
            if($isset($_GET['id']) && !empty($_GET['id'])){
                $query = "SELECT * FROM users WHERE id = ".$_GET['id'];
            } else{
                $query = "SELECT * FROM users WHERE email = '".$_SESSION['email']."'";

            }

            // Cerco i dati di questo profilo

            if ($stmt = $conn->prepare($query)) {
                /* bind parameters for markers */
                $stmt->bind_param("s", $id);

                // Prova ad effettuare la SELECT
                /* get the statement result */
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    
                    $name = htmlspecialchars($raw['name']);
                    $surname = htmlspecialchars($raw['surname']);
                    $email = htmlspecialchars($raw['email']);
                    $birthday = $raw['birthday'];
                    $description = htmlspecialchars($raw['description']);
                    $gender = $raw['gender'];
                    $nationality = htmlspecialchars($raw['nationality']);
                    $address = htmlspecialchars($raw['address']);
                    $phone = htmlspecialchars($raw['phone']);
                    $fileName = htmlspecialchars($raw['phone']);
                }
                }
                else {
                header('Location: index.php');
                exit();
                }
                
            }

            if($isset($_GET['id']) && !empty($_GET['id'])){
                // voglio visualizzare il profilo di un utente
                require_once("viewProfile.php");
            } else{
                // Voglio modificare il mio profilo
                require_once("changeProfile.php");
            }
        
            ?>
        </div>
</body>

</html>