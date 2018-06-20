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

                <li>
                    <a class="" href="index.php">Home</a>
                </li>
                <li>
                    <a class="" href="explore.php">Explore</a>
                </li>

<?php
    if(!isset($_SESSION))
        session_start();

    // Se l'utente non è loggato mostra il pulsante di login
    if(!isset($_SESSION['name'])){
        echo
            '<li class="wow fadeInDown animated" data-wow-delay="0.2s">
                <a class="" href="login.php">Sign in</a>
            </li>';
    }

    // Se l'utente è loggato mostra il suo nome
    else{
        echo
            '<li class="dropdown ymm-sw" data-wow-delay="0.1s">
                <a href="" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">' . $_SESSION['name'] . '</a>
                <ul class="dropdown-menu navbar-nav" style="text-align: center">
                    <li>
                        <a href="newTrip.php">New Trip</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </li>';
    }
?>
            </ul>
        </div>
    </div>
</nav>
