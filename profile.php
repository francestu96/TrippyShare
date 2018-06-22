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

        <div class="content-area user-profiel" style="background-color: #FCFCFC;">

            <?php
            include("utilities.php");
            include("./db/mysql_credentials.php");
            $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
            // Controllo se devo modificare il mio profilo o voglio visualizzarne uno di un utente
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $query = "SELECT * FROM users WHERE id = ".$_GET['id'];
            } else{
                $query = "SELECT * FROM users WHERE email = '".$_SESSION['email']."'";
            }            

            // Cerco i dati di questo profilo

            if ($stmt = $conn->prepare($query)) {
                /* bind parameters for markers */
                $stmt->bind_param("s", $id);

                if ($stmt->execute()) {
                    $result = $stmt->get_result();

                    if ($result->num_rows === 1) {
                    // output data of each row
                        while($row = $result->fetch_assoc()) {
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
                        }
                    }
                    else {
                        $_SESSION['error'] = "Errore durante la query di ricerca dell'utente";
                        header('Location: index.php');
                        exit();
                    }

                }else {
                    // si è verificato qualche errore
                    $_SESSION['error'] = "Errore durante la query di ricerca dell'utente";
                    header('Location: index.php');
                    exit();
                }


                // Prova ad effettuare la SELECT
                /* get the statement result */
                
                
            }

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
</body>

</html>