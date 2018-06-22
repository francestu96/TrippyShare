<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
  <title>SAW | Profile</title>
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
                  <h1 class="page-title">Profile</h1>
              </div>
          </div>
      </div>
  </div>

  <div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">   
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 profiel-container">

                        <form action="" method="">
                            <div class="profiel-header">
                                <h3>
                                    <b>BUILD</b> YOUR PROFILE <br>
                                    <small>This information will let us know more about you.</small>
                                </h3>
                                <hr>
                            </div>

                            <div class="clear">
                                <div class="col-sm-3 col-sm-offset-1">
                                    <div class="picture-container">
                                        <div class="picture">
                                            <img src="assets/img/avatar.png" class="picture-src" id="wizardPicturePreview" title="">
                                            <input type="file" id="wizard-picture">
                                        </div>
                                        <h6>Choose Picture</h6>
                                    </div>
                                </div>

                                <div class="col-sm-3 padding-top-25">

                                    <div class="form-group">
                                        <label>First Name <small>(required)</small></label>
                                        <input name="firstname" type="text" class="form-control" placeholder="Andrew...">
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name <small>(required)</small></label>
                                        <input name="lastname" type="text" class="form-control" placeholder="Smith...">
                                    </div> 
                                    <div class="form-group">
                                        <label>Email <small>(required)</small></label>
                                        <input name="email" type="email" class="form-control" placeholder="mail@email@email.com.com">
                                    </div> 
                                </div>
                                <div class="col-sm-3 padding-top-25">
                                    <div class="form-group">
                                        <label>Gender <small></small></label><br>
                                        <input name="gender" type="radio" class="form-control" value="male"> Male<br>
                                        <input name="gender" type="radio" class="form-control" value="female"> Female<br>
                                    </div> 

                                    <div class="form-group">
                                        <label>Password <small>(required)</small></label>
                                        <input name="Password" type="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm password : <small>(required)</small></label>
                                        <input type="password" class="form-control">
                                    </div>
                                </div>  

                            </div>

                            <div class="clear">
                                <br>
                                <hr>
                                <br>
                                <div class="col-sm-5 col-sm-offset-1">
                                    <div class="form-group">
                                        <label>Nazionality :</label>
                                        <input name="Nationality" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label>City :</label>
                                        <input name="website" type="text" class="form-control" >
                                    </div>
                                    
                                </div>  

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Phone :</label>
                                        <input name="Phone" type="text" class="form-control" placeholder="+1 9090909090">
                                    </div>
                                    <div class="form-group">
                                        <label>Birthday :</label>
                                        <input name="Birthday" type="text" class="form-control" >
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <br>
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group">
                                        <label>Description about yourself :</label>
                                        <textarea name="Description" rows="10" maxlength="500" class="form-control" ></textarea>
                                    </div>
                                </div>
 
                            </div>
                    
                            <div class="col-sm-5 col-sm-offset-1">
                                <br>
                                <input type="button" class="btn btn-finish btn-primary" name="finish" value="Finish">
                            </div>
                            <br>
                    </form>

                </div>
            </div><!-- end row -->

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
