<form id="myForm" action="sendMessage.php" method="post">
    <?php
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['name'])){
            header('Location: login.php');
            exit();
        }
    ?>
        <div class="col-sm-10 col-sm-offset-1">
            <input name="receiverId" type="hidden" class="form-control" value="<?= $profileId?>">
            <div class="form-group">
                <label>Contact him:</label>
                <textarea name="message" rows="10" maxlength="500" class="form-control">
                </textarea>
            </div>
            <div class="col-sm-5">
                <br>
                <input type="submit" type="button" class="btn btn-finish btn-primary" name="send" value="Send">
            </div>
        </div>
</form>