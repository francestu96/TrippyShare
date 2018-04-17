<?php
  echo <<<NAVBAR
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <nav class="navbar navbar-default ">
          <div class="container">
              <!-- Barra in alto -->
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="index.php">
                      <img src="assets/img/logo.png" alt="">
                  </a>
              </div>

              <!-- Pulsanti in alto a destra -->
              <div class="collapse navbar-collapse yamm" id="navigation">
                  <ul class="main-nav nav navbar-nav navbar-right">

                      <li >
                          <a class="" href="index.php">Home</a>
                      </li>
                      <li >
                          <a class="" href="explore.php">Explore</a>
                      </li>
                      <li >
                          <a class="" href="login.php">Sign in</a>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>
NAVBAR
?>
