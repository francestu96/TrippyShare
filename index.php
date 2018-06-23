<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
  <title>SAW | Home page</title>
  <?php require("common/header.html"); ?>
</head>

<body>
    <?php
      require("common/costants.php");
      require("common/navbar.php");

      preloader();
    ?>

    <!-- Area centrale con immagine e corpo -->
    <div class="slider-area">
        <div class="slider">
            <div id="bg-slider" class="owl-carousel owl-theme">

                <div class="item">
                    <img src="./assets/img/airplane.jpg" alt="Airplane">
                </div>

                <div class="item">
                    <img src="./assets/img/airplane.jpg" alt="Airplane">
                </div>

                <div class="item">
                    <img src="./assets/img/airplane.jpg" alt="Airplane">
                </div>


            </div>
        </div>
        <div class="slider-content">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                    <h2>Sviluppo applicazioni web</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi deserunt deleniti, ullam commodi sit
                        ipsam laboriosam velit adipisci quibusdam aliquam teneturo!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Overview degli ultimi viaggi aggiunti -->
    <div class="content-area home-area-1 recent-property" style="background-color: #FCFCFC; padding-bottom: 55px;">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                    <!-- /.feature title -->
                    <h2>Last trip uploaded</h2>
                    <p>Look at the very last trips uploaded and start to travel. </p>
                </div>
            </div>

            <div class="row">
                <div class="proerty-th">
                    <form id="myForm" action="trip.php" method="post">
                      <?php
                        $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");

                        /* check connection */
                        if ($conn->connect_error) {
                          error("Connection failed: " . $conn->connect_error, null);
                        }

                        $query = "SELECT id, image_name, departure_date, price, place FROM plannings ORDER BY departure_date LIMIT 7";

                        if(!($result=$conn->query($query))){
                          error($conn->error, $conn);
                        }

                        while($row = $result->fetch_assoc()) {
                          echo '<div class="col-sm-6 col-md-3 p0" name="tripContainer">
                                  <div id="id" value="' . $row['id']. '"></div>
                                  <div class="box-two proerty-item">
                                      <div class="item-thumb">
                                          <img src="assets/img/uploaded/' . $row['image_name']. '">
                                      </div>
                                      <div class="item-entry overflow">
                                          <h5>' . $row['place'] . '</h5>
                                          <div class="dot-hr"></div>
                                          <span class="pull-left"><b>Departure :</b> ' . date('d/m/Y', strtotime($row['departure_date'])) . ' </span>
                                          <span class="proerty-price pull-right">€' . $row['price']. '</span>
                                      </div>
                                  </div>
                              </div>';
                        }
                        if(!$conn->close()){
                          error($conn->error, null);
                        }
                      ?>
                    </form>
                    <div class="col-sm-6 col-md-3 p0">
                        <div class="box-tree more-proerty text-center" onclick="location.href='explore.php'">
                            <div class="item-tree-icon">
                                <i class="fa fa-th"></i>
                            </div>
                            <div class="more-entry overflow">
                                <h5><a href="explore.php" >CAN'T DECIDE ? </a></h5>
                                <h5 class="tree-sub-ttl">Show all properties</h5>
                                <button class="btn border-btn more-black" value="All properties" onclick="location.href='explore.php';">All properties</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--Welcome area -->
    <div class="Welcome-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 Welcome-entry  col-sm-12">
                    <div class="col-md-5 col-md-offset-2 col-sm-6 col-xs-12">
                        <div class="welcome_text wow fadeInLeft" data-wow-delay="0.3s" data-wow-offset="100">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                                    <!-- /.feature title -->
                                    <h2>TRIPPY SHARE </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <div  class="welcome_services wow fadeInRight" data-wow-delay="0.3s" data-wow-offset="100">
                            <div class="row">
                                <div class="col-xs-6 m-padding">
                                    <div class="welcome-estate">
                                        <div class="welcome-icon">
                                            <i class="pe-7s-photo pe-4x"></i>
                                        </div>
                                        <h3>Any place</h3>
                                    </div>
                                </div>
                                <div class="col-xs-6 m-padding">
                                    <div class="welcome-estate">
                                        <div class="welcome-icon">
                                            <i class="pe-7s-users pe-4x"></i>
                                        </div>
                                        <h3>More Clients</h3>
                                    </div>
                                </div>


                                <div class="col-xs-12 text-center">
                                    <i class="welcome-circle"></i>
                                </div>

                                <div class="col-xs-6 m-padding">
                                    <div class="welcome-estate">
                                        <div class="welcome-icon">
                                            <i class="pe-7s-notebook pe-4x"></i>
                                        </div>
                                        <h3>Easy to use</h3>
                                    </div>
                                </div>
                                <div class="col-xs-6 m-padding">
                                    <div class="welcome-estate">
                                        <div class="welcome-icon">
                                            <i class="pe-7s-help2 pe-4x"></i>
                                        </div>
                                        <h3>Any help </h3>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--TESTIMONIALS -->
    <div class="testimonial-area recent-property" style="background-color: #FCFCFC; padding-bottom: 15px;">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                    <!-- /.feature title -->
                    <h2>Our Users Said  </h2>
                </div>
            </div>

            <div class="row">
                <div class="row testimonial">
                    <div class="col-md-12">
                        <div id="testimonial-slider">
                            <div class="item">
                                <div class="client-text">
                                    <p>I've found my place!</p>
                                    <h4><strong>Ohidul Alam </strong></h4>
                                </div>
                                <div class="client-face wow fadeInRight" data-wow-delay=".9s">
                                    <img src="assets/img/client-face1.png" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="client-text">
                                    <p>I love Trippyshare !</p>
                                    <h4><strong>Andrea Alam </strong></h4>
                                </div>
                                <div class="client-face">
                                    <img src="assets/img/client-face2.png" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="client-text">
                                    <p>I've found my wife in trip using trippy share</p>
                                    <h4><strong>Andrea Balam </strong></h4>
                                </div>
                                <div class="client-face">
                                    <img src="assets/img/client-face1.png" alt="">
                                </div>
                            </div>
                            <div class="item">
                                <div class="client-text">
                                    <p>Best way to make friends</p>
                                    <h4><strong>Marco Asam </strong></h4>
                                </div>
                                <div class="client-face">
                                    <img src="assets/img/client-face2.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Count area -->
    <div class="count-area">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                    <!-- /.feature title -->
                    <h2>You can trust Us </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12 percent-blocks m-main" data-waypoint-scroll="true">
                    <div class="row">
                        <div class="col-sm-4 col-xs-6">
                            <div class="count-item">
                                <div class="count-item-circle">
                                    <span class="pe-7s-users"></span>
                                </div>
                                <div class="chart" data-percent="5000">
                                    <h2 class="percent" id="counter">0</h2>
                                    <h5>USERS </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <div class="count-item">
                                <div class="count-item-circle">
                                    <span class="pe-7s-home"></span>
                                </div>
                                <div class="chart" data-percent="12000">
                                    <h2 class="percent" id="counter1">0</h2>
                                    <h5>Trips</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <div class="count-item">
                                <div class="count-item-circle">
                                    <span class="pe-7s-flag"></span>
                                </div>
                                <div class="chart" data-percent="120">
                                    <h2 class="percent" id="counter2">0</h2>
                                    <h5>Place registered </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- popup handle -->
    <?php
      define('REGISTRATION_ACTION', 2);
      define('INSERT_TRIP_ACTION', 1);

      $message = "";
      $show_popup = false;

      if(!empty($_GET['ACTION'])){
        switch($_GET['ACTION']){
          case(REGISTRATION_ACTION):
            $message = "Successful registration!<br>Now you are part of us, share, join and live a new adventure!";
            $show_popup = true;
            break;
          case(INSERT_TRIP_ACTION):
            $message = "Congratulations!<br>You've added a new Trip, now people from all over the world can join you";
            $show_popup = true;
            break;
        }
      }
    ?>

    <!-- popup code -->
    <div class="modal fade success-popup" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel">Thank You !</h4>
          </div>
          <div class="modal-body text-center">
             <img src="assets/img/blue-check.png" style="width:50px; height:50px">
              <p class="lead"><?php echo $message ?></p>
              <!-- <a href="index.php" class="rd_more btn btn-default">Go Home</a> -->
              <button type="button" class="rd_more btn btn-default" data-dismiss="modal" aria-label="Close">Continue</button>
          </div>

        </div>
      </div>
    </div>

    <?php
      require("common/footer.html");
      require("common/scripts.html");

      if($show_popup)
        echo "<script> $('#myModal').modal('show');</script>";
    ?>
    <script type="text/javascript" src="assets/js/myJs/submitDataToTrip.js"></script>
</body>

</html>
