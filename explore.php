<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
  <title>SAW | Explore</title>
  <?php require("common/header.html"); ?>
</head>

<body>
  <?php
    require("common/costants.php");
    require("common/navbar.php");

    preloader();
  ?>

  <div class="page-head">
      <div class="container">
          <div class="row">
              <div class="page-head-content">
                  <h1 class="page-title">List Layout With Sidebar</h1>
              </div>
          </div>
      </div>
  </div>

  <div class="properties-area recent-property" style="background-color: #FFF;">
        <div class="container">
            <div class="row">
              <!-- search area -->
              <div class="col-md-3 p0 padding-top-40">
                  <div class="blog-asside-right pr0">
                      <div class="panel panel-default sidebar-menu wow fadeInRight animated" >
                          <div class="panel-heading">
                              <h3 class="panel-title">Smart search</h3>
                          </div>
                          <div class="panel-body search-widget">
                              <form action="" class=" form-inline">
                                  <fieldset>
                                      <div class="row">
                                          <div class="col-xs-12">
                                              <input type="text" class="form-control" placeholder="Key word">
                                          </div>
                                      </div>
                                  </fieldset>

                                  <fieldset>
                                      <div class="row">
                                          <div class="col-xs-6">

                                              <select id="lunchBegins" class="selectpicker" data-live-search="true" data-live-search-style="begins" title="Select Your City">

                                                  <option>New york, CA</option>
                                                  <option>Paris</option>
                                                  <option>Casablanca</option>
                                                  <option>Tokyo</option>
                                                  <option>Marraekch</option>
                                                  <option>kyoto , shibua</option>
                                              </select>
                                          </div>
                                          <div class="col-xs-6">

                                              <select id="basic" class="selectpicker show-tick form-control">
                                                  <option> -Status- </option>
                                                  <option>Rent </option>
                                                  <option>Boy</option>
                                                  <option>used</option>

                                              </select>
                                          </div>
                                      </div>
                                  </fieldset>

                                  <fieldset class="padding-5">
                                      <div class="row">
                                          <div class="col-xs-6">
                                              <label for="price-range">Price range ($):</label>
                                              <input type="text" class="span2" value="" data-slider-min="0"
                                                     data-slider-max="600" data-slider-step="5"
                                                     data-slider-value="[0,450]" id="price-range" ><br />
                                              <b class="pull-left color">2000$</b>
                                              <b class="pull-right color">100000$</b>
                                          </div>
                                          <div class="col-xs-6">
                                              <label for="property-geo">Property geo (m2) :</label>
                                              <input type="text" class="span2" value="" data-slider-min="0"
                                                     data-slider-max="600" data-slider-step="5"
                                                     data-slider-value="[50,450]" id="property-geo" ><br />
                                              <b class="pull-left color">40m</b>
                                              <b class="pull-right color">12000m</b>
                                          </div>
                                      </div>
                                  </fieldset>

                                  <fieldset class="padding-5">
                                      <div class="row">
                                          <div class="col-xs-6">
                                              <label for="price-range">Min baths :</label>
                                              <input type="text" class="span2" value="" data-slider-min="0"
                                                     data-slider-max="600" data-slider-step="5"
                                                     data-slider-value="[250,450]" id="min-baths" ><br />
                                              <b class="pull-left color">1</b>
                                              <b class="pull-right color">120</b>
                                          </div>

                                          <div class="col-xs-6">
                                              <label for="property-geo">Min bed :</label>
                                              <input type="text" class="span2" value="" data-slider-min="0"
                                                     data-slider-max="600" data-slider-step="5"
                                                     data-slider-value="[250,450]" id="min-bed" ><br />
                                              <b class="pull-left color">1</b>
                                              <b class="pull-right color">120</b>

                                          </div>
                                      </div>
                                  </fieldset>

                                  <fieldset class="padding-5">
                                      <div class="row">
                                          <div class="col-xs-6">
                                              <div class="checkbox">
                                                  <label> <input type="checkbox" checked> Fire Place</label>
                                              </div>
                                          </div>

                                          <div class="col-xs-6">
                                              <div class="checkbox">
                                                  <label> <input type="checkbox"> Dual Sinks</label>
                                              </div>
                                          </div>
                                      </div>
                                  </fieldset>

                                  <fieldset class="padding-5">
                                      <div class="row">
                                          <div class="col-xs-6">
                                              <div class="checkbox">
                                                  <label> <input type="checkbox" checked> Swimming Pool</label>
                                              </div>
                                          </div>
                                          <div class="col-xs-6">
                                              <div class="checkbox">
                                                  <label> <input type="checkbox" checked> 2 Stories </label>
                                              </div>
                                          </div>
                                      </div>
                                  </fieldset>

                                  <fieldset class="padding-5">
                                      <div class="row">
                                          <div class="col-xs-6">
                                              <div class="checkbox">
                                                  <label><input type="checkbox"> Laundry Room </label>
                                              </div>
                                          </div>
                                          <div class="col-xs-6">
                                              <div class="checkbox">
                                                  <label> <input type="checkbox"> Emergency Exit</label>
                                              </div>
                                          </div>
                                      </div>
                                  </fieldset>

                                  <fieldset class="padding-5">
                                      <div class="row">
                                          <div class="col-xs-6">
                                              <div class="checkbox">
                                                  <label>  <input type="checkbox" checked> Jog Path </label>
                                              </div>
                                          </div>
                                          <div class="col-xs-6">
                                              <div class="checkbox">
                                                  <label>  <input type="checkbox"> 26' Ceilings </label>
                                              </div>
                                          </div>
                                      </div>
                                  </fieldset>

                                  <fieldset class="padding-5">
                                      <div class="row">
                                          <div class="col-xs-12">
                                              <div class="checkbox">
                                                  <label>  <input type="checkbox"> Hurricane Shutters </label>
                                              </div>
                                          </div>
                                      </div>
                                  </fieldset>

                                  <fieldset >
                                      <div class="row">
                                          <div class="col-xs-12">
                                              <input class="button btn largesearch-btn" value="Search" type="submit">
                                          </div>
                                      </div>
                                  </fieldset>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-md-9  pr0 padding-top-40 properties-page">
                  <!-- Layout & order area-->
                  <div class="col-md-12 clear">
                      <div class="col-xs-10 page-subheader sorting pl0">
                          <ul class="sort-by-list">
                              <li class="active" id="dateSort">
                                  <a href="explore.php?sort=date" class="order_by_date" data-orderby="property_date" data-order="ASC">
                                      Trip Departure Date <i class="fa fa-sort-amount-asc"></i>
                                  </a>
                              </li>
                              <li class="" id="priceSort">
                                  <a href="explore.php?sort=price" class="order_by_price" data-orderby="property_price" data-order="DESC">
                                      Trip Price <i class="fa fa-sort-numeric-desc"></i>
                                  </a>
                              </li>
                          </ul>
                      </div>

                      <!--/ .layout-switcher-->
                      <div class="col-xs-2 layout-switcher">
                          <a class="layout-grid active"> <i class="fa fa-th"></i> </a>
                          <a class="layout-list"> <i class="fa fa-th-list"></i>  </a>
                      </div>
                  </div>

                  <!-- Trips area-->
                  <div class="col-md-12 clear">
                      <div id="list-type" class="proerty-th">
                        <form id="myForm" action="trip.php" method="post">
                          <?php
                            $orderBy = "departure_date";

                            $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");

                            /* check connection */
                            if ($conn->connect_error) {
                              error("Connection failed: " . $conn->connect_error, null);
                            }

                            if(!empty($_GET['sort']))
                              if($_GET['sort'] === "price")
                                $orderBy = "price";

                            //select the necessary info about plannings
                            $query = "SELECT id, image_name, departure_date, arrival_date, price, description, place FROM plannings ORDER BY $orderBy";

                            if(!($result=$conn->query($query))){
                              error($conn->error, $conn);
                            }

                            while($row = $result->fetch_assoc()) {
                              echo '<div class="col-sm-6 col-md-4 p0" name="tripContainer">
                                      <div id="id" value="' . $row['id']. '"></div>
                                      <div class="box-two proerty-item">
                                          <div class="item-thumb">
                                              <img src="assets/img/uploaded/' . $row['image_name']. '">
                                          </div>
                                          <div class="item-entry overflow">
                                              <h5>' . $row['place'] . '</h5>
                                              <div class="dot-hr"></div>
                                              <span class="pull-left"><b> Departure :</b> ' . date('d/m/Y', strtotime($row['departure_date'])) . ' </span>
                                              <span class="pull-left"><b> Arrival :</b> ' . date('d/m/Y', strtotime($row['arrival_date'])) . ' </span>
                                              <span class="proerty-price pull-right"> €' . $row['price']. '</span>
                                              <p style="display: none;">' . $row['description'] . '</p>
                                              <div class="property-icon">
                                                  <img src="assets/img/icon/bed.png">(5)|
                                                  <img src="assets/img/icon/shawer.png">(2)|
                                                  <img src="assets/img/icon/cars.png">(1)
                                              </div>
                                          </div>
                                      </div>
                                  </div>';
                            }
                            if(!$conn->close()){
                              error($conn->error, null);
                            }
                          ?>
                        </form>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>

  <?php
    require("common/footer.html");
    require("common/scripts.html");

    $toActive = "dateSort";
    $notToActive = "priceSort";

    if($orderBy === "price"){
      $toActive = "priceSort";
      $notToActive = "dateSort";
    }

    echo "<script type='text/javascript'>document.getElementById('$toActive').classList.add('active'); document.getElementById('$notToActive').classList.remove('active')</script>";
  ?>
  <script type="text/javascript" src="assets/js/myJs/submitDataToTrip.js"></script>
</body>

</html>
