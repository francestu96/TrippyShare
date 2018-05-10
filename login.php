<!DOCTYPE html>

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


    <!-- Area di login -->
    <div class="register-area" style="background-color: rgb(249, 249, 249);">
        <div class="container">

            <div class="col-md-6">
                <div class="box-for overflow">
                    <div class="col-md-12 col-xs-12 register-blocks">
                        <h2>Sign up</h2>
                        <form action="checkRegistration.php" id="login-form" method="post" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input required type="text" class="form-control" name="name" onchange="jsonRequest(id, value)">
                            </div>
                            <div class="form-group">
                                <label for="surname">Surname</label>
                                <input required type="text" class="form-control" name="surname"\>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input required type="email" class="form-control" name="email" onchange="jsonRequest(id, value)">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input required type="password" class="form-control" name="password" minlength="6">
                            </div>
                            <div class="form-group">
                                <label for="password">Confirm Password</label>
                                <input required type="password" class="form-control" name="password_confirm" minlength="6">
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

            <div class="col-md-6">
                <div class="box-for overflow">
                    <div class="col-md-12 col-xs-12 login-blocks">
                        <h2>Login</h2>
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
</body>

</html>
