<html>
<head>
  <title>SAW | NewTrip</title>
  <?php
    require("common/header.html");

    session_start();
    if(!isset($_SESSION['name'])){
      header('Location: error.html');
      return;
    }
  ?>
</head>

<body>
    <?php require("common/navbar.php"); ?>

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


    <!-- Area di login -->
    <form action="#" id="login-form" method="post">
      <div class="register-area" style="background-color: rgb(249, 249, 249);">

          <div class="container">
            <div class="col-md-6">
                <div class="box-for overflow">
                    <div class="col-md-12 col-xs-12 register-blocks">
                        <h2>Trip</h2>
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
                          <label for="image">Picture</label>
                          <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6" id="animate">
                <div class="box-for overflow">
                    <div class="col-md-12 col-xs-12 login-blocks">
                        <h2>Stages</h2>
                          <div class="form-group">
                            <label for="place">Place</label>
                            <input required type="text" class="form-control" id="place">
                          </div>
                          <div class="form-group">
                            <label for="days">Days of stay</label>
                            <input required type="number" class="form-control" id="days">
                          </div>
                          <div class="form-group">
                            <label for="type">Type</label><br>
                            <select id="type">
                              <?php
                                $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");
                                if ($conn->connect_error)
                                    die("Connection failed: " . $conn->connect_error);

                                $query = "SELECT type FROM trip_types";
                                $stmt = $conn->prepare($query);
                                if ($stmt = $conn->prepare($query)) {
                                  /* execute query */
                                  $stmt->execute();
                                  /* get the statement result */
                                  $result = $stmt->get_result();
                                  while($row = $result->fetch_assoc())
                                    echo "<option value=" . $row["type"] . ">" . $row["type"] . "</option>";
                                  $stmt->close();
                                }
                                $conn->close();
                              ?>
                          </select>
                          </div>
                          <div class="form-group">
                            <label for="description">Description</label>
                            <textarea required class="form-control" id="description" rows="5" cols="40"></textarea>
                          </div>
                          <input type="hidden" name="duration" value="">
                          <input type="hidden" name="days" value="">
                          <input type="hidden" name="type" value="">
                          <input type="hidden" name="description" value="">
                          <div class="text-center">
                              <button type="submit" class="navbar-btn nav-button login">Finish</button>
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
    <script src="assets/js/myJs/manageTrip.js"></script>
</body>

</html>
