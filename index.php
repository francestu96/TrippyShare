<!DOCTYPE html>

<html >

<head>
    <?php require("common/header.php"); ?>
</head>

<body>

    <?php require("common/navbar.php"); ?>

    <!-- Area centrale con immagine e corpo -->
    <div class="slider-area">
        <div class="slider">
            <div id="bg-slider" class="owl-carousel owl-theme">

                <div class="item">
                    <img src="assets/img/airplane.jpg" alt="GTA V">
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

    <?php
      require("common/footer.php");
      require("common/scripts.php");
    ?>



</body>

</html>
