<?php 
    // Se l'utente è già loggato ritorna ad index.html
    session_start();
    if(isset($_SESSION['username'])){
        header('Location: index.php');
    }
?>

<!DOCTYPE html>

<html >
<head>
    <?php require("common/header.html"); ?>
</head>

<body>

    <?php require("common/navbar.php"); ?>

    <!-- Inizio dell'hader contenente un'immagine e una scritta -->
    <div id="tooltip" class="page-head">
        <span class="tooltiptext"></span>
        <div class="container">
            <div class="row">
                <div class="page-head-content">
                    <h1 class="page-title" style="font-weight:900"> Sign up / Login </h1>
                </div>
            </div>
        </div>
    </div>


    <!-- Area di login -->
    <div class="register-area" style="background-color: rgb(249, 249, 249);">
        <div class="container">

            <div class="col-md-6">
                <div class="box-for overflow">
                    <div class="col-md-12 col-xs-12 register-blocks">
                        <h2>Sign up</h2>
                        <form action="checkdata.php" id="login-form" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input required type="text" class="form-control" name="name"\>
                            </div>
                            <div class="form-group">
                                <label for="surname">Surname</label>
                                <input required type="text" class="form-control" name="surname"\>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label><br>
                                <input required checked type="radio" name="gender" value="male" >Male<br>
                                <input required type="radio" name="gender" value="female" >Female<br>
                            </div>
                            <div class="form-group">
                                <label for="birthDate">Birth date</label>
                                <input required type="date" class="form-control" name="birthDate"\>
                            </div>
                            <div class="form-group">
                                <label for="birthCity">Birth city</label>
                                <input required type="text" class="form-control" name="birthCity" onchange="searchCity(value)">
                            </div>
                            <div class="form-group">
                                <label for="fiscalCode">Fiscal Code</label>
                                <input required type="text" class="form-control" name="fiscalCode" pattern="^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input required type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input required type="password" class="form-control" name="password" minlength="6">
                                <div>
                                  Your password must be at least 6 characters
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="navbar-btn nav-button wow bounceInRight login">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box-for overflow">
                    <div class="col-md-12 col-xs-12 login-blocks">
                        <h2>Login</h2>
                        <form action="checkLogin.php" method="post">
                            <div class="form-group">
                                <label for="email_signin">Username</label>
                                <input required type="text" class="form-control" name="username">
                            </div>
                            <div class="form-group">
                                <label for="password_signin">Password</label>
                                <input required type="password" class="form-control" name="password_signin">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="navbar-btn nav-button wow bounceInRight login"> Log in</button>
                            </div>
                        </form>
                        <br>


                    </div>

                </div>
            </div>

        </div>
    </div>

    <?php
      require("common/footer.html");
      require("common/scripts.html");
    ?>

    <script>
      function searchCity(city){
        el = document.getElementsByName("birthCity")[0];

        $.ajax({
          url: "https://raw.githubusercontent.com/matteocontrini/comuni-json/master/comuni.json",
          type : 'GET',
          dataType:'json',
          success: function(result){
            for(i=0; i < result.length; i++){
              if(city.toLowerCase() == result[i].nome.toLowerCase()){
                el.style="border:1px solid green";
                el.setCustomValidity("");
                return;
              }
            }
            el.style="border:1px solid red";
            el.setCustomValidity("Invalid city");
          }});
      }
    </script>
</body>

</html>
