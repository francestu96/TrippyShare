<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 profiel-container">

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
                                <img src="assets/img/users/<?= $fileName?>" class="picture-src" id="wizardPicturePreview" title="">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 padding-top-25">

                        <div class="form-group">
                            <label>First Name
                            </label>
                            <input name="firstname" type="text" class="form-control" readonly value="<?= $name?>">
                        </div>
                        <div class="form-group">
                            <label>Last Name
                            </label>
                            <input name="lastname" type="text" class="form-control" readonly value="<?= $surname?>">
                        </div>
                        <div class="form-group">
                            <label>Email
                            </label>
                            <input name="email" type="email" class="form-control" readonly value="<?= $email?>">
                        </div>
                    </div>
                    <div class="col-sm-3 padding-top-25">
                        <div class="form-group">
                            <label>Gender
                                <small></small>
                            </label>
                            <br>
                            <input name="gender" type="radio" class="form-control" value="male"> Male
                            <br>
                            <input name="gender" type="radio" class="form-control" value="female"> Female
                            <br>
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
                            <input name="nationality" type="text" readonly class="form-control" value="<?= $nazionality?>">
                        </div>
                        <div class="form-group">
                            <label>City :</label>
                            <input name="city" type="text" readonly class="form-control" value="<?= $address?>">
                        </div>

                    </div>

                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Phone :</label>
                            <input name="phone" type="text" readonly class="form-control" value="<?= $phone?>">
                        </div>
                        <div class="form-group">
                            <label>Birthday :</label>
                            <input name="birthday" type="date" readonly class="form-control" value="<?= $birthday?>">
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="form-group">
                            <label>Description :</label>
                            <textarea name="description" rows="10" maxlength="500" readonly class="form-control" value="<?= $description?>"></textarea>
                        </div>
                    </div>

                </div>
        </div>
    </div>
</div>