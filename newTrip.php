<?php     
  // Se non è ancora inizializzat la sessione la inizializzo
  if(!isset($_SESSION)) 
  { 
      session_start(); 
  }

  // Se l'utente non è loggato allora non ha senso che l'utente arrivi in questa pagina.
  if(!isset($_SESSION['name'])){
    header('index.php');
    exit();
  }
      
?>
<html>
<head>
  <title>SAW | NewTrip</title>
  <?php
    require("common/header.html");

    if(!isset($_SESSION))
        session_start();

    if(!isset($_SESSION['name'])){
      header('Location: error.html');
      return;
    }
  ?>
</head>

<body>
    <?php
      require("common/costants.php");
      require("common/navbar.php");

      preloader();
    ?>

    <!-- Inizio dell'hader contenente un'immagine e una scritta -->
    <div class="page-head">
        <div class="container">
            <div class="row">
                <div class="page-head-content">
                    <h1 class="page-title"> Add A New Trip
                </div>
            </div>
        </div>
    </div>

    <form action="checkTrip.php" enctype="multipart/form-data" id="login-form" method="post">
      <div class="register-area" style="background-color: rgb(249, 249, 249);">

          <div class="container">
            <div class="col-md-6">
                <div class="box-for overflow">
                    <div class="col-md-12 col-xs-12 register-blocks">
                        <h2>Trip</h2>
                        <div class="form-group">
                          <label for="place">Where</label>
                          <input required type="text" class="form-control" name="tripPlace">
                        </div>
                        <div class="form-group">
                            <label for="departure">Departure date</label>
                            <input required type="date" class="form-control" name="departure">
                        </div>
                        <div class="form-group">
                          <label for="arrival">Arrival date</label>
                          <input required type="date" class="form-control" name="arrival">
                        </div>
                        <div class="form-group">
                          <label for="price">Expected price</label>
                          <input required type="number" class="form-control" name="price">
                        </div>
                        <div class="form-group">
                          <label for="tripDescription">Description</label>
                          <textarea class="form-control" name="tripDescription" rows="5" cols="40"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="image">Picture</label>
                          <input type="file" accept=".jpg, .jpeg, .gif, .png" class="form-control" name="image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box-for overflow">
                    <div class="col-md-12 col-xs-12 login-blocks" id="animate">
                        <h2>Stages</h2>
                          <div class="form-group">
                            <label for="place">Place</label>
                            <input type="text" class="form-control" id="place" onchange="addMarker(this.value);">
                          </div>
                          <div class="form-group">
                            <div id="map" style="height: 50%; width: 100%"></div>
                          </div>
                          <div class="form-group">
                            <label for="days">Days of stay</label>
                            <input type="number" class="form-control" id="days" value="1">
                          </div>
                          <div class="form-group">
                            <label for="type">Type</label><br>
                            <select id="type">
                              <?php
                                include("./db/mysql_credentials.php");             
                                $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);;

                                if ($conn->connect_error) {
                                  error("Connection failed: " . $conn->connect_error, null);
                                }

                                $query = "SELECT type FROM trip_types";

                                try{
                                  if ($stmt = $conn->prepare($query)) {
                                    /* execute query */
                                    if(!$stmt->execute())
                                      throw new Exception($stmt->error);

                                    /* get the statement result */
                                    $result = $stmt->get_result();

                                    while($row = $result->fetch_assoc())
                                      echo "<option value=" . $row["type"] . ">" . $row["type"] . "</option>";

                                    if(!$stmt->close())
                                      throw new Exception($stmt->error);
                                  }
                                  else {
                                    throw new Exception($stmt->error);
                                  }
                                }
                                catch(Exception $error_message){
                                  error($error_message, $conn);
                                }

                                if(!$conn->close()){
                                  error($conn->error, null);
                                }
                              ?>
                          </select>
                          </div>
                          <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" rows="5" cols="40"></textarea>
                          </div>
                          <div class="form-group text-center">
                            <progress value="100" max="100" id="progress" style="width:250px;"></progress>
                          </div>
                          <input type="hidden" id="stages" name="stages" value="">
                          <div class="text-center">
                            <button type="button" class="navbar-btn nav-button" style='margin-right:5px' onclick="prevStage()">...Prev Stage</button>
                            <button type="submit" class="navbar-btn nav-button login" onclick="setStages()">Finish</button>
                            <button type="button" class="navbar-btn nav-button" onclick="addStage()">Next Stage...</button>
                          </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>

    <?php
      require("common/footer.html");
      require("common/scripts.html");
    ?>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8-kAUPVmM33rORirYxG2KhKkLnFH89-w&callback=initMap" type="text/javascript"></script>
    <script src="assets/js/myJs/manageStages.js"></script>
</body>

</html>
