<?php
  session_start();

  echo
    '
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
                      </li>';

                      if(!isset($_SESSION['username'])){
                        echo
                          '<li class="wow fadeInDown" data-wow-delay="0.2s">
                            <a class="" href="login.php">Sign in</a>
                          </li>';
                      }

                      else{
                        echo
                          '<li class="dropdown ymm-sw " data-wow-delay="0.1s">
                              <a class="dropdown-toggle active" data-toggle="dropdown" data-hover="dropdown" data-delay="200">' . $_SESSION['username'] . '<b class="caret"></b></a>
                              <ul class="dropdown-menu" style="text-align: center">
                                  <li>
                                      <a href="logout.php">Logout</a>
                                  </li>
                              </ul>
                          </li>';
                      }
                      echo
                      '</ul>
                    </div>
                </div>
            </nav>';
?>
