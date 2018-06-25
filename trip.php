<!DOCTYPE html>

<html>

<head>
    <title>SAW | trip</title>
    <?php require("common/header.html"); ?>
    <link rel="stylesheet" href="assets/css/lightslider.min.css">
</head>

<body>
  <?php
    require("common/costants.php");
    require("common/navbar.php");

    preloader();
  ?>
  <?php
    if(!isset($_SESSION))
        session_start();

    //check POSTed data
    if(empty($_POST['trip'])){
      header('Location: error.html');
      die();
    }
    $trip_id=$_POST['trip'];

    //if you are not logged, you cannot join trip
    empty($_SESSION['name']) ? $canUjoin = false : $canUjoin = true;

    include("./db/mysql_credentials.php");             
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);;

    /* check connection */
    if ($conn->connect_error) {
      error("Connection failed: " . $conn->connect_error, null);
    }

    //QUERY 1) select all info about POSTed planning
    $query = "SELECT * FROM plannings where id=?";

    try{
      if ($stmt = $conn->prepare($query)) {
        /* bind parameters for markers */
        if(!$stmt->bind_param("i", $trip_id))
          throw new Exception($stmt->error);

        /* execute query */
        if(!$stmt->execute())
          throw new Exception($stmt->error);

        /* get the statement result */
        $result = $stmt->get_result();

        if(!$stmt->close())
          throw new Exception($stmt->error);

        $row = $result->fetch_assoc();

        $trip_place = htmlspecialchars($row['place']);
        $trip_author = htmlspecialchars($row['author']);
        $trip_departure = htmlspecialchars($row['departure_date']);
        $trip_arrival = $row['arrival_date'];
        $trip_price = $row['price'];
        $trip_description = htmlspecialchars($row['description']);
        $trip_imagePath = $row['image_name'];
      }
      else {
        throw new Exception($stmt->error);
      }
    }
    catch(Exception $error_message){
      error($error_message, $conn);
    }

    //use info just retrived to fill out HTML with the requested trip
    $page_header = '<div class="page-head">
                      <div class="container">
                          <div class="row">
                              <div class="page-head-content">
                                  <h1 class="page-title"> '. $trip_place . '</h1>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- End page header -->';

    //QUERY 2) select the name of participat
    $query = "SELECT name, id FROM users_plannings JOIN users ON id = user_id WHERE planning_id = ?";

    try{
      if ($stmt = $conn->prepare($query)) {
        /* bind parameters for markers */
        if(!$stmt->bind_param("i", $trip_id))
          throw new Exception($stmt->error);

        /* execute query */
        if(!$stmt->execute())
          throw new Exception($stmt->error);

        /* get the statement result */
        $result = $stmt->get_result();

        if(!$stmt->close())
          throw new Exception($stmt->error);

        //display the name of all participats, if any
        $participants = '';
        if($result->num_rows === 0)
          $participants = 'No participants. Be the first one to join!';
        else
          while($row = $result->fetch_assoc())
            $participants .= '<li><a href="profile.php?id='.$row['id'].'">'. htmlspecialchars($row['name']) .'</a></li>' . PHP_EOL;
      }
      else {
        throw new Exception($stmt->error);
      }
    }
    catch(Exception $error_message){
      error($error_message, $conn);
    }

    $trip_info = '<div class="row">
                      <img src="assets/img/uploaded/'. $trip_imagePath . '" style="width:100px"/>
                  </div>
                  <div class="single-property-header">
                      <h1 class="property-title pull-left">'. $trip_place . '</h1>
                      <span class="property-price pull-right">€'. $trip_price . '</span>
                  </div>

                  <div class="col-1">
                    Click on markers to look at details
                    <div id="map" style="height: 500px; width: 100%"></div>
                  </div>
                  <!-- .property-meta -->

                  <div class="section">
                      <h4 class="s-property-title">Description</h4>
                      <div class="s-property-content">
                          <p>'. $trip_description . '</p>
                      </div>
                  </div>
                  <div class="section property-features">
                    <h4 class="s-property-title">Participants</h4>
                    <ul>
                      '. $participants . '
                    </ul>
                  </div>
                  <div class="section" style="text-align:center">
                    <form method="post" '. ($canUjoin ? 'action="insertParticipant.php"' : '') .'>
                      '. ($canUjoin ? '<input type="hidden" name="trip" value="'.$trip_id.'">' : '') .'
                      <input type="'. ($canUjoin ? 'submit' : 'button') .'"
                             value="Join!"
                             style="width:100%; '. (!$canUjoin ? 'background-color:#c2c2c2' : '') .'"
                             class="navbar-btn nav-button login"/>
                    </form>
                  </div>
                  <!-- End description area  -->';

    //QUERY 3) select the necessary info about the user who entered the trip
    $query = "SELECT DISTINCT name, surname, address, email, phone, users.image_name, users.description FROM plannings, users WHERE users.id = " . $trip_author;

    if(!($result=$conn->query($query))){
      error($conn->error, $conn);
    }

    // output data of the only row. It must be alone because in the WHERE clause we are matching the primary key of the table
    $row = $result->fetch_assoc();

    $user_name = htmlspecialchars($row['name']);
    $user_surname = htmlspecialchars($row['surname']);
    $user_address = htmlspecialchars($row['address']);
    $user_email = htmlspecialchars($row['email']);
    $user_phone = htmlspecialchars($row['phone']);
    $user_description = htmlspecialchars($row['description']);
    $user_imageName = htmlspecialchars($row['image_name']);

    //use info just retrived to fill out html with the user who entered the trip
    $user_info = '<div class="dealer-widget">
                    <div class="dealer-content">
                        <div class="inner-wrapper">
                            <div class="clear">
                                <div class="col-xs-4 col-sm-4 dealer-face">
                                    <a href="profile.php?id='.$trip_author.'">
                                        <img src="assets/img/users/'. $user_imageName. '" class="img-circle">
                                    </a>
                                </div>
                                <div class="col-xs-8 col-sm-8 ">
                                    <h3 class="dealer-name">
                                        <a href="profile.php?id='.$trip_author.'">'. $user_name. ' '. $user_surname. '</a>
                                    </h3>

                                </div>
                            </div>

                            <div class="clear">
                                <ul class="dealer-contacts">
                                    <li><i class="pe-7s-mail strong"> </i> '. $user_email. '</li>
                                    <li><i class="pe-7s-map-marker strong"> </i> '. (empty($user_address) ? 'no address added yet' : $user_address) . '</li>
                                    <li><i class="pe-7s-call strong"> </i> '. (empty($user_phone) ? 'no phone number added yet' : $user_phone) . '</li>
                                </ul>
                                <p>'. (empty($user_description) ? 'no description added yet' : $user_description) . '</p>
                            </div>

                        </div>
                    </div>
                </div>';

    //QUERY 4) select the necessary info about other trips displayed aside. They are limited to 7 because of my choise
    $query = "SELECT id, image_name, price, place FROM plannings LIMIT 7";

    if(!($result=$conn->query($query))){
      error($conn->error, $conn);
    }

    //fetch the result and fill out html with trips info
    $trips = '';
    while($row = $result->fetch_assoc()) {
      $trips .= '<div class="panel-body recent-property-widget" name="tripContainer">
                        <div id="id" value="' . $row['id']. '"></div>
                        <ul>
                          <li>
                              <div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
                                  <a href="#"><img src="assets/img/uploaded/' . $row['image_name'] . '"></a>
                              </div>
                              <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
                                  <h6>'. htmlspecialchars($row['place']) . '</h6>
                                  <span class="property-price">€' . $row['price'] . '</span>
                              </div>
                          </li>
                        </ul>
                    </div>';
    }

    //QUERY 5) select the necessary info for the stages of the requested trip
    $query = "SELECT place, description, duration, trip_type
              FROM plannings_stages JOIN stages ON stages.id = plannings_stages.stage_id
              WHERE plannings_stages.planning_id = ?";

    try{
      if ($stmt = $conn->prepare($query)) {
        /* bind parameters for markers */
        $stmt->bind_param("i", $trip_id);

        /* execute query */
        $stmt->execute();

        /* get the statement result */
        $result = $stmt->get_result();

        $stmt->close();

        //creste a different <div> for each stage. These <div> will be managed by "showMap.js" script
        $stages = '';
        while($row = $result->fetch_assoc())
          $stages .= '<div name="stages" place="'. htmlspecialchars($row['place']) .'" description="'. htmlspecialchars($row['description']) .'" trip_type="'. $row['trip_type'] .'" duration="'. htmlspecialchars($row['duration']) .'"></div>' . PHP_EOL;
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

    //finally a lot of HTML matriosk
    $other_trips = '<div class="panel panel-default sidebar-menu similar-property-wdg wow fadeInRight animated">
                      <div class="panel-heading">
                          <h3 class="panel-title">Similar Trips</h3>
                      </div>
                      <form id="myForm" action="trip.php" method="post">
                        ' . $trips . '
                      </form>
                  </div>';

    $trip_container = '<div class="col-md-8 single-property-content prp-style-1 ">
                      '   . $trip_info. '
                      '   . $stages. '
                       </div>';

    $aside_contanier = '<div class="col-md-4 p0">
                         <aside class="sidebar sidebar-property blog-asside-right">
                            '  . $user_info. '
                            '  . $other_trips. '
                          </aside>
                        </div>';

    $container = '<div class="content-area single-property" style="background-color: #FCFCFC;">&nbsp;
                    <div class="container">
                        <div class="clearfix padding-top-40" >
                          '  . $trip_container. '
                          '  . $aside_contanier. '
                        </div>
                    </div>
                </div>';

    echo $page_header . PHP_EOL . $container;

    require("common/footer.html");
    require("common/scripts.html");
  ?>

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8-kAUPVmM33rORirYxG2KhKkLnFH89-w&callback=initMap" type="text/javascript"></script>
  <script type="text/javascript" src="assets/js/myJs/submitDataToTrip.js"></script>
  <script type="text/javascript" src="assets/js/myJs/showMap.js"></script>
</body>

</html>
