<!DOCTYPE html>
<?php session_start() ?>
<html >
<head>
  <title>SAW | Login</title>
  <?php require("common/header.html"); ?>
</head>

<body>
    <?php require("common/navbar.php"); ?>

    <!-- Inizio dell'hader contenente un'immagine e una scritta -->
    <div class="page-head">
        <div class="container">
            <div class="row">
                <div class="page-head-content">
                    <h1 class="page-title"> Sign up / Login </h1>
                </div>
            </div>
        </div>
    </div>


    <div class="register-area" style="background-color: rgb(249, 249, 249);">
        <div class="container">
            <!-- Area di registrazione -->
            <div class="col-md-6">
                <div class="box-for overflow">
                    <div class="col-md-12 col-xs-12 register-blocks">
                        <h2>Sign up</h2>
                        <?php 
                            if(isset($_SESSION["registration_message"])){
                                echo '<br/><label style="color: red;">'.$_SESSION["registration_message"].'</label>';
                                unset($_SESSION["registration_message"]);
                            }
                        ?>
                        <form action="checkRegistration.php" id="login-form" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input required type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label for="surname">Surname</label>
                                <input required type="text" class="form-control" name="surname"\>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input required type="email" class="form-control" id="email" name="email" onchange="checkEmail()">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input required type="password" class="form-control" id="password" name="password" minlength="6" onchange="checkPassword()">
                            </div>
                            <div class="form-group">
                                <label for="password">Confirm Password</label>
                                <input required type="password" class="form-control" id="password_confirm" onchange="checkPassword()">
                                <div>
                                  Your password must be at least 6 characters
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="navbar-btn nav-button login">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Area di Login -->
            <div class="col-md-6">
                <div class="box-for overflow">
                    <div class="col-md-12 col-xs-12 login-blocks">
                        <h2>Login</h2>
                        <?php 
                            if(isset($_SESSION["login_message"])){
                                echo '<br/><label style="color: red;">'.$_SESSION["login_message"].'</label>';
                                unset($_SESSION["login_message"]);
                            }
                        ?>
                        <form action="checkLogin.php" method="post">
                            <div class="form-group">
                                <label for="email_signin">Email</label>
                                <input type="text" class="form-control" name="email_signin">
                            </div>
                            <div class="form-group">
                                <label for="password_signin">Password</label>
                                <input type="password" class="form-control" name="password_signin">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="navbar-btn nav-button login"> Log in</button>
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
    <script src="assets/js/myJs/checkInput.js"></script>
</body>

</html>
