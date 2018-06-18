<!DOCTYPE html>

<html>

<head>
    <title>SAW | trip</title>
    <?php require("common/header.html"); ?>
    <link rel="stylesheet" href="assets/css/lightslider.min.css">
</head>

<body>
  <?php require("common/navbar.php"); ?>
  <?php
    if(empty($_POST['trip'])){
      header('Location: error.html');
      die();
    }
    $trip_id=$_POST['trip'];
    $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");

    /* check connection */
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM plannings where id=?";

    $stmt = $conn->prepare($query);
    if ($stmt = $conn->prepare($query)) {
      /* bind parameters for markers */
      $stmt->bind_param("i", $trip_id);

      /* execute query */
      $stmt->execute();

      /* get the statement result */
      $result = $stmt->get_result();

      if ($result->num_rows === 1) {
      // output data of each row
        while($row = $result->fetch_assoc()) {
          $trip_place=$row['place'];
          $trip_author=$row['author'];
          $trip_departure=$row['departure_date'];
          $trip_arrival=$row['arrival_date'];
          $trip_price=$row['price'];
          $trip_description=$row['description'];
          $trip_imagePath=$row['image_path'];
        }
      }
      else {
        header('Location: error.html');
      }

      /* close statement */
      $stmt->close();
    }

  empty($_SESSION['name']) ? $canUjoin = false : $canUjoin = true;

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

  $trip_info = '<div class="content-area single-property" style="background-color: #FCFCFC;">&nbsp;
                      <div class="container">

                          <div class="clearfix padding-top-40" >

                              <div class="col-md-8 single-property-content prp-style-1 ">
                                  <div class="row">
                                    <img src="assets/img/uploaded/'. $trip_imagePath . '" style="width:100%"/>
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
                                  <div class="section" style="text-align:center">
                                    <button style="width:100%" type="button" class="navbar-btn nav-button '. ($canUjoin ? 'login' : '') .'">Join!</button>
                                  </div>
                                  <!-- End description area  -->
                              </div>';


    $user_info = '            <div class="col-md-4 p0">
                                  <aside class="sidebar sidebar-property blog-asside-right">
                                      <div class="dealer-widget">
                                          <div class="dealer-content">
                                              <div class="inner-wrapper">

                                                  <div class="clear">
                                                      <div class="col-xs-4 col-sm-4 dealer-face">
                                                          <a href="">
                                                              <img src="assets/img/client-face1.png" class="img-circle">
                                                          </a>
                                                      </div>
                                                      <div class="col-xs-8 col-sm-8 ">
                                                          <h3 class="dealer-name">
                                                              <a href="">Nathan James</a>
                                                              <span>Real Estate Agent</span>
                                                          </h3>
                                                          <div class="dealer-social-media">
                                                              <a class="twitter" target="_blank" href="">
                                                                  <i class="fa fa-twitter"></i>
                                                              </a>
                                                              <a class="facebook" target="_blank" href="">
                                                                  <i class="fa fa-facebook"></i>
                                                              </a>
                                                              <a class="gplus" target="_blank" href="">
                                                                  <i class="fa fa-google-plus"></i>
                                                              </a>
                                                              <a class="linkedin" target="_blank" href="">
                                                                  <i class="fa fa-linkedin"></i>
                                                              </a>
                                                              <a class="instagram" target="_blank" href="">
                                                                  <i class="fa fa-instagram"></i>
                                                              </a>
                                                          </div>

                                                      </div>
                                                  </div>

                                                  <div class="clear">
                                                      <ul class="dealer-contacts">
                                                          <li><i class="pe-7s-map-marker strong"> </i> 9089 your adress her</li>
                                                          <li><i class="pe-7s-mail strong"> </i> email@yourcompany.com</li>
                                                          <li><i class="pe-7s-call strong"> </i> +1 908 967 5906</li>
                                                      </ul>
                                                      <p>Duis mollis  blandit tempus porttitor curabiturDuis mollis  blandit tempus porttitor curabitur , est non…</p>
                                                  </div>

                                              </div>
                                          </div>
                                      </div>';

    $query = "SELECT id, image_path, price, place FROM plannings LIMIT 7";

    $result=$conn->query($query)
      or die ($conn->error);

    $properties = '';
    while($row = $result->fetch_assoc()) {
      $properties .= '<div class="panel-body recent-property-widget" name="tripContainer">
                        <div id="id" value="' . $row['id']. '"></div>
                        <ul>
                          <li>
                              <div class="col-md-3 col-sm-3 col-xs-3 blg-thumb p0">
                                  <a href=""><img src="assets/img/uploaded/' . $row['image_path'] . '"></a>
                              </div>
                              <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
                                  <h6>'. $row['place'] . '</h6>
                                  <span class="property-price">€' . $row['price'] . '</span>
                              </div>
                          </li>
                        </ul>
                    </div>';
    }

    $query = "SELECT *
              FROM plannings JOIN plannings_stages ON planning_id
                             JOIN stages ON stages.id
              WHERE plannings.id=plannings_stages.planning_id
                    AND plannings_stages.stage_id=stages.id ";

    $result=$conn->query($query)
      or die ($conn->error);

    while($row = $result->fetch_assoc())
      echo '<div name="stages" place="'. $row['place'] .'" description="'. $row['description'] .'" trip_type="'. $row['trip_type'] .'" duration="'. $row['duration'] .'"></div>', PHP_EOL;

    $conn->close();

    $other_trips = '                  <div class="panel panel-default sidebar-menu similar-property-wdg wow fadeInRight animated">
                                          <div class="panel-heading">
                                              <h3 class="panel-title">Similar Trips</h3>
                                          </div>
                                          <form id="myForm" action="trip.php" method="post">
                                            ' . $properties . '
                                          </form>
                                      </div>
                                  </aside>
                              </div>
                          </div>

                      </div>
                  </div>';

    $html = $page_header . $trip_info . $user_info . $other_trips;
    echo $html;

    require("common/footer.html");
    require("common/scripts.html");
  ?>

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8-kAUPVmM33rORirYxG2KhKkLnFH89-w&callback=initMap" type="text/javascript"></script>
  <script type="text/javascript" src="assets/js/myJs/submitDataToTrip.js"></script>
  <script type="text/javascript" src="assets/js/myJs/showMap.js"></script>
</body>

</html>
