<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 profiel-container">

            <form action="updateProfile.php" method="POST" enctype="multipart/form-data" >
                <div class="profiel-header">
                    <h3>
                        <b>BUILD</b> YOUR PROFILE
                        <br>
                        <small>This information will let us know more about you.</small>
                    </h3>
                    <hr>
                </div>

                <div class="clear">
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="picture-container">
                            <div class="picture">
                                <img src="assets/img/users/<?= $fileName?>" height="220" width="330" class="picture-src" id="wizardPicturePreview" title="">
                                <input type="file" accept=".jpg, .jpeg, .gif, .png" class="form-control" name="profile-image">
                            </div>
                            <h6>Choose Picture</h6>
                        </div>
                    </div>

                    <div class="col-sm-3 padding-top-25">

                        <div class="form-group">
                            <label>First Name
                                <small>(required)</small>
                            </label>
                            <input name="firstname" type="text" class="form-control" required readonly value="<?= $name?>">
                        </div>
                        <div class="form-group">
                            <label>Last Name
                                <small>(required)</small>
                            </label>
                            <input name="lastname" type="text" class="form-control" required readonly value="<?= $surname?>">
                        </div>
                        <div class="form-group">
                            <label>Email
                                <small></small>
                            </label>
                            <input name="email" type="email" onchange="checkEmail()" class="form-control" required value="<?= $email?>">
                        </div>
                    </div>
                    <div class="col-sm-3 padding-top-25">
                        <div class="form-group">
                            <label>Gender
                                <small></small>
                            </label>
                            <br>
                            <input name="gender" type="radio"  value="male" style="width: 10%" <?php echo ($gender== 'male') ?  "checked" : "" ;  ?>> Male
                            <br>
                            <input name="gender" type="radio"  value="female" style="width: 10%" <?php echo ($gender== 'female') ?  "checked" : "" ;  ?>> Female
                            <br>
                        </div>

                        <div class="form-group">
                            <label>Change password
                                <small></small>
                            </label>
                            <input type="password" name="password" id="password" name="password" minlength="6" onchange="checkPassword()" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Confirm password :
                                <small></small>
                            </label>
                            <input type="password" id="password_confirm" onchange="checkPassword()" class="form-control">
                        </div>
                    </div>

                </div>

                <div class="clear">
                    <br>
                    <hr>
                    <br>
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label>Nationality :</label>
                            <input name="nationality" type="text" class="form-control" value="<?= $nationality?>">
                        </div>
                        <div class="form-group">
                            <label>City :</label>
                            <input name="address" type="text" class="form-control" value="<?= $address?>">
                        </div>

                    </div>

                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Phone :</label>
                            <input name="phone" type="text" class="form-control" value="<?= $phone?>">
                        </div>
                        <div class="form-group">
                            <label>Birthday :</label>
                            <input name="birthday" type="date" class="form-control" value="<?= $birthday?>">
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="form-group">
                            <label>Description about yourself :</label>
                            <textarea name="description" rows="10" maxlength="500" class="form-control"><?= $description?></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5 col-sm-offset-1">
                    <br>
                    <input type="submit" type="button" class="btn btn-finish btn-primary" name="finish" value="Finish">
                </div>
                <br>
            </form>
            <?php
              $query = "SELECT id, image_name, place, price
                        FROM users_plannings JOIN plannings ON plannings.id=users_plannings.planning_id
                        WHERE users_plannings.user_id=(SELECT id FROM users WHERE email=?)";

              try{
                if (!($stmt = $conn->prepare($query)))
                  throw new Exception($stmt->error);

                /* bind parameters for markers */
                if(!($stmt->bind_param("s", $_SESSION['email'])))
                  throw new Exception($stmt->error);

                if(!($stmt->execute()))
                  throw new Exception($stmt->error);

                $result = $stmt->get_result();

                $trips = '';
                while($row = $result->fetch_assoc()) {
                  $trips .= '<div class="col-sm-4 col-xs-6" name="tripContainer">
                                <div id="id" value="' . $row['id']. '"></div>
                                  <div class="col-xs-6">
                                      <a href="#"><img src="assets/img/uploaded/' . $row['image_name'] . '"></a>
                                  </div>
                                  <div class="col-md-8 col-sm-8 col-xs-8 blg-entry">
                                      <h6>'. htmlspecialchars($row['place']) . '</h6>
                                      <span class="property-price">€' . $row['price'] . '</span>
                                  </div>
                                </div>';
                }

                /* close statement */
                if(!$stmt->close())
                  throw new Exception($stmt->error);
              }
              catch(Exception $error_message){
                error($error_message, $conn);
              }

              echo '<form id="myForm" action="trip.php" method="post">
                      <div class="col-md-12 col-xs-12 percent-blocks m-main">
                        <div class="row">
                          <h4 class="s-property-title">Trips you take part in</h4>
                            '. $trips . '
                        </div>
                      </div>
                    </form>'
            ?>
        </div>
    </div>
    <!-- end row -->
</div>
